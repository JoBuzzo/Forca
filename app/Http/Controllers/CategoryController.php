<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('category.index', [
            'categories' => $categories
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        
        Category::Create([
            'description' => $request->description
        ]);

        return redirect()->route('category.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$category = Category::find($id)){
            return redirect()->route('category.index');
        }

        return view('category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!$category = Category::find($id)){
            return redirect()->route('category.index');
        }

        $request->validate([
            'description' => 'required',
        ]);

        $category->update([
            'description' => $request->description
        ]);

        return redirect()->route('category.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$category = Category::find($id)){
            return redirect()->route('category.index');
        }

        $category->delete();

        return redirect()->route('category.index');
    }
}
