<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use App\Http\Requests\AddPostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts1 = Post::where('status', 'publish')->latest()->paginate();
        $posts2 = Post::where('status', 'draft')->latest()->paginate();
        $posts3 = Post::where('status', 'trash')->latest()->paginate();

        $publish = Post::where('status', 'publish')->count();
        $draft = Post::where('status', 'draft')->count();
        $trash = Post::where('status', 'trash')->count();

        return view('posts._index', compact(['posts1','posts2','posts3', 'publish', 'draft', 'trash']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function article()
    {
        $posts = Post::where('status', 'publish')->latest()->paginate(5);

        return view('posts.article', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();

        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPostRequest $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'category' => $request->category
        ]);

        return redirect('posts')->with('success', "Your post has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
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
        return view('posts.edit', compact('post'));
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
        $data =[
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'category' => $request->category
        ];

        $post->update($data);

        return redirect('posts')->with('success', "Your post has been updated.");
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
        $post->delete();

        return back()->with('success', " Your post has been deleted.");
    }

    public function move_to_publish($id)
    {
        Post::move_to_publish($id);

        return redirect('posts')->with('success', " Your post has been publish.");
    }

    public function move_to_draft($id)
    {
        Post::move_to_draft($id);

        return redirect('posts')->with('success', " Your post has been draft.");
    }

    public function move_to_trash($id)
    {
        Post::move_to_trash($id);

        return redirect('posts')->with('success', " Your post has been trashed.");
    }

}
