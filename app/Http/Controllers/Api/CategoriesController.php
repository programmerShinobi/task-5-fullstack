<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('user')->latest()->paginate(10);
        return response([
            'success' => true,
            'message' => 'List All Categories',
            'data' => CategoryResource::collection($categories)
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
                'name'     => 'required',
                'user_id' => 'required'
            ],
            [
                'name.required' => 'Enter Post Name !',
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

            $category = Category::create([
                'name'     => $request->input('name'),
                'user_id'   => $request->input('user_id')
            ]);


            if ($category) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your category has been submitted!',
                    'category' => new CategoryResource($category),
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Your category has not been submitted!',
                    'category' => new CategoryResource($category),
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::whereId($category->id)->first();

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Category Details!',
                'data'    => $category
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category Not Found!',
                'data'    => ''
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required',
                'user_id' => 'required'
            ],
            [
                'name.required' => 'Enter Post Name !',
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
            $category = Category::whereId($request->input('id'))->update([
                'name'     => $request->input('name'),
                'user_id'   => $request->input('user_id'),
            ]);

            if ($category) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category Successfully Updated !',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Category Failed to Update !',
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
        $category->delete();

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Category Deleted Successfully !',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category Failed to Delete !',
            ], 500);
        }
    }
}
