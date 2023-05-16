<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        return view('categories.show', compact('categories'));
    }

    public function createCategory()
    {
        return view('categories.create');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $image = $request->file('image');
        $filename = time() . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/images', $filename);

        $category = Category::create([
            'name' => $request->input('name'),
            'image' => $filename,
        ]);

        return redirect()->route('categories-show')->with("category-create-success", "The Category " . strtolower($category['name']) . " is created successfully");
    }

    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.dashboards.admin.categories.update', compact('category'));
    }

    public function editCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $category->name = $request->input('name');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $filename);

            Storage::delete('public/images/' . $category->image);
            $category->image = $filename;
        }

        $category->save();

        return redirect()->route('dashboard-admin-categories-show')->with("category-update-success", "Category updated successfully");
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $categoryName = $category->name;

        if ($category->image) {
            Storage::delete('public/images/' . $category->image);
        }

        $category->delete();

        return redirect()->route('dashboard-admin-categories-show')->with('category-delete-success', "The Category " . strtolower($categoryName) . " is deleted successfully");
    }
}
