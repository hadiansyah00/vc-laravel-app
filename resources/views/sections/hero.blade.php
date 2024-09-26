

<section id="hero" class="mt-5 d-flex align-items-center">
    @foreach($frontendHero as $hero)
    <div class="container">
      <div class="row">
        <div class="order-2 pt-5 col-lg-6 pt-lg-0 order-lg-1 d-flex flex-column justify-content-center">
          <h1>{{ $hero->heading }}</h1>
          <h2>{{ $hero->subheading }}</h2>
          <p>{{ $hero->achievements }}</p>
          <div class="d-flex">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
            <a href="{{ $hero->path_video }}" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="order-1 col-lg-6 order-lg-2 hero-img">
            <img class="img-fluid animated" src="{{ Storage::url($hero->banner) }}" alt="{{ $hero->banner }}" class="object-contain h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
        </div>
      </div>
    </div>
    @endforeach
  </section><!-- End Hero -->
