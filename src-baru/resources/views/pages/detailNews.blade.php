<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Winntech - {{ $newsArticle->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/detailNews.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <video autoplay muted loop playsinline id="background-video-detail-news">
        <source src="{{ asset('assets/img/bg2.mp4') }}" type="video/mp4" />
        Browser Anda tidak mendukung tag video.
    </video>

    {{-- ================================================= --}}
    {{--                     NAVBAR                      --}}
    {{-- ================================================= --}}
    <nav class="navbar navbar-expand-lg py-2 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/winntech.png') }}" alt="Winntech Logo" class="logo-img" loading="lazy"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarContent">
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
              placeholder="Search..."
              aria-label="Search"
              id="globalSearchInput"
            />
            <i
              class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"
            ></i>
            </form>

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active " href="{{ route('front.news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('front.techstocks') }}">TechStocks</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('front.launches') }}">Launches</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ================================================= --}}
    {{--                KONTEN ARTIKEL                     --}}
    {{-- ================================================= --}}
    <div class="container my-5 detail-news-page-content">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <article class="news-article-wrapper">
                    <header class="article-header mb-4">
                        <h1 class="article-title display-4">{{ $newsArticle->title }}</h1>
                        <div class="article-meta text-muted">
                            <span class="meta-item"><i class="bi bi-person-fill me-1"></i> By {{ $newsArticle->author_name }}</span>
                            <span class="meta-item ms-3"><i class="bi bi-calendar3 me-1"></i>{{ $newsArticle->publication_date->format('d M Y, H:i') }}</span>
                        </div>
                    </header>

                    <figure class="article-featured-image mb-4 text-center">
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow">
                            <img
                              src="{{ asset('storage/' . $newsArticle->image_path) }}"
                              alt="{{ $newsArticle->image_caption ?? $newsArticle->title }}"
                              class="featured-image"
                            />
                        </div>
                        @if($newsArticle->image_caption)
                        <figcaption class="mt-2 image-caption-detail">
                          {{ $newsArticle->image_caption }}
                        </figcaption>
                        @endif
                    </figure>

                    <section class="article-content">
                        {!! $newsArticle->content !!}
                    </section>

                    <hr class="article-divider my-5" />

                    {{-- ================================================= --}}
                    {{--         BAGIAN KOMENTAR (KODE FINAL)              --}}
                    {{-- ================================================= --}}
                    <section class="article-comments" id="commentsSection">
                        <div class="comments-container mx-auto my-3">
                            <h2 class="section-title text-center mb-4">Article Comments</h2>

                            <div class="text-center mb-4" id="addCommentTriggerContainer">
                                <button class="btn btn-primary-themed" type="button" data-bs-toggle="collapse" data-bs-target="#commentFormContainer" aria-expanded="false">
                                    <i class="bi bi-pencil-square me-2"></i>Leave a Comment
                                </button>
                            </div>

                            <div class="collapse" id="commentFormContainer">
                                <div class="comment-form-wrapper mb-5">
                                    <h4 class="comment-form-title text-center mb-3">Write Your Comment</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="news_article_id" value="{{ $newsArticle->id }}">
                                        <div class="mb-3">
                                            <label for="commenterName" class="form-label">Your Name</label>
                                            <input type="text" class="form-control form-control-futuristic" id="commenterName" name="name" placeholder="e.g., John Doe" required value="{{ old('name') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="commentText" class="form-label">Your Comment</label>
                                            <textarea class="form-control form-control-futuristic" id="commentText" name="comment" rows="4" placeholder="Write your comment here..." required>{{ old('comment') }}</textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary-themed me-2" data-bs-toggle="collapse" data-bs-target="#commentFormContainer">Cancel</button>
                                            <button type="submit" class="btn btn-primary-themed"><i class="bi bi-chat-left-text-fill me-2"></i>Submit Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <h3 class="comments-list-title mb-4">Comments ({{ $comments->total() }})</h3>

                            <div class="comments-list">
                                @forelse ($comments as $comment)
                                    <div class="comment-item" id="comment-{{ $comment->id }}">
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <span class="commenter-name">{{ $comment->name }}</span>
                                                <span class="comment-timestamp">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="comment-text">{{ $comment->comment }}</p>
                                            <div class="comment-actions mt-2 d-flex align-items-center">
                                                <button class="btn btn-link btn-sm reply-button" type="button" data-bs-toggle="collapse" data-bs-target="#replyForm-{{ $comment->id }}" aria-expanded="false">
                                                    <i class="bi bi-reply-fill"></i> Reply
                                                </button>
                                                @if ($comment->replies->isNotEmpty())
                                                    <span class="mx-1 text-muted">·</span>
                                                    <button class="btn btn-link btn-sm toggle-replies-btn" type="button" data-bs-toggle="collapse" data-bs-target="#replies-for-comment-{{ $comment->id }}" aria-expanded="false">
                                                        <i class="bi bi-chevron-down me-1"></i> <span class="btn-text">Lihat Balasan ({{ $comment->replies->count() }})</span>
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="reply-form-container collapse mt-3" id="replyForm-{{ $comment->id }}">
                                                <form class="reply-form" action="{{ route('replies.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="news_comment_id" value="{{ $comment->id }}">
                                                    <h5 class="reply-form-title mb-2">Write a reply to {{ $comment->name }}</h5>
                                                    <div class="mb-2">
                                                        <input type="text" class="form-control form-control-sm form-control-futuristic" name="name" placeholder="Your Name" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <textarea class="form-control form-control-sm form-control-futuristic" name="comment" rows="3" placeholder="Your Reply..." required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary-themed btn-sm">Submit Reply</button>
                                                    <button type="button" class="btn btn-secondary-themed btn-sm ms-2" data-bs-toggle="collapse" data-bs-target="#replyForm-{{ $comment->id }}">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="replies-list ps-4 mt-3 collapse" id="replies-for-comment-{{ $comment->id }}">
                                            @foreach ($comment->replies->sortBy('created_at') as $reply)
                                                <div class="comment-item is-reply" id="reply-{{ $reply->id }}">
                                                    <div class="comment-content">
                                                        <div class="comment-header">
                                                            <span class="commenter-name">{{ $reply->name }}</span>
                                                            <span class="comment-timestamp">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p class="comment-text">{{ $reply->comment }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center p-4">
                                        <p>No comments yet. Be the first to share your thoughts!</p>
                                    </div>
                                @endforelse
                            </div>

                            @if ($comments->hasMorePages())
                                <div class="text-center mt-4" id="load-more-container">
                                    <button id="load-more-comments" class="btn btn-primary-themed" data-page="2" data-article-id="{{ $newsArticle->id }}">
                                        Load More Comments
                                    </button>
                                </div>
                            @endif
                        </div>
                    </section>
                </article>
            </div>
        </div>
    </div>

    {{-- ================================================= --}}
    {{--                     FOOTER                      --}}
    {{-- ================================================= --}}
   <footer class="footer pt-5 border-top">

<div class="container px-3 px-md-5">

<div class="row justify-content-center align-items-start gy-4 gx-md-5">

<div class="col-md-3 d-flex flex-column align-items-center">

<div class="d-flex align-items-center justify-content-center mb-2 footer-logos-container">

<img src="{{ asset('assets/img/logo.png') }}" alt="Winnicode Logo" class="img-fluid footer-logo-main" loading="lazy"/>

<img src="{{ asset('assets/img/km.png') }}" alt="Kampus Merdeka Logo" class="img-fluid footer-logo-km" loading="lazy"/>

<img src="{{ asset('assets/img/winntech.png') }}" alt="Winntech Logo Footer" class="img-fluid footer-logo-main" loading="lazy"/>

</div>

<p class="text-center mb-0 footer-description-text">

The Winnicode Journalism Program is a human resource development program aimed at young men and women pursuing careers in the world of reporting.

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

<li><a href="{{ route('front.news') }}">News</a></li>

<li><a href="{{ route('front.techstocks') }}">TechStocks</a></li>

<li><a href="{{ route('front.launches') }}">Launches</a></li>

</ul>

</div>

</div>

</div>

<div class="text-center mt-4">

<div class="p-2">

<small class="footer-copyright-text">

&copy; 2025 PT. Winnicode Garuda Teknologi. All rights reserved<br />

by Bayu Sukmo Adji

</small>

</div>

</div>

</div>

</footer>

    {{-- Sinyal untuk JavaScript. Diletakkan di sini agar bersih. --}}
    @if (session('success'))
        <div id="session-success-alert" data-message="{{ session('success') }}" style="display: none;"></div>
    @endif

    {{-- JAVASCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/detailNews.js') }}"></script>

    {{-- SCRIPT PENANGAN POPUP (jika Anda memilih metode inline) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlertElement = document.getElementById('session-success-alert');
            if (successAlertElement) {
                const message = successAlertElement.dataset.message;
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: message,
                        timer: 3500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        background: 'rgba(18, 22, 33, 0.85)',
                        color: '#e0e0e0',
                        iconColor: '#00d1ff',
                        customClass: {
                            popup: 'popup-themed',
                            title: 'popup-title-themed',
                            htmlContainer: 'popup-text-themed'
                        },
                        backdrop: `rgba(8, 10, 15, 0.4)`
                    });
                }
            }
        });
    </script>
</body>
</html>
