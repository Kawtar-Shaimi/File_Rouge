<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        try {
            $categories = Category::with('admin')->paginate(10);

            return view('admin.categories.index', compact('categories'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting categories try again later.');
        }
    }

    public function show(string $uuid)
    {
        $category = Category::where('uuid', $uuid)->firstOrFail();
        $category->load('admin');
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string'
            ]);

            $category = Category::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'description' => $request->description,
                'admin_id' => Auth::guard('admin')->id()
            ]);

            if (!$category) {
                return back()->with('error', 'Category not created.');
            }

            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while creating category try again later.');
        }
    }

    public function edit(string $uuid)
    {
        $category = Category::where('uuid', $uuid)->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->firstOrFail();

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

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while updating category try again later.');
        }
    }

    public function destroy(string $uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->firstOrFail();

            $isDeleted = $category->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Category not deleted.');
            }

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting category try again later.');
        }
    }
}
