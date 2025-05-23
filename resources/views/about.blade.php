@extends('layout')

@section('title', 'À propos - Para4You')

@section('page_styles')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
  .testimonials .img-wrap img {
  width: 100%; /* Makes the image responsive */
  height: auto; /* Maintains aspect ratio */
  max-width: 250px; /* Adjust max width to your desired size */
  border-radius: 50%;
  max-height: 300px; /* Makes the images circular */
  object-fit: cover; /* Ensures the image fits within the container */
  }
</style>
@endsection

@section('page_scripts')
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Swiper Initialization Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.init-swiper-tabs', {
      loop: true,
      speed: 600,
      autoHeight: true,
      autoplay: {
        delay: 5000,
      },
      slidesPerView: 'auto',
      pagination: {
        el: '.swiper-pagination',
      }
    });
  });
</script>
@endsection

@section('content')
<!-- About Section - Main content section -->
<section id="about-2" class="about-2 section">
<div class="container">
  <div class="container section-title" data-aos="fade-up">
    <h2>Qui sommes-nous?</h2>
    <h1>Notre Mission</h1>
  </div>
  <div class="content">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
        <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
          <div class="img">
            <img src="img/ab.jpeg" alt="circle image" class="img-fluid">
          </div>
        </div>
      </div>

      <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4" data-aos="fade-up">
        <div class="px-3">
          <span class="content-subtitle">Our Mission</span>
          <h2 class="content-title text-start">
          Nos produits de soin de la peau sont conçus pour révéler la beauté naturelle de chaque individu.
          </h2>
          <p class="lead">
          Que vous ayez la peau sèche, grasse, ou sensible, nos produits nourrissent, hydratent et revitalisent pour un teint éclatant de santé.           </p>
          <p class="mb-5">
           
          Offrez à votre peau le luxe qu'elle mérite avec nos soins efficaces et adaptés à tous les besoins, pour une expérience de soin unique et inoubliable.

          </p>
          <p>
            <a href="{{route('produits.index')}}" class="btn-get-started">Découvrez nos produits</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Features Section - Our services and benefits -->
<section id="tabs" class="tabs section light-background">
  <div class="container">
    <div class="container section-title" data-aos="fade-up">
      <h2>Nos Services</h2>
      <h1>Pourquoi Nous Choisir</h1>
    </div>
    <div class="row gap-x-lg-4 justify-content-between">
      <div class="col-lg-4 js-custom-dots">
           <a href="#about2" class="service-item link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
          <div class="service-icon color-1 mb-4">
            <i class="bi bi-droplet"></i>
          </div>
          <!-- /.icon -->
          <div class="service-contents">
            <h3>Des soins doux et efficaces</h3>
            <p>
              Transformez votre peau avec des produits conçus pour nettoyer, hydrater et revitaliser.
            </p>
          </div>
          <!-- /.service-contents-->
        </a>
        <!-- /.service -->

      <a href="#about2" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="100">
          <div class="service-icon color-2 mb-4">
            <i class="bi bi-basket"></i>
          </div>
          
          <div class="service-contents">
            <h3>Découvrez les meilleures marques</h3>
            <p>
              Choisissez parmi une sélection de produits de soins haut de gamme adaptés à tous les types de peau.
            </p>
          </div>
          
        </a> 
        <!-- /.service -->

        <a href="#About2" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="200">
          <div class="service-icon color-3 mb-4">
            <i class="bi bi-brightness-high"></i>
          </div>
          <!-- /.icon -->
          <div class="service-contents">
            <h3>Un éclat au quotidien</h3>
            <p>
              Obtenez une peau éclatante et en bonne santé grâce à des routines quotidiennes conçues pour des résultats durables.
            </p>
          </div>
          <!-- /.service-contents-->
        </a>
        <!-- /.service -->

        <a href="#about2" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="300">
          <div class="service-icon color-4 mb-4">
            <i class="bi bi-heart"></i>
          </div>
          <!-- /.icon -->
          <div class="service-contents">
            <h3>Chouchoutez votre peau</h3>
            <p>
              Offrez à votre peau l'attention qu'elle mérite avec des produits de soins naturels et respectueux.
            </p>
          </div>
          <!-- /.service-contents-->
        </a>
        <!-- /.service -->
      </div>

      <div class="col-lg-8">
        <div class="swiper init-swiper-tabs">
        <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoHeight": true,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        },
        "breakpoints": {
          "320": {
            "slidesPerView": 1,
            "spaceBetween": 40
          },
          "1200": {
            "slidesPerView": 1,
            "spaceBetween": 1
          }
        }
      }
    </script>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="img/ab1.jpeg" alt="Image" class="img-fluid">
            </div>
            <div class="swiper-slide">
              <img src="img/products.jpeg" alt="Image" class="img-fluid">
            </div>
            <div class="swiper-slide">
              <img src="img/glow.jpeg" alt="Image" class="img-fluid">
            </div>
            <div class="swiper-slide">
              <img src="img/girlglow.jpeg" alt="Image" class="img-fluid">
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('footer')
@include('footer')
@endsection
