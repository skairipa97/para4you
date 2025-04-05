@extends('layout')

@section('title', 'Admin Dashboard - Para4You')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
  :root {
    --primary: #ff1493;
    --secondary: #f8d8f9;
    --dark: #333;
    --light: #fff;
  }
  
  body {
    background-color: var(--secondary);
    background-image: url('img/bg.png');
    background-position: bottom right;
    background-repeat: no-repeat;
  }
  
  .admin-header {
    padding: 20px 0;
    margin-bottom: 30px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .admin-title {
    font-size: 28px;
    font-weight: bold;
    color: var(--dark);
  }
  
  .admin-logout {
    text-decoration: none;
    color: var(--dark);
    padding: 8px 15px;
    border-radius: 4px;
    background-color: rgba(0,0,0,0.05);
    transition: all 0.3s;
  }
  
  .admin-logout:hover {
    background-color: var(--primary);
    color: var(--light);
  }
  
  .admin-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
  }
  
  .admin-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    transition: transform 0.2s;
  }
  
  .admin-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
  }
  
  .card-title {
    font-size: 14px;
    color: #777;
    margin-bottom: 10px;
  }
  
  .card-value {
    font-size: 28px;
    font-weight: bold;
    color: var(--dark);
  }
  
  .admin-section {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    margin-bottom: 30px;
  }
  
  .btn-custom {
    background-color: var(--dark);
    color: var(--light);
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    transition: all 0.3s;
  }
  
  .btn-custom:hover {
    background-color: var(--primary);
    color: var(--light);
  }
  
  .status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  .status-pending {
    background-color: #ffeeba;
    color: #856404;
  }
  
  .status-processing {
    background-color: #b8daff;
    color: #004085;
  }
  
  .status-completed {
    background-color: #c3e6cb;
    color: #155724;
  }
  
  .status-cancelled {
    background-color: #f5c6cb;
    color: #721c24;
  }
  
  .management-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  .management-tab {
    padding: 10px 20px;
    background-color: rgba(0,0,0,0.05);
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
  }
  
  .management-tab.active, .management-tab:hover {
    background-color: var(--primary);
    color: var(--light);
  }
  
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .table th {
    background-color: rgba(0,0,0,0.03);
    padding: 12px;
    text-align: left;
    font-weight: 600;
  }
  
  .table td {
    padding: 12px;
    border-bottom: 1px solid rgba(0,0,0,0.05);
  }
  
  .table tr:hover {
    background-color: rgba(0,0,0,0.02);
  }
  
  .material-icons {
    font-size: 18px;
    cursor: pointer;
    transition: color 0.3s;
  }
  
  .material-icons:hover {
    color: var(--primary);
  }
</style>
@endsection

