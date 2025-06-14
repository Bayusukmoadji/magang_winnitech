<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Winntech - Launch Schedule</title>
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
    <link rel="stylesheet" href="../assets/css/launches.css" />
  </head>
  <body>
    <video autoplay muted loop playsinline id="background-video-launches">
      <source src="../assets/img/bg2.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>

    <!-- ====================
 Navbar
 ===================== -->
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
              <a class="nav-link" href="/techstocks">TechStocks</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link active" href="/launches">Launches</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- ====================
 Navbar
 ===================== -->

    <!-- ====================
 content
 ===================== -->
    <div class="container my-5 launch-page-content">
      <h1 class="mb-4 text-center page-title">Technology Launch Schedule</h1>

      <p
        id="noResultsMessageLaunches"
        class="text-center no-results-message-launches"
        style="display: none"
      >
        No launch products found matching your search.
      </p>
      <div class="row gy-4" id="launchCards">
        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="MacBook Pro M4 Launch"
              />
              <div class="launch-date-badge">Oct 15, 2025</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">MacBook Pro M4</h5>
              <p class="card-text launch-company">Apple Inc.</p>
              <p class="card-text launch-description">
                The latest generation MacBook Pro with the revolutionary M4
                chip, an enhanced Liquid Retina XDR display, and a new thermal
                design.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="Samsung Galaxy S26 Ultra"
              />
              <div class="launch-date-badge">Jan 20, 2026</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">Galaxy S26 Ultra</h5>
              <p class="card-text launch-company">Samsung Electronics</p>
              <p class="card-text launch-description">
                Samsung's latest flagship with significant camera upgrades,
                Snapdragon Gen 5 performance, and advanced AI integration.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="NVIDIA RTX 6090"
              />
              <div class="launch-date-badge">Nov 05, 2025</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">NVIDIA RTX 6090</h5>
              <p class="card-text launch-company">NVIDIA Corporation</p>
              <p class="card-text launch-description">
                The most powerful consumer graphics card with the "Helios"
                architecture, promising unparalleled gaming and AI performance.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="Google Pixel Fold 2"
              />
              <div class="launch-date-badge">Aug 10, 2025</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">Google Pixel Fold 2</h5>
              <p class="card-text launch-company">Google</p>
              <p class="card-text launch-description">
                Google's next-gen foldable phone with a refined hinge, larger
                cover display, and the powerful Tensor G4 chip for enhanced AI
                capabilities.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="Sony PlayStation 6"
              />
              <div class="launch-date-badge">Nov 18, 2027</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">Sony PlayStation 6</h5>
              <p class="card-text launch-company">
                Sony Interactive Entertainment
              </p>
              <p class="card-text launch-description">
                The next era of console gaming, focusing on immersive
                experiences, true 8K capabilities, and revolutionary haptic
                controller feedback.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="Meta Quest 4"
              />
              <div class="launch-date-badge">Sep 25, 2025</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">Meta Quest 4</h5>
              <p class="card-text launch-company">Meta Platforms</p>
              <p class="card-text launch-description">
                Advanced standalone VR headset featuring higher resolution
                displays, a wider field of view, and vastly improved mixed
                reality features.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="DJI Mavic 4 Pro"
              />
              <div class="launch-date-badge">Apr 12, 2026</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">DJI Mavic 4 Pro</h5>
              <p class="card-text launch-company">DJI</p>
              <p class="card-text launch-description">
                Next-gen professional drone with enhanced 1-inch CMOS camera
                sensors, extended flight time, and omnidirectional obstacle
                avoidance.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="Tesla Model C"
              />
              <div class="launch-date-badge">Mar 01, 2026</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">Tesla Model C</h5>
              <p class="card-text launch-company">Tesla, Inc.</p>
              <p class="card-text launch-description">
                Tesla's affordable compact electric vehicle aimed at mass-market
                adoption, featuring new LFP battery technology and structural
                pack design.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card launch-card h-100">
            <div class="launch-card-img-container">
              <img
                src="../assets/img/image.png"
                class="card-img-top launch-card-image"
                alt="Cerebrum OS"
              />
              <div class="launch-date-badge">Dec 01, 2026</div>
            </div>
            <div class="card-body">
              <h5 class="card-title launch-title">Cerebrum OS</h5>
              <p class="card-text launch-company">Neuralink</p>
              <p class="card-text launch-description">
                An advanced operating system for brain-computer interfaces,
                enabling enhanced cognitive functions and new therapeutic
                applications.
              </p>
            </div>
            <div class="card-footer launch-card-footer">
              <a
                href="/detailLaunches"
                class="btn btn-sm btn-secondary-themed w-100"
                >Read More <i class="bi bi-arrow-right-short"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ====================
 content end
 ===================== -->

    <!-- ====================
 footer
 ===================== -->
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
    <!-- ====================
 footer end
 ===================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/launches.js"></script>
  </body>
</html>
