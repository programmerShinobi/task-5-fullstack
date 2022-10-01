<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::with('user')->latest()->paginate(10);
        return response([
            'success' => true,
            'message' => 'List All Posts',
            'data' => PostResource::collection($post)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required',
                'content'   => 'required',
                'image' => 'required',
                'status' => 'required',
                'category_id' => 'required',
                'user_id' => 'required'
            ],
            [
                'title.required' => 'Enter Post Title  !',
                'content.required' => 'Enter Post Content  !',
                'image.required' => 'Enter Post Image  !',
                'status.required' => 'Enter Post Status  !',
                'category_id.required' => 'Enter Post Category  !',
                'user_id.required' => 'Enter Post User  !'
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please Fill in the Empty Columns',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $post = Post::create([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
                'image'   => $request->input('image'),
                'status'   => $request->input('status'),
                'category_id'   => $request->input('category_id'),
                'user_id'   => $request->input('user_id')
            ]);


            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your post has been submitted!',
                    'post' => new PostResource($post),
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Your post has not been submitted!',
                    'post' => new PostResource($post),
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::whereId($post->id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Details!',
                'data'    => new PostResource($post)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Not Found!',
                'data'    => ''
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required',
                'content'   => 'required',
                'image' => 'required',
                'status' => 'required',
                'category_id' => 'required',
                'user_id' => 'required'
            ],
            [
                'title.required' => 'Enter Post Title !',
                'content.required' => 'Enter Post Content !',
                'image.required' => 'Enter Post Image !',
                'status.required' => 'Enter Post Status !',
                'category_id.required' => 'Enter Post Category !',
                'user_id.required' => 'Enter Post User !'
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please Fill in the Empty Columns',
                'data'    => $validator->errors()
            ], 400);
        } else {
            $post = Post::whereId($request->input('id'))->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
                'image'   => $request->input('image'),
                'status'   => $request->input('status'),
                'category_id'   => $request->input('category_id'),
                'user_id'   => $request->input('user_id'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Successfully Updated !',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Failed to Update !',
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Deleted Successfully !',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Failed to Delete !',
            ], 500);
        }
    }
}
