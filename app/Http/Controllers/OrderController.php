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
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the order data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:card,paypal',
            'order_items' => 'required|json',
            'order_total' => 'required|numeric',
        ]);

        // Decode the order items
        $orderItems = json_decode($request->order_items, true);
        
        // Create a new order
        $order = new Order();
        
        // Set the user_id if the user is logged in
        if (session('user_id')) {
            $order->user_id = session('user_id');
        }
        
        // Set order details
        $order->order_number = 'ORD-' . time() . rand(100, 999);
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->phone = $request->phone;
        $order->payment_method = $request->payment_method;
        $order->total_amount = $request->order_total;
        $order->status = 'pending';
        $order->order_details = json_encode($orderItems);
        
        // Save the order
        $order->save();
        
        // Clear the cart in the session
        session()->forget('cart');
        
        // Redirect to a thank you page
        return view('orders.confirmation', [
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }

    

}
