
@section('title', 'Dashboard')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      background-color: #f8d8f9;
	  background-image:url('img\\bg.png'); /* Replace 'your-image-url.jpg' with the actual URL or path of your image */
        /* background-size: cover;  */
        background-position: bottom right; /* Centers the image */
        background-repeat: no-repeat;
    }
    .table {
      background-color: #ffffff;
    }
    .btn-custom {
      background-color:rgb(0, 0, 0);
      color: white;
    }
    .btn-custom:hover {
      background-color: #ff1493;
    }
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>

<div class="container">
  <h1 class="text-center text-pink mb-4">Hello Admin!</h1>
  <a href="{{ route('logout') }}">Logout</a>

  <!-- Navigation Buttons -->
  <div class="mb-4">
    <button class="btn btn-custom" onclick="showSection('products')">Gestion Produits</button>
    <button class="btn btn-custom" onclick="showSection('orders')">Gestion Commandes</button>
  </div>
<!-- Products Section -->
<div id="products" class="management-section">
  <button class="btn btn-custom mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th>
          <span class="custom-checkbox">
            <input type="checkbox" id="selectAllProducts">
            <label for="selectAllProducts"></label>
          </span>
        </th>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="productTableBody">
      @foreach($products as $product)
        <tr>
          <td>
            <span class="custom-checkbox">
              <input type="checkbox" id="checkboxProduct{{ $product->id }}" name="options[]" value="{{ $product->id }}">
              <label for="checkboxProduct{{ $product->id }}"></label>
            </span>
          </td>
          <td>{{ $product->name }}</td>
          <td>${{ number_format($product->price, 2) }}</td>
          <td>
            <!-- Add Edit and Delete actions -->
            <button class="btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-toggle="modal" data-target="#editProductModal">
          <i class="material-icons" title="Edit">&#xE254;</i>
        </button>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit">
                <i class="material-icons" title="Delete">&#xE872;</i>
              </button>
            </form>
            
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Pagination and Product Count Info -->
  <div class="clearfix">
    <div class="hint-text">
      Showing <b>{{$product->count()}}</b> of <b>{{$product->count()}}</b> entries
    </div>

    
  </div>
</div>


  <!-- Orders Section -->
  <div id="orders" class="management-section" style="display: none;">
    <button class="btn btn-custom mb-3" data-bs-toggle="modal" data-bs-target="#addOrderModal">Add Order</button>
    <table class="table table-striped table-hover mt-4">
      <thead>
        <tr>
          <th>
            <span class="custom-checkbox">
              <input type="checkbox" id="selectAllOrders">
              <label for="selectAllOrders"></label>
            </span>
          </th>
          <th>Customer Id</th>
          <th>Customer</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="orderTableBody">
    @foreach($orders as $order)
        <tr>
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkboxOrder{{ $order->id }}" name="options[]" value="{{ $order->id }}">
                    <label for="checkboxOrder{{ $order->id }}"></label>
                </span>
            </td>
            <td>{{ $order->user->id }} </td>
            <!-- Display user ID and username -->
            <td>{{ $order->user->username }}</td> <!-- Assuming relationship with User model -->
            
            <!-- Display product name -->
            <td>{{ $order->product->name }}</td> <!-- Assuming you have a relation between orders and products -->
            
            <!-- Display quantity -->
            <td>{{ $order->quantity }}</td>
            
            <!-- Action buttons -->
            <td>
                <a href="#editOrderModal" class="edit" data-toggle="modal"><i class="material-icons" title="Edit">&#xE254;</i></a>
                <a href="#deleteOrderModal" class="delete" data-toggle="modal" onclick="deleteOrder({{ $order->id }})"><i class="material-icons" title="Delete">&#xE872;</i></a>
            </td>
        </tr>
    @endforeach
</tbody>


    </table>
    <div class="clearfix">
      <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
    </div>
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
      <form id="addProductForm" method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($product)) <!-- Check if we are editing an existing product -->
        @method('PUT') <!-- Use PUT method for updating -->
        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
    @endif

    <!-- Product Name -->
    <div class="mb-3">
        <label for="productName" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="name" value="{{ isset($product) ? $product->name : old('name') }}" required>
    </div>

    <!-- Product Description -->
    <div class="mb-3">
        <label for="productDescription" class="form-label">Product Description</label>
        <textarea class="form-control" id="productDescription" name="description" required>{{ isset($product) ? $product->description : old('description') }}</textarea>
    </div>

    <!-- Product Price -->
    <div class="mb-3">
        <label for="productPrice" class="form-label">Product Price</label>
        <input type="number" class="form-control" id="product_price" name="price" value="{{ isset($product) ? $product->price : old('price') }}" required>
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-control" id="category" name="category" required>
            <option value="Face" {{ (isset($product) && $product->category == 'Face') ? 'selected' : (old('category') == 'Face' ? 'selected' : '') }}>Face</option>
            <option value="Lip" {{ (isset($product) && $product->category == 'Lip') ? 'selected' : (old('category') == 'Lip' ? 'selected' : '') }}>Lip</option>
            <option value="Body" {{ (isset($product) && $product->category == 'Body') ? 'selected' : (old('category') == 'Body' ? 'selected' : '') }}>Body</option>
            <option value="Hair" {{ (isset($product) && $product->category == 'Hair') ? 'selected' : (old('category') == 'Hair' ? 'selected' : '') }}>Hair</option>
        </select>
    </div>

    <!-- Product Image -->
    <div class="mb-3">
        <label for="productImage" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="productImage" name="image">
        @if(isset($product) && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="width: 100px; margin-top: 10px;">
        @endif
    </div>

    <button type="submit" class="btn btn-custom">{{ isset($product) ? 'Save Changes' : 'Save Product' }}</button>
</form>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
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
        <label for="username" class="form-label">Customer Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>

    <div class="mb-3">
        <label for="orderProduct" class="form-label">Product</label>
        <select class="form-control" id="orderProduct" name="product_id" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="orderQuantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="orderQuantity" name="quantity" required>
    </div>

    <button type="submit" class="btn btn-custom">Save Order</button>
</form>


      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
  const products = [];
  const orders = [];

  // Switch between Product and Order Sections
  function showSection(section) {
    if (section === 'products') {
      document.getElementById('products').style.display = 'block';
      document.getElementById('orders').style.display = 'none';
    } else {
      document.getElementById('products').style.display = 'none';
      document.getElementById('orders').style.display = 'block';
    }
  }
  $(document).on('click', '.edit-btn', function () {
  // Get the product data from the clicked button
  const id = $(this).data('id');
  const name = $(this).data('name');
  const price = $(this).data('price');

  // Set the form action for updating
  $('#productForm').attr('action', '/products/' + id);

  // Populate the form with the existing product details
  $('#product_id').val(id);
  $('#product_name').val(name);
  $('#product_price').val(price);

  // Change the button text to "Save Changes"
  $('#submitButton').text('Save Changes');
});

</script>