<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $products= Product::all();
        $orders = Order::all(); // Fetch all orders
        return view('admin', compact('orders', 'products'));
    }

    public function create()
    {
        $products = Product::all(); // Get all products
        $users = User::all(); // Get all users
        return view('admin', compact('products', 'users')); // Pass both to the view
    }
    
    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer',
        'username' => 'required|exists:users,username', // Check if the username exists in the users table
    ]);

    // Get the user by username
    $user = User::where('username', $validated['username'])->first();

    // Create and store the order
    $order = new Order();
    $order->product_id = $validated['product_id'];
    $order->quantity = $validated['quantity'];
    $order->user_id = $user->id;  // Store the user_id
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}

    

}
