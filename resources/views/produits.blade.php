@extends('layout')
@section('title', 'Para4You')
<style>
  /* Ajouter un style de bouton rose */
.btn-pink {
    background-color:#c98eb6; /* Couleur rose */
    color: white; /* Texte blanc */
    border: none; /* Retirer les bordures */
    padding: 10px 20px; /* Ajouter de l'espace autour du texte */
    border-radius: 25px; /* Bords arrondis */
    font-weight: bold; /* Mettre en gras le texte */
    text-transform: uppercase; /* Mettre le texte en majuscule */
    transition: background-color 0.3s, transform 0.2s; /* Ajout d'une transition pour un effet doux */
}

.btn-pink:hover {
    background-color:#c98eb6; /* Couleur rose plus foncée au survol */
    transform: scale(1.05); /* Légère augmentation de la taille lors du survol */
}

</style>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Active
  * Template URL: https://bootstrapmade.com/active-bootstrap-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js"></script>

  @section('content')
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
      <div class="container">

        <form action="{{ route('produits.index') }}" method="GET">
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
              <li data-filter="*" class="filter-active">
                  <button type="submit" name="category" value="*" class='btn-pink'>All</button>
              </li data-filter=".filter-app">
              @foreach ($categories as $category)
                  <li>
                      <button type="submit" name="category" value="{{ $category }}" class='btn-pink'>{{ ucfirst($category) }}</button>
                  </li>
              @endforeach
          </ul>
        </form>

        <!-- Portfolio Items -->
        <div class="portfolio-items">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower($product->category) }}">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Price: ${{ $product->price }}</strong></p>
                            <a href="#" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End Portfolio Items -->

      </div>
    </section>
    <!-- End Portfolio Section -->

@include('avis')
@include('footer')
@endsection
