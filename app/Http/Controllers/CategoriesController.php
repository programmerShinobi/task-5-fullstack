<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\AddCategoryRequest;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('user')->latest()->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();

        return view('categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCategoryRequest $request)
    {
        $request->user()->categories()->create($request->only('name', 'user_id'));

        return redirect()->route('categories.index')->with('success', "Your category has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Edit the given blog category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category)
    {
        Gate::authorize("update", $category);

        return view('categories.edit', compact(['category']));
    }

    /**
     * Destroy the given blog category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Category $category)
    {
        $count = Category::with('user')->join("posts", "posts.category_id", "=", "categories.id")
        ->where('posts.category_id', $category->id)
        ->count();
        if ($count == 0) {
            Gate::authorize("update", $category);
            $category->update($request->only('name', 'user_id'));
            return redirect('/categories')->with('success', "Your category has been updated.");
        } else {
            Gate::authorize("update", $category);
            return redirect('/categories')->with('errors', "Your category has not been updated. Your category has been used by another user! ");
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
        $count = Category::with('user')->join("posts", "posts.category_id", "=", "categories.id")
        ->where('posts.category_id', $category->id)
        ->count();
        if ($count==0) {
            Gate::authorize("delete", $category);
            $category->delete();
            return redirect('/categories')->with('success', " Your category has been deleted.");
        } else {
            Gate::authorize("delete", $category);
            return redirect('/categories')->with('errors', " Your category has not been deleted. Your category has been used by another user! ");
        }
    }
}
