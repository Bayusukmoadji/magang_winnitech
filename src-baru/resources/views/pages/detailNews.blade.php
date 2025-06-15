<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    {{-- Judul halaman sekarang dinamis sesuai judul artikel --}}
    <title>Winntech - contoh</title>
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
    {{-- Gunakan helper asset() untuk path CSS yang benar --}}
    <link rel="stylesheet" href="{{ asset('assets/css/detailNews.css') }}" />
  </head>
  <body>
    <video autoplay muted loop playsinline id="background-video-detail-news">
      <source src="{{ asset('assets/img/bg2.mp4') }}" type="video/mp4" />
      Your browser does not support the video tag.
    </video>

    {{-- NAVIGASI (Tidak perlu diubah, tapi path-nya disesuaikan dengan helper `url()`) --}}
    <nav class="navbar navbar-expand-lg py-2 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/winntech.png') }}" alt="Winntech Logo" class="logo-img" loading="lazy"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarContent" aria-controls="mainNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbarContent">
                <form class="d-flex position-relative my-2 my-lg-0 ms-lg-3 me-lg-auto" id="navSearchFormGlobal">
                    <input class="form-control rounded-cover ps-5" type="search" placeholder="Search News..." aria-label="Search" id="globalSearchInput"/>
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                </form>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/techstocks') }}">TechStocks</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/launches') }}">Launches</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container my-5 detail-news-page-content">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
            <article class="news-article-wrapper">
            <header class="article-header mb-4">
              {{-- Judul Artikel dari database --}}
              <h1 class="article-title display-4">{{ $newsArticle->title }}</h1>
              <div class="article-meta text-muted">
                {{-- Nama Author dari database --}}
                <span class="meta-item"><i class="bi bi-person-fill me-1"></i> By {{ $newsArticle->author_name }}</span>
                {{-- Tanggal Publikasi dari database, diformat agar mudah dibaca --}}
                <span class="meta-item ms-3"><i class="bi bi-calendar3 me-1"></i>{{ $newsArticle->created_at ? $newsArticle->created_at->format('d M Y, H:i') : '-' }}</span>
              </div>
            </header>

            <figure class="article-featured-image mb-4 text-center">
              {{-- Gambar dari database --}}
              <img
                src="{{ Storage::url($newsArticle->image_path)}}"
                alt="{{$newsArticle->image_caption}}"
                class="img-fluid rounded-3 shadow"
              />
              {{-- Tampilkan caption hanya jika ada isinya --}}
              {{-- @if($articles->image_caption)
              <figcaption class="mt-2 image-caption-detail">
                {{ $articles->image_caption }}
              </figcaption>
              @endif --}}
            </figure>

            <section class="article-content">
              {{-- Konten Artikel dari database. Gunakan {!! !!} agar tag HTML bisa dirender --}}
              {{ $newsArticle->content }}
            </section>

            <hr class="article-divider my-5" />

            {{-- ================================================= --}}
            {{--                  BAGIAN KOMENTAR                  --}}
            {{-- ================================================= --}}
            <section class="article-comments" id="commentsSection">
              <div class="comments-container mx-auto my-3">
                <h2 class="section-title text-center mb-4">Article Comments</h2>

                {{-- ... (Form untuk menambah komentar tidak diubah) ... --}}
                <div class="text-center mb-4" id="addCommentTriggerContainer">
                    <button class="btn btn-primary-themed" type="button" id="toggleCommentFormButton" data-bs-toggle="collapse" data-bs-target="#commentFormContainer" aria-expanded="false" aria-controls="commentFormContainer">
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

                {{-- Jumlah komentar dinamis dari relasi 'comments' --}}
                <h3 class="comments-list-title mb-4">Comments (<span id="commentCountPlaceholder">0</span>)</h3>

                <div class="comments-list">
                  {{-- Gunakan @forelse untuk loop komentar, dengan pesan jika kosong --}}
                  @forelse ($newsArticle->comments as $comment)
                    {{-- <div class="comment-item" id="comment-{{ $comment->id }}"> --}}
                    <div class="comment-item" id="">
                      <div class="comment-content">
                        <div class="comment-header">
                          {{-- Nama pengomentar dari database --}}
                          <span class="commenter-name">{{ $comment->name }}</span>
                          {{-- Tanggal komentar dari database --}}
                          <span class="comment-timestamp">{{ $comment->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        {{-- Isi komentar dari database --}}
                        <p class="comment-text">{{ $comment->comment }}</p>

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
                        </div></div>
                        </div>
                  @empty
                    <div class="text-center p-4">
                      <p>No comments yet. Be the first to share your thoughts!</p>
                    </div>
                  @endforelse
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
