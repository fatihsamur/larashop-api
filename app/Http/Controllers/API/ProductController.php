<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image = $request->image;
        $product->save();

        return response()->json($product);
   
    }

    // update product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
                'image' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
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

    // add new products
    public function addNewProducts(Request $request)
    {        
        $products = $request->products;
        $err_messages = [];
        foreach ($products as $key => $product) {
            $validator = Validator::make($product, [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
                'image' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                array_push($err_messages, $key, $validator->errors());
                continue;
            }
            $newProduct = new Product();
            $newProduct->name = $product['name'];
            $newProduct->category_id = $product['category_id'];
            $newProduct->price = $product['price'];
            $newProduct->description = $product['description'];
            $newProduct->image = $product['image'];
            $newProduct->save();
        }
           return  response()->json($err_messages);
    }

}
