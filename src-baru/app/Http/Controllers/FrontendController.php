<?php

namespace App\Http\Controllers;

use App\Models\ReplyNews;
use App\Models\NewsArticle;
use App\Models\NewsComment;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function news()
    {
        // Query 1: Ambil 3 berita terbaru yang ditandai sebagai "featured" untuk carousel.
        $featuredArticles = NewsArticle::where('is_featured', true)
            ->latest('publication_date') // Urutkan dari yang paling baru
            ->take(3) // Ambil maksimal 3 berita
            ->get();

        // Query 2: Ambil berita lainnya (yang tidak featured) dengan paginasi.
        // Angka 8 berarti 8 berita per halaman.
        $articles = NewsArticle::where('is_featured', false)
            ->latest('publication_date')
            ->paginate(8);

        // 3. Mengirim kedua variabel tersebut ke view 'pages.news'
        // Variabel ini akan bisa diakses di dalam file news.blade.php
        return view('pages.news', [
            'featuredArticles' => $featuredArticles,
            'articles'         => $articles,
        ]);
    }

    public function techstocks()
    {
        return view('pages.techstocks');
    }

    public function launches()
    {
        return view('pages.launches');
    }

    // public function detailNews(NewsArticle $newsArticle)
    // {
    //     // Eager load comments untuk menghindari query N+1
    //     $newsArticle->load(['comments' => function ($query) {
    //         $query->latest(); // Urutkan komentar dari yang terbaru
    //     }]);

    //     return view('pages.detailNews', [
    //         'article' => $newsArticle
    //     ]);
    // }

    public function details(NewsArticle $newsArticle)
    {
        // Eager load comments DAN replies-nya sekaligus untuk performa terbaik
        $newsArticle->load(['comments.replies' => function ($query) {
            $query->orderBy('created_at', 'asc'); // Urutkan balasan dari yang terlama ke terbaru
        }]);

        return view('pages.detailNews', [
            'newsArticle' => $newsArticle
        ]);
    }

    public function detailLaunches()
    {
        return view('pages.detailLaunches');
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'news_article_id' => 'required|exists:news_articles,id',
            'name' => 'required|string|max:255',
            'comment' => 'required|string|min:3',
        ]);

        NewsComment::create($request->all());

        return back()->with('success', 'Komentar Anda berhasil dipublikasikan!');
    }


    /**
     * Menyimpan balasan untuk sebuah komentar.
     */
    public function storeReply(Request $request)
    {
        $request->validate([
            'news_comment_id' => 'required|exists:news_comments,id',
            'name' => 'required|string|max:255',
            'comment' => 'required|string|min:3',
        ]);

        ReplyNews::create($request->all());

        return back()->with('success', 'Balasan Anda berhasil dipublikasikan!');
    }
}
