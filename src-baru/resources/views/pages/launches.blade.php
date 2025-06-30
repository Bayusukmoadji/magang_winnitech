<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Winntech - Launch Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/launches.css') }}" />
</head>
<body>
    <video autoplay muted loop playsinline id="background-video-launches">
        <source src="{{ asset('assets/img/bg2.mp4') }}" type="video/mp4" />
        Browser Anda tidak mendukung tag video.
    </video>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg py-2 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/winntech.png') }}" alt="Winntech Logo" class="logo-img" loading="lazy"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbarContent">
                {{-- Form ini akan ditangani oleh JS --}}
                <form class="d-flex my-2 my-lg-0 ms-lg-3 me-lg-auto" id="navSearchForm">
                    <div class="search-input-container position-relative">
                        {{-- "Menambahkan id="globalSearchInput" --}}
                        <input class="form-control" type="search" name="query" placeholder="Search Product..." required id="globalSearchInput" />
                        <button type="submit" class="search-icon-btn"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('front.news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('front.techstocks') }}">TechStocks</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('front.launches') }}">Launches</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <div class="container my-5 launch-page-content">
        <h1 class="mb-4 text-center page-title">Technology Launch Schedule</h1>

        {{-- Grid untuk menampilkan semua produk peluncuran --}}
        <div class="row gy-4" id="launchCards">
            @forelse ($launches as $launch)
                <div class="col-md-6 col-lg-4">
                    <div class="card launch-card h-100">
                        <div class="launch-card-img-container">
                            <img src="{{ asset('storage/' . $launch->image_path) }}" class="card-img-top launch-card-image" alt="{{ $launch->title }}">
                            <div class="launch-date-badge">{{ $launch->launch_date->format('d M Y') }}</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title launch-title">{{ $launch->title }}</h5>
                            <p class="card-text launch-company">{{ $launch->company_name }}</p>
                            <p class="card-text launch-description">{{ $launch->short_description }}</p>
                        </div>
                        <div class="card-footer launch-card-footer">
                            {{-- Link ini akan kita fungsikan di langkah selanjutnya --}}
                            <a href="{{ route('launches.detail', $launch->slug) }}" class="btn btn-sm btn-secondary-themed w-100">
                                Read More <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center fs-4 mt-5">Belum ada jadwal peluncuran yang tersedia.</p>
                </div>
            @endforelse
        </div>

        {{-- Wadah untuk Tombol Load More --}}
        <div class="text-center mt-4 pt-2 pb-4" id="load-more-container">
            @if ($launches->hasMorePages())
                <button id="load-more-launches-btn" class="btn btn-outline-themed" data-next-page-url="{{ $launches->nextPageUrl() }}">
                    Load More
                </button>
            @endif
        </div>
    </div>

    {{-- Footer --}}
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
    <script src="{{ asset('assets/js/launches.js') }}"></script>
</body>
</html>
