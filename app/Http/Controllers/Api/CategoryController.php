<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return response()->json(['status' => 'success', 'data' => $categories], 200);
        // $categories = Category::when($request->keyword, function ($query) use ($request) {
        //     $query->where('name', 'like', "%{$request->keyword}%")
        //         ->orWhere('description', 'like', "%{$request->keyword}%");
        // })->orderBy('id', 'desc')->paginate(10);
        // return view('pages.categories.index', compact('categories'));
    }


    // public function create()
    // {
    //     return view('pages.categories.create');
    // }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',

    //     ]);

    //     Category::create($request->all());
    //     return redirect()->route('categories.index')->with('success', 'Category created successfully');
    // }

    // //edit
    // public function edit(Category $category)
    // {
    //     return view('pages.categories.edit', compact('category'));
    // }

    // //update
    // public function update(Request $request, Category $category)
    // {

    //     $category->name = $request->name;
    //     $category->description = $request->description;
    //     $category->save();

    //     return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    // }

    // //destroy
    // public function destroy(Category $category)
    // {
    //     $category->delete();
    //     return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    // }
}
