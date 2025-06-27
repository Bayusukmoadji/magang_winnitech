<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Winntech - Breaking News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/news.css') }}">
</head>
<body>
    <video autoplay muted loop playsinline id="background-video-news">
        <source src="{{ asset('assets/img/bg2.mp4') }}" type="video/mp4" />
        Browser Anda tidak mendukung tag video.
    </video>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg py-2 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/winntech.png') }}" alt="Winntech Logo" class="logo-img" loading="lazy"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbarContent">
                <form class="d-flex my-2 my-lg-0 ms-lg-3 me-lg-auto" id="navSearchForm">
                    <div class="search-input-container position-relative">
                        <input
                            class="form-control"
                            type="search"
                            name="query"
                            placeholder="Search Article..."
                            aria-label="Search"
                            id="globalSearchInput"
                            value="{{ request('query') }}"
                        />
                        <button type="submit" class="search-icon-btn"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('front.news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('front.techstocks') }}">TechStocks</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('front.launches') }}">Launches</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <section class="container-lg my-5 text-white">
        {{-- CAROUSEL --}}
        <div class="position-relative mb-4 mx-auto rounded-4 overflow-hidden" id="carousel-container" style="max-width: 900px; height: 500px">
            <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner h-100">
                    @foreach ($featuredArticles as $featured)
                        <div class="carousel-item h-100 position-relative {{ $loop->first ? 'active' : '' }}">
                            <a href="{{ route('front.details', $featured->slug) }}">
                                <img src="{{ asset('storage/' . $featured->image_path) }}" class="d-block w-100 h-100 object-fit-cover" alt="{{ $featured->title }}" />
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-4 gradient-overlay">
                                    <h5 class="mb-2 fw-semibold text-white">{{ $featured->title }}</h5>
                                    <p class="small m-0 text-white">Oleh: <strong>{{ $featured->author_name }}</strong> | {{ $featured->publication_date->format('j F Y') }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
            </div>
        </div>

        {{-- GRID BERITA DENGAN ID YANG BENAR --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4" id="news-article-grid">
            @foreach ($articles as $article)
                <div class="col">
                    <div class="card h-100 bg-dark text-white rounded-4">
                        <div class="news-card-image-container">
                            <a href="{{ route('front.details', $article->slug) }}">
                                <img src="{{ asset('storage/' . $article->image_path) }}" class="card-img-top rounded-top-4" alt="{{ $article->title }}" />
                            </a>
                            <div class="news-date-badge">{{ $article->publication_date->format('j F Y') }}</div>
                        </div>
                        <div class="card-body p-2">
                            <p class="card-text fw-semibold">{{ $article->title }}</p>
                            <p class="deskripsigrid">{{ $article->excerpt }}</p>
                            <p class="news-author-line small mb-0">Author: <strong>{{ $article->author_name }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- BAGIAN LOAD MORE --}}
        <div class="text-center mt-4 pt-2 pb-4" id="load-more-container">
            @if ($articles->hasMorePages())
                <button id="load-more-news-btn" class="btn btn-outline-themed" data-next-page-url="{{ $articles->nextPageUrl() }}">
                    Load More
                </button>
            @endif
        </div>
    </section>

    <template id="news-card-template">
    <div class="col">
        <div class="card h-100 bg-dark text-white rounded-4">
            <div class="news-card-image-container">
                <a class="card-link" href="#">
                    <img class="card-img-top rounded-top-4 card-image" src="" alt="">
                </a>
                <div class="news-date-badge"></div>
            </div>
            <div class="card-body p-2">
                <p class="card-text fw-semibold card-title"></p>
                <p class="deskripsigrid card-excerpt"></p>
                <p class="news-author-line small mb-0">Author: <strong class="card-author"></strong></p>
            </div>
        </div>
    </div>
</template>

    {{-- FOOTER --}}
   <footer class="footer pt-5 border-top">
    <div class="container px-3 px-md-5">
        <div class="row justify-content-center gy-5">

            {{-- Kolom 1: Logo & Deskripsi (Dibuat lebih lebar di tablet) --}}
            <div class="col-lg-4 col-md-12 d-flex flex-column align-items-center">
                <div class="d-flex align-items-center justify-content-center mb-3 footer-logos-container">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Winnicode Logo" class="img-fluid footer-logo-main" loading="lazy"/>
                    <img src="{{ asset('assets/img/km.png') }}" alt="Kampus Merdeka Logo" class="img-fluid footer-logo-km" loading="lazy"/>
                    <img src="{{ asset('assets/img/winntech.png') }}" alt="Winntech Logo Footer" class="img-fluid footer-logo-main" loading="lazy"/>
                </div>
                <p class="text-center mb-0 footer-description-text">
                    The Winnicode Journalism Program is a human resource development program aimed at young men and women pursuing careers in the world of reporting.
                </p>
            </div>

            {{-- Kolom 2: Follow Us (Rata tengah) --}}
            <div class="col-lg-4 col-md-6 text-center">
                <h5 class="footer-title">Follow us</h5>
                <div class="social-icons-group">
                    <div class="social-icons-row mb-2">
                        <a href="#"><i class="bi bi-twitter-x fs-4"></i></a>
                        <a href="#"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#"><i class="bi bi-telegram fs-4"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-4"></i></a>
                    </div>
                    <div class="social-icons-row">
                        <a href="#"><i class="bi bi-tiktok fs-4"></i></a>
                        <a href="#"><i class="bi bi-youtube fs-4"></i></a>
                        <a href="#"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="#"><i class="bi bi-line fs-4"></i></a>
                    </div>
                </div>
            </div>

            {{-- Kolom 3: Kategori (Rata tengah) --}}
            <div class="col-lg-4 col-md-6 text-center">
                <h5 class="footer-title-2">CATEGORIES</h5>
                <div class="listfoot">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('front.news') }}">News</a></li>
                        <li><a href="{{ route('front.techstocks') }}">TechStocks</a></li>
                        <li><a href="{{ route('front.launches') }}">Launches</a></li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Baris untuk Copyright --}}
        <div class="text-center mt-5">
            <div class="p-2">
                <small class="footer-copyright-text">
                    &copy; 2025 PT. Winnicode Garuda Teknologi. All rights reserved<br />
                    by Bayu Sukmo Adji
                </small>
            </div>
        </div>
    </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/news.js') }}"></script>
</body>
</html>
