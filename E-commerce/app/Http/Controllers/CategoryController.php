<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if (!$category) {
            return back()->with('error', 'Category not created.');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $isUpdated = $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'Category not updated.');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy($category)
    {
        $isDeleted = Category::destroy($category);

        if (!$isDeleted) {
            return back()->with('error', 'Category not deleted.');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
