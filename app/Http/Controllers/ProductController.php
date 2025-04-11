<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(Request $request)
    {

        // Get the selected category from the request (default to all if not provided)
        $category = $request->get('category', '*');
    
        // Fetch products based on the selected category with pagination
        if ($category === '*') {
            $products = Product::paginate(12); // Increased pagination to show more products
        } else {
            $products = Product::where('category', $category)->paginate(12); // Filter by category and paginate
        }
    
        // Get all available categories for the filter
        $categories = Product::select('category')->distinct()->get()->pluck('category');
        
        $totalProducts = Product::count();

    
        // Pass variables to the view
        return view('produits', compact('products', 'categories', 'totalProducts'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Find the product by ID and update its details
        $product = Product::findOrFail($id);
        $product->update($validated);

        // Redirect back with a success message
        return redirect()->route('admin')->with('success', 'Product updated successfully!');
    }



    public function create()
    {
        // Define categories
        $categories = ['Face', 'Lip', 'Body', 'Hair'];




        // Pass categories to the view
        return view('admin.create-product', compact('categories'));
    }

    // Store the product in the database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|in:Face,Lip,Body,Hair',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure valid image
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store the product
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('products', 'public');
            $product->image = $filePath;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }
    public function destroy(Product $product)
    {
        // Delete the product from the database
        $product->delete();

        // Redirect back with a success message
        return back()->with('success', 'Product deleted successfully!');
    }
}
