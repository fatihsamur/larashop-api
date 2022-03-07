<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Get all products
    public function getAllProducts()
    {
        $products = DB::table('products')->paginate(10);
        return response()->json($products);
    }

    // Get product by category
    public function getProductsByCategory($category)
    {
        $products = DB::table('products')->where('category_id', $category)->paginate(10);
        return response()->json($products);
    }

    // Get product by id
    public function getProductById($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }


    // admin functions
    // add new product
    public function addNewProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->save();
        return response()->json($product);
    }

    // update product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->image = $request->image;
            $product->save();
            return response()->json($product);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

    // delete product
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }

}
