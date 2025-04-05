@extends('layout')

@section('title', 'Shop - Para4You')

@section('page_styles')
<style>
    .product-card {
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .product-card .card-img-container {
        height: 250px;
        overflow: hidden;
        position: relative;
    }
    
    .product-card .card-img-top {
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .product-card .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-card .card-title {
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }
    
    .product-card .card-text {
        color: #6c757d;
        margin-bottom: 15px;
        flex-grow: 1;
    }
    
    .product-card .price {
        font-weight: 700;
        color: var(--primary);
        font-size: 1.25rem;
        margin-bottom: 15px;
        display: block;
    }
    
    .product-card .card-footer {
        border-top: none;
        background: none;
        padding-top: 0;
    }
    
    .category-filter {
        margin-bottom: 40px;
    }
    
    .btn-category {
        padding: 8px 20px;
        margin: 0 5px 10px;
        border-radius: 25px;
        font-weight: 500;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #212529;
        transition: all 0.3s ease;
    }
    
    .btn-category:hover, .btn-category.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    
    .shop-header {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/shop-banner.jpg');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        margin-bottom: 50px;
        position: relative;
    }
    
    .shop-header h1 {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .shop-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        z-index: 2;
    }
    
    .badge-new {
        background-color: var(--primary);
        color: white;
    }
    
    .badge-sale {
        background-color: #dc3545;
        color: white;
    }
    
    .original-price {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.9rem;
        margin-right: 8px;
    }
</style>
@endsection

@section('content')
<!-- Shop Header Section -->
<section class="shop-header text-center">
    <div class="container">
        <h1 data-aos="fade-up">Our Products</h1>
        <p data-aos="fade-up" data-aos-delay="100">Discover our curated collection of premium beauty and personal care products designed to enhance your natural beauty.</p>
    </div>
</section>

<!-- Products Section -->
<section class="products-section py-5">
    <div class="container">
        <!-- Category Filters -->
        <div class="category-filter text-center" data-aos="fade-up">
            <form action="{{ route('produits.index') }}" method="GET" class="d-inline-block">
                <button type="submit" name="category" value="*" class="btn btn-category {{ request('category') == '*' || !request('category') ? 'active' : '' }}">
                    All Products
                </button>
                
                @foreach ($categories as $category)
                    <button type="submit" name="category" value="{{ $category }}" class="btn btn-category {{ request('category') == $category ? 'active' : '' }}">
                        {{ ucfirst($category) }}
                    </button>
                @endforeach
            </form>
        </div>
        
        <!-- Products Grid -->
        <div class="row g-4">
            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <div class="card product-card h-100">
                            <div class="card-img-container">
                                @if($loop->iteration % 5 == 0)
                                    <span class="product-badge badge-sale">Sale</span>
                                @elseif($loop->iteration % 4 == 0)
                                    <span class="product-badge badge-new">New</span>
                                @endif
                                
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                                
                                @if($loop->iteration % 5 == 0)
                                    <span class="price">
                                        <span class="original-price">${{ number_format($product->price * 1.2, 2) }}</span>
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                @else
                                    <span class="price">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            
                            <div class="card-footer d-flex justify-content-between">
                                <button class="btn btn-outline-primary add-to-cart" 
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->price }}"
                                    data-product-image="{{ asset('storage/' . $product->image) }}">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                                <button class="btn btn-outline-dark">
                                    <i class="bi bi-eye"></i> Details
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <h3>No products found</h3>
                    <p>We couldn't find any products matching your criteria. Please try another category.</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
</section>

@include('avis')
@include('footer')
@endsection

@section('page_scripts')
<script>
    // Add specific scripts for the products page if needed
</script>
@endsection
