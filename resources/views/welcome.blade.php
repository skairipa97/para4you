@extends('layout')
@section('title', 'Para4You')

@section('page_styles')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<style>
    header{
        background:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img\\bann.jpeg');
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat;
        color: white;
    }
    
    header h1, header p {
        color: white !important;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }
    
    /* Product card buttons only */
    .card .btn-outline-dark:hover {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
    }
    
    /* Add space between sections */
    .section {
        padding: 80px 0;
    }
</style>
@endsection

@section('content')

<header class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center" data-aos="fade-in" data-aos-duration="1200">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal mb-0">With this shop homepage template</p>
        </div>
    </div>
</header>

<!-- Products Section -->
<section id="top-products" class="products-section section">
  <div class="container section-title mt-5" data-aos="fade-up">
    <h2>Nos Produits</h2>
    <h1>Top Sales</h1>
  </div><!-- End Section Title -->
  <div class="container" id='topSales'>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="img\laneige.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Fancy Product</h5>
                        <!-- Product price-->
                        $40.00 - $80.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100">
                <!-- Sale badge-->
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <!-- Product image-->
                <img class="card-img-top" src="img\pp.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Special Item</h5>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        <span class="text-muted text-decoration-line-through">$20.00</span>
                        $18.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100">
                <!-- Sale badge-->
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <!-- Product image-->
                <img class="card-img-top" src="img\ordinary.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Sale Item</h5>
                        <!-- Product price-->
                        <span class="text-muted text-decoration-line-through">$50.00</span>
                        $25.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="400">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="img\antiage.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Popular Item</h5>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        $40.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100">
                <!-- Sale badge-->
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <!-- Product image-->
                <img class="card-img-top" src="img\pp1.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Sale Item</h5>
                        <!-- Product price-->
                        <span class="text-muted text-decoration-line-through">$50.00</span>
                        $25.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="img\Bodywash.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Fancy Product</h5>
                        <!-- Product price-->
                        $120.00 - $280.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100">
                <!-- Sale badge-->
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <!-- Product image-->
                <img class="card-img-top" src="img\salicic.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Special Item</h5>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        <span class="text-muted text-decoration-line-through">$20.00</span>
                        $18.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
            </div>
        </div>
        <div class="col mb-5" data-aos="fade-up" data-aos-delay="400">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="img\pp3.jpeg" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">Popular Item</h5>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        $40.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
  
@include('partials.about-preview')

@include('avis')

@endsection

@section('page_scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  });
</script>
@endsection

@section('footer')
@include('footer')
@endsection

<!-- End of .container -->