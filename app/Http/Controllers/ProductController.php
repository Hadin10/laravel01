<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'product_name.*' => 'required', 
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
            'including_price.*' => 'required|numeric|min:0',
            'selling_price.*' => 'required|numeric|min:0',
            'total_cost.*' => 'required|numeric|min:0',
        ]);

        foreach ($request->product_name as $key => $value) {
            if (isset($request->quantity[$key])) {
            
            $product = new Product();
            $product->name = $request->product_name[$key];
            $product->quantity = $request->quantity[$key];
            $product->price = $request->total_cost[$key];
            
            $product->save();
        }
        }

      
        $products = Product::all();
    return view('products.index', compact('products'))->with('success', 'Products added successfully.');
    }
}
