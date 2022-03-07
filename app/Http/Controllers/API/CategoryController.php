<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get all categories
    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    //get category by id
    public function getCategoryById($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    //add new category
    public function addNewCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);


        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json($category);
    }

    //update category
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if($category){
            $this->validate($request, [
                'name' => 'required',
            ]);
            $category->name = $request->name;
            $category->save();
            return response()->json($category);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    //delete category
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json($category);
    }
    
}
