<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(){
      $this->middleware('auth')->only(['destroy','store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    public function all()
    {
        $categories = Category::select()->orderBy('name')->get();

        return response()->json(array('categories' => $categories), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorySlug = str_slug(request('name'));

        $this->validate(request(), [
            'name'          => 'required|min:2',
            'description'   => 'required'
        ]);

        $category = Category::create([
            'name'          => strtolower(request('name')),
            'slug'          => $categorySlug,
            'description'   => request('description')
        ]);

        return response()->json([
            'category' => $category
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate(request(), [
            'name'          => 'required|min:2',
            'description'   => 'required'
        ]);

        $category = Category::findOrFail($category->id);
        $category->name          = strtolower(request('name'));
        $category->description   = request('description');
        $category->save();

        return response()->json([
            'category' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);

        // delete category
        $category->delete();

        return response()->json([
            'category'  => $category,
            'message'   => "Category Deleted"
        ], 200);

    }
}
