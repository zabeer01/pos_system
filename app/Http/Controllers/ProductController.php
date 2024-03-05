<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $oldImagePath = $product->image;

 

        $path = "upload";

        // Handle 'image' upload
        if ($request->hasFile('product_img')) {
            $imageFile = $request->file('product_img');
            $imageName = uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($path, $imageName);
            $product->product_img = $path . '/' . $imageName;

            // Delete the old image after successful update
            if ($request->id && !empty($oldImagePath)) {
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $product->save();
        return redirect()->route('products.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    public function posSystem()
    {
        $products = Product::all();
        return view('products.pos',compact('products'));
    }

}
