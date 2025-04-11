<style>
  .testimonials {
    background-color: #f8f9fa;
    padding: 80px 0;
  }
  
  .testimonials .img-wrap {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .testimonials .img-wrap img {
    width: 100%; /* Makes the image responsive */
    height: auto; /* Maintains aspect ratio */
    max-width: 150px; /* Adjust max width to your desired size */
    border-radius: 50%;
    max-height: 150px; /* Makes the images circular */
    object-fit: cover; /* Ensures the image fits within the container */
    margin: 0 auto;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }
  
  .testimonials .name {
    font-size: 18px;
    font-weight: 700;
    margin-top: 10px;
    margin-bottom: 5px;
    text-align: center;
    color: #2d3142;
  }
  
  .testimonials blockquote {
    font-style: italic;
    text-align: center;
    position: relative;
    padding: 20px;
    margin-bottom: 30px;
  }
  
  .testimonials blockquote p {
    margin-bottom: 0;
    color: #555;
    font-size: 16px;
    line-height: 1.6;
  }
  
  .testimonials .section-title p {
    color: #c98eb6;
    font-weight: 600;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-size: 14px;
  }
  
  .testimonials .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
  }
  
  .testimonials .section-title h2:after {
    content: '';
    position: absolute;
    width: 50px;
    height: 3px;
    background-color: #c98eb6;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
  }
  
  .testimonials .testimonial {
    max-width: 600px;
    margin: 0 auto;
  }
  
  .testimonials .swiper-pagination {
    margin-top: 30px;
  }
  
  .testimonials .swiper-pagination-bullet {
    background: #c98eb6;
    opacity: 0.5;
  }
  
  .testimonials .swiper-pagination-bullet-active {
    opacity: 1;
  }
</style>
<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <p>Happy Customers</p>
      <h2>Avis</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
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
                <div class="testimonial mx-auto">
                  <figure class="img-wrap">
                    <img src="img/cat.jpeg" alt="Image" class="img-fluid">
                  </figure>
                  <h3 class="name">Adam Aderson</h3>
                  <blockquote>
                    <p>
                      "There live the blind texts. Separated they live in
                      Bookmarksgrove right at the coast of the Semantics, a large
                      language ocean."
                    </p>
                  </blockquote>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="testimonial mx-auto">
                  <figure class="img-wrap">
                    <img src="img/cat.jpeg" alt="Image" class="img-fluid">
                  </figure>
                  <h3 class="name">Lukas Devlin</h3>
                  <blockquote>
                    <p>
                      "There live the blind texts. Separated they live in
                      Bookmarksgrove right at the coast of the Semantics, a large
                      language ocean."
                    </p>
                  </blockquote>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="testimonial mx-auto">
                  <figure class="img-wrap">
                    <img src="img/cat.jpeg" alt="Image" class="img-fluid">
                  </figure>
                  <h3 class="name">Kayla Bryant</h3>
                  <blockquote>
                    <p>
                      "There live the blind texts. Separated they live in
                      Bookmarksgrove right at the coast of the Semantics, a large
                      language ocean."
                    </p>
                  </blockquote>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /Testimonials Section -->
  <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Find all swiper-config elements on the page
    document.querySelectorAll(".swiper-config").forEach(function(configEl) {
      if (configEl.closest(".init-swiper")) {
        const swiperConfig = JSON.parse(configEl.textContent);
        const swiperContainer = configEl.closest(".init-swiper");
        new Swiper(swiperContainer, swiperConfig);
      }
    });
  });
</script>