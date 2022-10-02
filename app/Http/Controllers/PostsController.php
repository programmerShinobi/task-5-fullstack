<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AddPostRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isTrue;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['show', 'article']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts1 = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'publish')->latest()->paginate(5);
        $posts2 = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'draft')->latest()->paginate(5);
        $posts3 = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'trash')->latest()->paginate(5);

        $publish = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'publish')->count();
        $draft = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'draft')->count();
        $trash = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'trash')->count();

        return view('posts.index', compact(['posts1','posts2','posts3', 'publish', 'draft', 'trash']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();

        $list_category = Post::get_category_all();

        return view('posts.create', compact(['post', 'list_category']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPostRequest $request)
    {
        if ($request->image) {
            $image = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move('upload/post', $image);
        } else {
            $image = "default.jpg";
        }
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);

        // $request->user()->posts()->create($request->only('title', 'content', 'image', 'status', 'category_id', 'user_id'));

        return redirect()->route('home')->with('success', "Your post has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $category = Post::get_category($post);

        return view('posts.show', compact(['post','category']));
    }

    /**
     * Edit the given blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        Gate::authorize("update", $post);

        $list_category = Post::get_category_all();

        return view('posts.edit', compact(['post', 'list_category']));
    }

    /**
     * Update the given blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AddPostRequest $request, Post $post)
    {
        Gate::authorize("update", $post);

        $img = Post::select('image', 'id')->whereId($post->id)->first();

        if ($request->image && $img->image != "default.jpg") {
            File::delete('upload/post/' . $img->image);
            $image = time() . '-' . $request->image->getClientOriginalName();
            $request->image;
            $request->image->move('upload/post', $image);
        } elseif ($request->image && $img->image == "default.jpg") {
            $image = time() . '-' . $request->image->getClientOriginalName();
            $request->image;
            $request->image->move('upload/post', $image);
        } elseif ($img->image == "default.jpg") {
            $image = "default.jpg";
        } else {
            $image = $img->image;
        }

        $data =[
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'image' => $image,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ];

        $post->update($data);

        // $post->update($request->only('title', 'content', 'image', 'status', 'category_id', 'user_id'));

        return redirect()->route('home')->with('success', "Your post has been updated.");
    }

    /**
     * Destroy the given blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        Gate::authorize("delete", $post);

        $img = Post::select('image', 'id')->whereId($post->id)->first();

        if ($post->image && $img->image != "default.jpg") {
            File::delete('upload/post/' . $img->image);
        }

        $post->delete();

        return back()->with('success', " Your post has been deleted.");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function article()
    {
        if (Auth::user()) {
            $posts = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'publish')->latest()->paginate(5);
        } else {
            $posts = Post::where('status', 'publish')->latest()->paginate(5);
        }

        return view('posts.article', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function posts_management()
    {
        $posts1 = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'publish')->latest()->paginate();
        $posts2 = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'draft')->latest()->paginate();
        $posts3 = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'trash')->latest()->paginate();

        $publish = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'publish')->count();
        $draft = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'draft')->count();
        $trash = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'trash')->count();

        return view('posts._index', compact(['posts1', 'posts2', 'posts3', 'publish', 'draft', 'trash']));
    }

    public function move_to_publish($id)
    {
        Post::move_to_publish($id);

        return redirect('/home')->with('success', " Your post has been publish.");
    }

    public function move_to_draft($id)
    {
        Post::move_to_draft($id);

        return redirect('/home')->with('success', " Your post has been draft.");
    }

    public function move_to_trash($id)
    {
        Post::move_to_trash($id);

        return redirect('/home')->with('success', " Your post has been trashed.");
    }

}
