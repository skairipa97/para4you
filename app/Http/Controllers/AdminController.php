<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with products and orders
     */
    public function admin()
    {
        // Fetch products with the latest ones first
        $products = Product::latest()->get();
        
        // Fetch orders with the latest ones first
        try {
            $orders = Order::with(['user', 'product'])->latest()->get();
        } catch (\Exception $e) {
            // Fallback if relations don't exist
            $orders = Order::latest()->get();
        }
        
        // Pass data to the view
        return view('admin', compact('products', 'orders'));
    }

    /**
     * Update the status of an order
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);
        
        $order = Order::findOrFail($id);
        $order->update(['status' => $validated['status']]);
        
        // Check if request is AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'order' => [
                    'id' => $order->id,
                    'status' => $order->status
                ]
            ]);
        }
        
        return redirect()->route('admin')->with('success', 'Order status updated successfully');
    }
    
    /**
     * Get order details for AJAX request
     */
    public function getOrderDetails($id)
    {
        $order = Order::findOrFail($id);
        $items = $order->products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->pivot->price,
                'quantity' => $product->pivot->quantity,
                'subtotal' => $product->pivot->price * $product->pivot->quantity
            ];
        });
        
        return response()->json([
            'order' => [
                'id' => $order->id,
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
                'address' => $order->shipping_address,
                'total' => $order->total_amount,
                'status' => $order->status,
                'created_at' => $order->created_at
            ],
            'items' => $items
        ]);
    }
    
    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        
        $monthlySales = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as revenue')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->get();
        
        $popularProducts = DB::table('products')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();
        
        return response()->json([
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'pendingOrders' => $pendingOrders,
            'monthlySales' => $monthlySales,
            'popularProducts' => $popularProducts,
        ]);
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
