<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::latest()->paginate();
        return response([
            'success'   => true,
            'message'   => 'List All Posts',
            'data'      => ArticleResource::collection($article)
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
                'title'     => 'required|min:20|',
                'content'   => 'required|min:200',
                'category'  => 'required|min:3',
                'status'    => 'required|in:publish,draft,trash',
            ],
            [
                'title.required'    => 'Enter Post Title  !',
                'content.required'  => 'Enter Post Content  !',
                'category.required' => 'Enter Post Category  !',
                'status.required'   => 'Enter Post Status  !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please Fill in the Columns',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $article = Article::create([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
                'category'  => $request->input('category'),
                'status'    => $request->input('status'),
            ]);

            if ($article) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your post has been submitted!',
                    'post'    => new ArticleResource($article),
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Your post has not been submitted!',
                    'post'    => new ArticleResource($article),
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = Article::whereId($article->id)->first();

        if ($article) {
            return response()->json([
                'success' => true,
                'message' => 'Post Details!',
                'data'    => new ArticleResource($article)
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required|min:20',
                'content'   => 'required|min:200',
                'category'  => 'required|min:3',
                'status'    => 'required|in:publish,draft,trash',
            ],
            [
                'title.required'    => 'Enter Post Title !',
                'content.required'  => 'Enter Post Content !',
                'category.required' => 'Enter Post Category !',
                'status.required'   => 'Enter Post Status !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please Fill in the Columns',
                'data'    => $validator->errors()
            ], 400);
        } else {
            $article = Article::whereId($article->id)->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
                'category'  => $request->input('category'),
                'status'    => $request->input('status'),
            ]);

            if ($article) {
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article = Article::findOrFail($article->id);
        $article->delete();

        if ($article) {
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
