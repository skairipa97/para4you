<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    // Show the admin dashboard with products and orders
    
    public function admin()
    {
        // Fetch products and orders from the database
        $products = Product::all();
        $orders = Order::all();
        // dd($products, $orders); // Debugging data
        // Pass the data to the view
        return view('admin', compact('products', 'orders'));
    }

    // Store a new order
    public function storeOrder(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new order in the database
        Order::create($validated);

        // Redirect back to the admin dashboard
        return back();
    }
}
