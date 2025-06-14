<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Winntech - Launch Detail: MacBook Pro M4</title>
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
    <link rel="stylesheet" href="../assets/css/detailLaunches.css" />
  </head>
  <body>
    <video
      autoplay
      muted
      loop
      playsinline
      id="background-video-detail-launches"
    >
      <source src="../assets/img/bg2.mp4" type="video/mp4" />
      Your browser does not support the video tag.
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
              <a class="nav-link" href="/techstocks">TechStocks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/launches">Launches</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-5 detail-launch-page-content mb-0">
      <h1 class="product-title-main text-center display-4 mb-3">
        MacBook Pro M4
      </h1>
      <p class="product-subtitle text-center text-muted mb-5">
        Launched by <span class="company-name">Apple Inc.</span> on
        <span class="launch-date-highlight">October 15, 2025</span>
      </p>

      <div class="row gy-lg-0 gy-4">
        <div class="col-lg-7">
          <div class="product-image-gallery sticky-lg-top">
            <img
              src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWFjYm9va3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=80"
              alt="MacBook Pro M4"
              class="img-fluid product-main-image"
            />
          </div>
        </div>

        <div class="col-lg-5">
          <div class="product-details-wrapper">
            <section class="product-section mb-4">
              <h2 class="section-title">Product Description</h2>
              <p class="product-description">
                The latest generation MacBook Pro arrives with the revolutionary
                M4 chip, taking performance and power efficiency to
                unprecedented levels. Enjoy an even more stunning Liquid Retina
                XDR display, an advanced cooling system redesigned for sustained
                performance, and a suite of super-fast connectivity ports. The
                MacBook Pro M4 is designed for creative professionals and
                developers who demand uncompromised power.
              </p>
            </section>

            <section class="product-section mb-4">
              <h2 class="section-title">Key Features</h2>
              <ul class="features-list">
                <li>Apple M4 chip with next-generation Neural Engine</li>
                <li>14" & 16" Liquid Retina XDR Display</li>
                <li>Up to 22 hours of battery life</li>
                <li>Up to 8TB SSD storage</li>
                <li>Up to 64GB unified memory</li>
              </ul>
            </section>

            <section class="product-section mb-4">
              <h2 class="section-title">Technical Specifications</h2>
              <dl class="specifications-list">
                <dt>Processor</dt>
                <dd>
                  Apple M4 (10-core CPU, 16-core GPU, 16-core Neural Engine)
                </dd>
                <dt>Display</dt>
                <dd>14.2-inch Liquid Retina XDR, ProMotion up to 120Hz</dd>
                <dt>Memory</dt>
                <dd>Starts at 16GB, configurable up to 64GB</dd>
                <dt>Storage</dt>
                <dd>Starts at 512GB SSD, configurable up to 8TB</dd>
                <dt>Ports</dt>
                <dd>
                  3x Thunderbolt 4 (USB-C), HDMI, SDXC card slot, MagSafe 3
                </dd>
                <dt>Wireless</dt>
                <dd>Wi-Fi 7 (802.11be), Bluetooth 5.4</dd>
              </dl>
            </section>

            <div class="text-center mt-4">
              <a
                href="https://www.apple.com/id/iphone/?&cid=wwa-id-kwgo-iphone-slid--Core-Brand-id_avail_041125-&mnid=s2ElOjT98-dc_mtid_209252fb69410_pcrid_746741953120_pgrid_167572352786_pexid__ptid_kwd-10778630_&mtid=209252fb69410&aosid=p238"
                class="btn btn-primary-themed btn-lg w-100"
                target="_blank"
              >
                <i class="bi bi-box-arrow-up-right me-2"></i>Visit Official Site
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="product-comments-section mt-5 pt-4">
      <div class="comments-container mx-auto my-3">
        <h2 class="section-title text-center mb-4">Discussion & Comments</h2>

        <div class="text-center mb-4" id="addCommentTriggerContainer">
          <button
            class="btn btn-primary-themed"
            type="button"
            id="toggleCommentFormButton"
            data-bs-toggle="collapse"
            data-bs-target="#commentFormContainer"
            aria-expanded="false"
            aria-controls="commentFormContainer"
          >
            <i class="bi bi-pencil-square me-2"></i>Leave a Comment
          </button>
        </div>

        <div class="collapse" id="commentFormContainer">
          <div class="comment-form-wrapper mb-5">
            <h4 class="comment-form-title text-center mb-3">
              Write Your Comment
            </h4>
            <form id="commentForm">
              <div class="mb-3">
                <label for="commenterName" class="form-label">Your Name</label>
                <input
                  type="text"
                  class="form-control form-control-futuristic"
                  id="commenterName"
                  placeholder="e.g., John Doe"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="commentText" class="form-label">Your Comment</label>
                <textarea
                  class="form-control form-control-futuristic"
                  id="commentText"
                  rows="4"
                  placeholder="Write your comment here..."
                  required
                ></textarea>
              </div>
              <div class="d-flex justify-content-end">
                <button
                  type="button"
                  class="btn btn-secondary-themed me-2"
                  data-bs-toggle="collapse"
                  data-bs-target="#commentFormContainer"
                  aria-expanded="true"
                  aria-controls="commentFormContainer"
                >
                  Cancel
                </button>
                <button type="submit" class="btn btn-primary-themed">
                  <i class="bi bi-chat-left-text-fill me-2"></i>Submit Comment
                </button>
              </div>
            </form>
          </div>
        </div>

        <h3 class="comments-list-title mb-4">
          Comments (<span id="commentCountPlaceholder">3</span>)
        </h3>
        <div class="comments-list">
          <div class="comment-item" id="comment-1">
            <div class="comment-content">
              <div class="comment-header">
                <span class="commenter-name">John Doe</span>
                <span class="comment-timestamp">May 21, 2025, 9:30 PM</span>
              </div>
              <p class="comment-text">
                This product looks very promising! Can't wait for the M4 chip
                performance. The design is also very sleek and modern. Awesome!
              </p>
              <div class="comment-actions mt-2">
                <button
                  class="btn btn-link btn-sm reply-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#replyForm-1"
                  aria-expanded="false"
                  aria-controls="replyForm-1"
                >
                  <i class="bi bi-reply-fill"></i> Reply
                </button>
              </div>
              <div class="reply-form-container collapse mt-3" id="replyForm-1">
                <form class="reply-form">
                  <h5 class="reply-form-title mb-2">
                    Write a reply to John Doe
                  </h5>
                  <div class="mb-2">
                    <input
                      type="text"
                      class="form-control form-control-sm form-control-futuristic"
                      name="replyName"
                      placeholder="Your Name"
                      required
                    />
                  </div>
                  <div class="mb-2">
                    <textarea
                      class="form-control form-control-sm form-control-futuristic"
                      name="replyText"
                      rows="3"
                      placeholder="Your Reply..."
                      required
                    ></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary-themed btn-sm">
                    Submit Reply
                  </button>
                  <button
                    type="button"
                    class="btn btn-secondary-themed btn-sm ms-2"
                    data-bs-toggle="collapse"
                    data-bs-target="#replyForm-1"
                  >
                    Cancel
                  </button>
                </form>
              </div>

              <div class="comment-replies mt-3">
                <div class="comment-item reply-item" id="comment-1-1">
                  <div class="comment-content">
                    <div class="comment-header">
                      <span class="commenter-name">ReplyGuy</span>
                      <span class="comment-timestamp"
                        >May 21, 2025, 9:45 PM</span
                      >
                    </div>
                    <p class="comment-text">
                      I agree, John! The M4 sounds like a beast. Any idea if
                      they improved the keyboard?
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="comment-item mb-5" id="comment-2">
            <div class="comment-content">
              <div class="comment-header">
                <span class="commenter-name">Alice Smith</span>
                <span class="comment-timestamp">May 20, 2025, 10:15 AM</span>
              </div>
              <p class="comment-text">
                Finally, a significant upgrade! The specs look great. Hopefully,
                the battery life lives up to the claims. Any info on the price?
              </p>
              <div class="comment-actions mt-2">
                <button
                  class="btn btn-link btn-sm reply-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#replyForm-2"
                  aria-expanded="false"
                  aria-controls="replyForm-2"
                >
                  <i class="bi bi-reply-fill"></i> Reply
                </button>
              </div>
              <div class="reply-form-container collapse mt-3" id="replyForm-2">
                <form class="reply-form">
                  <h5 class="reply-form-title mb-2">
                    Write a reply to Alice Smith
                  </h5>
                  <div class="mb-2">
                    <input
                      type="text"
                      class="form-control form-control-sm form-control-futuristic"
                      placeholder="Your Name"
                      required
                    />
                  </div>
                  <div class="mb-2">
                    <textarea
                      class="form-control form-control-sm form-control-futuristic"
                      rows="3"
                      placeholder="Your Reply..."
                      required
                    ></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary-themed btn-sm">
                    Submit Reply
                  </button>
                  <button
                    type="button"
                    class="btn btn-secondary-themed btn-sm ms-2"
                    data-bs-toggle="collapse"
                    data-bs-target="#replyForm-2"
                  >
                    Cancel
                  </button>
                </form>
              </div>
              <div class="comment-replies mt-3"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
            <small class="footer-copyright-text"
              >&copy; 2025 PT. Winnicode Garuda Teknologi. All rights reserved
              <br />
              by Bayu Sukmo Adji</small
            >
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
