<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Mail\CategoryCreated;
use App\Mail\CategoryDeleted;
use App\Mail\CategoryUpdated;
use App\Models\Category;
use App\Models\User;
use App\Notifications\CategoryCreated as NotificationsCategoryCreated;
use App\Notifications\CategoryDeleted as NotificationsCategoryDeleted;
use App\Notifications\CategoryUpdated as NotificationsCategoryUpdated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::with('admin')->paginate(10);

        return view('admin.categories.index', compact('categories'));
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

    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'admin_id' => Auth::guard('admin')->id()
        ]);

        if (!$category) {
            return back()->with('error', 'Category not created.');
        }

        $admins = User::where('role', 'admin')->get();
        $admin_name = Auth::guard('admin')->user()->name;

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new CategoryCreated($admin, $category, $admin_name));

            Notification::send($admin, new NotificationsCategoryCreated($category, $admin_name));
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(string $uuid)
    {
        $category = Category::where('uuid', $uuid)->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, string $uuid)
    {
        $category = Category::where('uuid', $uuid)->firstOrFail();

        $isUpdated = $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'Category not updated.');
        }

        $admins = User::where('role', 'admin')->get();
        $admin_name = Auth::guard('admin')->user()->name;

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new CategoryUpdated($admin, $category, $admin_name));

            Notification::send($admin, new NotificationsCategoryUpdated($category, $admin_name));
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $uuid)
    {
        $category = Category::where('uuid', $uuid)->firstOrFail();
        $category_name = $category->name;

        $isDeleted = $category->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Category not deleted.');
        }

        $admins = User::where('role', 'admin')->get();
        $admin_name = Auth::guard('admin')->user()->name;

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new CategoryDeleted($admin, $category_name, $admin_name));

            Notification::send($admin, new NotificationsCategoryDeleted($category_name, $admin_name));
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
