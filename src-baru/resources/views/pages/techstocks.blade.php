<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>TechStock Central</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../assets/css/techstocks.css" />
  </head>
  <body>
    <video autoplay muted loop playsinline id="background-video-techstock">
      <source src="../assets/img/bg2.mp4" type="video/mp4" />
      Browser Anda tidak mendukung tag video.
    </video>
    <nav class="navbar navbar-expand-lg py-2 fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img
            src="../assets/img/winntech.png"
            alt="Winntech Logo"
            class="logo-img"
            loading="lazy"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mainNavbarContent"
          aria-controls="mainNavbarContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbarContent">
          <form
            class="d-flex position-relative my-2 my-lg-0 ms-lg-3 me-lg-auto"
            id="navSearchFormGlobal"
          >
            <input
              class="form-control rounded-cover ps-5"
              type="search"
              placeholder="Search News..."
              aria-label="Search"
              id="globalSearchInput"
            />
            <i
              class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"
            ></i>
          </form>
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a
                class="nav-link"
                aria-current="page"
                href="/news"
                >News</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/techstocks">TechStocks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/launches">Launches</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container my-5 p-5 m-5 py-5 techstock-page-content">
      <h1 class="mb-4 text-center page-title">Tech Stock Central</h1>
      <p
        id="noResultsMessageTeknologi"
        class="text-center p-5 no-results-message-techstock"
        style="display: none"
      >
        Tidak ada hasil saham ditemukan untuk pencarian Anda.
      </p>

      <div id="stock-cards" class="row gy-4"></div>
    </div>
    <footer class="footer pt-5 border-top">
      <div class="container px-3 px-md-5">
        <div class="row justify-content-center align-items-start gy-4 gx-md-5">
          <div class="col-md-3 d-flex flex-column align-items-center">
            <div
              class="d-flex align-items-center justify-content-center mb-2 footer-logos-container"
            >
              <img
                src="../assets/img/logo.png"
                alt="Winnicode Logo"
                class="img-fluid footer-logo-main"
                loading="lazy"
              />
              <img
                src="../assets/img/km.png"
                alt="Kampus Merdeka Logo"
                class="img-fluid footer-logo-km"
                loading="lazy"
              />
              <img
                src="../assets/img/winntech.png"
                alt="Winntech Logo Footer"
                class="img-fluid footer-logo-main"
                loading="lazy"
              />
            </div>
            <p class="text-center mb-0 footer-description-text">
              The Winnicode Journalism Program is a human resource development
              program aimed at young men and women pursuing careers in the world
              of reporting.
            </p>
          </div>
          <div class="col-md-4 text-center">
            <p class="fw-semibold mb-3 footer-title">Follow us</p>
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
          <div class="col-md-3">
            <h5 class="fw-bold text-start footer-title">CATEGORIES</h5>
            <div class="listfoot">
              <ul class="list-unstyled">
                <li><a href="/news">News</a></li>
                <li><a href="/techstocks">TechStocks</a></li>
                <li><a href="/launches">Launches</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="text-center mt-4">
          <div class="p-2">
            <small class="footer-copyright-text">
              &copy; 2025 PT. Winnicode Garuda Teknologi. All rights reserved
              <br />
              by Bayu Sukmo Adji
            </small>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/techstocks.js"></script>
  </body>
</html>
