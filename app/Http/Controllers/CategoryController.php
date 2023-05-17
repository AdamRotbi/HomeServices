<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        
        return view('categories.index',compact('categories'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Category $category): View
    {
        return view('categories.show',compact('categories'));
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
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'cimages/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }


        $category = Category::create($input);
        

        return redirect()->route('categories.index')->with("category-create-success", "The Category " . strtolower($category['name']) . " is created successfully");
    }

    public function editCategory(Category $category): View
    {
        return view('categories.edit',compact('categories'));
    }


 

    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, Category $category): RedirectResponse
{
    $request->validate([
        'name' => 'required',
        
    ]);

    $input = $request->all();

    if ($image = $request->file('image')) {
        $destinationPath = 'cimages/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";
    }else{
        unset($input['image']);
    }
        
    $category->update($input);
  
    return redirect()->route('categories.index')
                    ->with('success','Product updated successfully');
}

public function destroy(Category $category): RedirectResponse
{
    $category->delete();
     
    return redirect()->route('categories.index')
                    ->with('success','Product deleted successfully');
}
   
}




