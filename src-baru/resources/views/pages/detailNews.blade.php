<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Winntech - News Article Title</title>
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
    <link rel="stylesheet" href="../assets/css/detailNews.css" />
  </head>
  <body>
    <video autoplay muted loop playsinline id="background-video-detail-news">
      <source src="../assets/img/bg2.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>

    <nav class="navbar navbar-expand-lg py-2 fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../">
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
                class="nav-link active"
                aria-current="page"
                href="/news"
                >News</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/techstocks">TechStocks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/launches">Launches</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5 detail-news-page-content">
      <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
          <article class="news-article-wrapper">
            <header class="article-header mb-4">
              <h1 class="article-title display-4">
                The Future of AI in Everyday Applications
              </h1>
              <div class="article-meta text-muted">
                <span class="meta-item"
                  ><i class="bi bi-person-fill me-1"></i> By Admin
                  Winntech</span
                >
                <span class="meta-item ms-3"
                  ><i class="bi bi-calendar3 me-1"></i> May 23, 2025</span
                >
              </div>
            </header>

            <figure class="article-featured-image mb-4 text-center">
              <img
                src="https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&h=500&q=80"
                alt="AI Technology Abstract"
                class="img-fluid rounded-3 shadow"
              />
              <figcaption class="mt-2 image-caption-detail">
                Abstract representation of AI neural networks.
              </figcaption>
            </figure>

            <section class="article-content">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur.
              </p>
              <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit anim id est laborum. Curabitur
                pretium tinnitus lacus. Nulla ut PreMium dobroslav lacus.
                Quisque vivimus mixtumque.
              </p>

              <h3 class="content-subheading">Subheading within the Article</h3>
              <p>
                Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                consectetur, adipisci velit, sed quia non numquam eius modi
                tempora incidunt ut labore et dolore magnam aliquam quaerat
                voluptatem. Ut enim ad minima veniam, quis nostrum
                exercitationem ullam corporis suscipit laboriosam, nisi ut
                aliquid ex ea commodi consequatur?
              </p>

              <blockquote class="futuristic-blockquote">
                <p class="mb-0">
                  "The advancement of AI will reshape industries and our daily
                  lives in ways we are only beginning to imagine."
                </p>
                <footer class="blockquote-footer mt-1">
                  Dr. Futurist in <cite title="Source Title">AI Today</cite>
                </footer>
              </blockquote>

              <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
                voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi
                nesciunt.
              </p>

              <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui
                blanditiis praesentium voluptatum deleniti atque corrupti quos
                dolores et quas molestias excepturi sint occaecati cupiditate
                non provident, similique sunt in culpa qui officia deserunt
                mollitia animi, id est laborum et dolorum fuga.
              </p>
            </section>

            <hr class="article-divider my-5" />

            <section class="article-comments" id="commentsSection">
              <div class="comments-container mx-auto my-3">
                <h2 class="section-title text-center mb-4">Article Comments</h2>

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
                        <label for="commenterName" class="form-label"
                          >Your Name</label
                        >
                        <input
                          type="text"
                          class="form-control form-control-futuristic"
                          id="commenterName"
                          placeholder="e.g., John Doe"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="commentText" class="form-label"
                          >Your Comment</label
                        >
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
                          <i class="bi bi-chat-left-text-fill me-2"></i>Submit
                          Comment
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
                        <span class="comment-timestamp"
                          >May 21, 2025, 9:30 PM</span
                        >
                      </div>
                      <p class="comment-text">
                        This is a great article! Very insightful points about
                        AI. Looking forward to more content like this.
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
                      <div
                        class="reply-form-container collapse mt-3"
                        id="replyForm-1"
                      >
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
                          <button
                            type="submit"
                            class="btn btn-primary-themed btn-sm"
                          >
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
                              <span class="commenter-name">JaneReply</span>
                              <span class="comment-timestamp"
                                >May 21, 2025, 9:45 PM</span
                              >
                            </div>
                            <p class="comment-text">
                              I agree with John! The future possibilities are
                              exciting.
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
                        <span class="comment-timestamp"
                          >May 20, 2025, 10:15 AM</span
                        >
                      </div>
                      <p class="comment-text">
                        Thanks for sharing this. I wonder about the ethical
                        implications though.
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
                      <div
                        class="reply-form-container collapse mt-3"
                        id="replyForm-2"
                      >
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
                          <button
                            type="submit"
                            class="btn btn-primary-themed btn-sm"
                          >
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
          </article>
        </div>
      </div>
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
    <script src="../assets/js/detailNews.js"></script>
  </body>
</html>