@section('content')
<div class="container">
  <div class="admin-header">
    <div class="admin-title">Admin Dashboard</div>
    <a href="{{ route('logout') }}" class="admin-logout">
      <i class="material-icons" style="font-size: 16px; vertical-align: text-bottom;">exit_to_app</i> Logout
    </a>
  </div>
  
  <!-- Stats Overview -->
  <div class="admin-stats">
    <div class="admin-card">
      <div class="card-title">TOTAL PRODUCTS</div>
      <div class="card-value">{{ count($products) }}</div>
    </div>
    
    <div class="admin-card">
      <div class="card-title">TOTAL ORDERS</div>
      <div class="card-value">{{ count($orders) }}</div>
    </div>
    
    <div class="admin-card">
      <div class="card-title">TOTAL REVENUE</div>
      <div class="card-value">${{ number_format($orders->sum('total_amount') ?? 0, 2) }}</div>
    </div>
    
    <div class="admin-card">
      <div class="card-title">PENDING ORDERS</div>
      <div class="card-value">{{ $orders->where('status', 'pending')->count() }}</div>
    </div>
  </div>

  <!-- Management Tabs -->
  <div class="management-tabs">
    <div class="management-tab active" onclick="showSection('products')">Products Management</div>
    <div class="management-tab" onclick="showSection('orders')">Orders Management</div>
  </div>

  <!-- Products Section -->
  <div id="products" class="admin-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="m-0">Product Inventory</h3>
      <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="material-icons" style="font-size: 16px; vertical-align: text-bottom;">add</i> Add Product
      </button>
    </div>
    
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Product</th>
          <th>Category</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>
              <button class="btn btn-sm" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-toggle="modal" data-target="#editProductModal">
                <i class="material-icons">edit</i>
              </button>
              <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm">
                  <i class="material-icons">delete</i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Orders Section -->
  <div id="orders" class="admin-section" style="display: none;">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="m-0">Order Management</h3>
      <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addOrderModal">
        <i class="material-icons" style="font-size: 16px; vertical-align: text-bottom;">add</i> Add Order
      </button>
    </div>
    
    <table class="table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer_name ?? ($order->user->name ?? 'N/A') }}</td>
            <td>${{ number_format($order->total_amount ?? 0, 2) }}</td>
            <td>
              <span class="status-badge status-{{ $order->status ?? 'pending' }}">
                {{ ucfirst($order->status ?? 'pending') }}
              </span>
            </td>
            <td>{{ $order->created_at->format('M d, Y') }}</td>
            <td>
              <a href="#" class="btn btn-sm view-order" data-id="{{ $order->id }}" title="View Details">
                <i class="material-icons">visibility</i>
              </a>
              <a href="#" class="btn btn-sm edit-status" data-id="{{ $order->id }}" title="Edit Status">
                <i class="material-icons">edit</i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal to Add Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addProductForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
          @csrf
          
          <!-- Product Name -->
          <div class="mb-3">
              <label for="productName" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="product_name" name="name" value="{{ old('name') }}" required>
          </div>

          <!-- Product Description -->
          <div class="mb-3">
              <label for="productDescription" class="form-label">Product Description</label>
              <textarea class="form-control" id="productDescription" name="description" required>{{ old('description') }}</textarea>
          </div>

          <!-- Product Price -->
          <div class="mb-3">
              <label for="productPrice" class="form-label">Product Price</label>
              <input type="number" class="form-control" id="product_price" name="price" value="{{ old('price') }}" required>
          </div>

          <!-- Category -->
          <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <select class="form-control" id="category" name="category" required>
                  <option value="Face" {{ old('category') == 'Face' ? 'selected' : '' }}>Face</option>
                  <option value="Lip" {{ old('category') == 'Lip' ? 'selected' : '' }}>Lip</option>
                  <option value="Body" {{ old('category') == 'Body' ? 'selected' : '' }}>Body</option>
                  <option value="Hair" {{ old('category') == 'Hair' ? 'selected' : '' }}>Hair</option>
              </select>
          </div>

          <!-- Product Image -->
          <div class="mb-3">
              <label for="productImage" class="form-label">Product Image</label>
              <input type="file" class="form-control" id="productImage" name="image">
          </div>

          <button type="submit" class="btn btn-custom">Save Product</button>
        </form>

        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Modal to Add Order -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addOrderForm" method="POST" action="{{ route('orders.store') }}">
          @csrf

          <div class="mb-3">
              <label for="customer_name" class="form-label">Customer Name</label>
              <input type="text" class="form-control" id="customer_name" name="customer_name" required>
          </div>

          <div class="mb-3">
              <label for="product_id" class="form-label">Product</label>
              <select class="form-control" id="product_id" name="product_id" required>
                  @foreach($products as $product)
                      <option value="{{ $product->id }}">{{ $product->name }} - ${{ number_format($product->price, 2) }}</option>
                  @endforeach
              </select>
          </div>

          <div class="mb-3">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
          </div>

          <button type="submit" class="btn btn-custom">Save Order</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Order Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateStatusForm" method="POST">
          @csrf
          @method('PATCH')
          
          <div class="mb-3">
            <label class="form-label">Order Status</label>
            <select class="form-control" name="status" required>
              <option value="pending">Pending</option>
              <option value="processing">Processing</option>
              <option value="completed">Completed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          
          <button type="submit" class="btn btn-custom">Update Status</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="orderDetailsContent">
        <div class="text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
  // Switch between Product and Order Sections
  function showSection(section) {
    if (section === 'products') {
      document.getElementById('products').style.display = 'block';
      document.getElementById('orders').style.display = 'none';
      document.querySelector('.management-tab:nth-child(1)').classList.add('active');
      document.querySelector('.management-tab:nth-child(2)').classList.remove('active');
    } else {
      document.getElementById('products').style.display = 'none';
      document.getElementById('orders').style.display = 'block';
      document.querySelector('.management-tab:nth-child(1)').classList.remove('active');
      document.querySelector('.management-tab:nth-child(2)').classList.add('active');
    }
  }
  
  // Edit product functionality
  document.addEventListener('DOMContentLoaded', function() {
    // Handle edit status button clicks
    const editStatusButtons = document.querySelectorAll('.edit-status');
    editStatusButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const orderId = this.getAttribute('data-id');
        const form = document.getElementById('updateStatusForm');
        form.action = `/admin/orders/${orderId}/status`;
        
        const modal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
        modal.show();
      });
    });
    
    // Handle view order button clicks
    const viewOrderButtons = document.querySelectorAll('.view-order');
    viewOrderButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const orderId = this.getAttribute('data-id');
        const detailsContent = document.getElementById('orderDetailsContent');
        
        // Show loading spinner
        detailsContent.innerHTML = `
          <div class="text-center">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        `;
        
        // Open the modal
        const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
        modal.show();
        
        // Fetch order details
        fetch(`/admin/orders/${orderId}/details`)
          .then(response => response.json())
          .then(data => {
            const order = data.order;
            const items = data.items;
            
            let itemsHtml = '';
            let total = 0;
            
            items.forEach(item => {
              itemsHtml += `
                <tr>
                  <td>${item.name}</td>
                  <td>$${item.price.toFixed(2)}</td>
                  <td>${item.quantity}</td>
                  <td>$${item.subtotal.toFixed(2)}</td>
                </tr>
              `;
              total += item.subtotal;
            });
            
            detailsContent.innerHTML = `
              <div class="row">
                <div class="col-md-6">
                  <h6>Order Information</h6>
                  <p><strong>Order ID:</strong> #${order.id}</p>
                  <p><strong>Date:</strong> ${new Date(order.created_at).toLocaleDateString()}</p>
                  <p><strong>Status:</strong> 
                    <span class="status-badge status-${order.status}">
                      ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}
                    </span>
                  </p>
                </div>
                <div class="col-md-6">
                  <h6>Customer Information</h6>
                  <p><strong>Name:</strong> ${order.name}</p>
                  <p><strong>Email:</strong> ${order.email}</p>
                  <p><strong>Address:</strong> ${order.address}</p>
                </div>
              </div>
              
              <h6 class="mt-4">Order Items</h6>
              <table class="table">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  ${itemsHtml}
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong>$${total.toFixed(2)}</strong></td>
                  </tr>
                </tfoot>
              </table>
            `;
          })
          .catch(error => {
            detailsContent.innerHTML = `
              <div class="alert alert-danger">
                Error loading order details. Please try again.
              </div>
            `;
            console.error('Error fetching order details:', error);
          });
      });
    });
  });
</script>
@endsection