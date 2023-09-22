<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::all();

            if(sizeof($products) == 0)
                return response()->json(["status" => false, "message" => "No products found."]);

            return response()->json(["status" => true, "message" => "Products listed successfully.", "data" => $products]);
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json(["status" => false, "message" => "Database Error: ".$e->getMessage()]);
        }
        catch(Exception $e)
        {
            return response()->json(["status" => false, "message" => "Server Error: ".$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            $product = new Product();

            $product->name = $request->name;
            $product->description = $request->description;
            $product->sku = $request->sku;
            $product->price = $request->price;
            
            if($product->save())
                return response()->json(["status" => true, "message" => "Product saved successfully."]);

            return response()->json(["status" => false, "message" => "Failed to save product."]);
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json(["status" => false, "message" => "Database Error: ".$e->getMessage()]);
        }
        catch(Exception $e)
        {
            return response()->json(["status" => false, "message" => "Server Error: ".$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $product = Product::find($id);

            if(!$product)
                return response()->json(["status" => false, "message" => "Product not found."]);

            return response()->json(["status" => true, "message" => "Product details successful.", "data" => $product]);
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json(["status" => false, "message" => "Database Error: ".$e->getMessage()]);
        }
        catch(Exception $e)
        {
            return response()->json(["status" => false, "message" => "Server Error: ".$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try{
            $product = Product::find($id);

            if(!$product)
                return response()->json(["status" => false, "message" => "Invalid product."]);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->sku = $request->sku;
            $product->price = $request->price;

            if($product->save())
                return response()->json(["status" => true, "message" => "Product updated successfully."]);

            return response()->json(["status" => false, "message" => "Failed to update product."]);
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json(["status" => false, "message" => "Database Error: ".$e->getMessage()]);
        }
        catch(Exception $e)
        {
            return response()->json(["status" => false, "message" => "Server Error: ".$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = Product::find($id);

            if(!$product)
                return response()->json(["status" => false, "message" => "Invalid product."]);

            if($product->delete())
                return response()->json(["status" => true, "message" => "Product deleted successfully."]);

            return response()->json(["status" => false, "message" => "Failed to delete product."]);
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json(["status" => false, "message" => "Database Error: ".$e->getMessage()]);
        }
        catch(Exception $e)
        {
            return response()->json(["status" => false, "message" => "Server Error: ".$e->getMessage()]);
        }
    }
}
