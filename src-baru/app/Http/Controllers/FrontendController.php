<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
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
        $articles = NewsArticle::all();

        return view('pages.detailNews', compact('newsArticle', 'articles'));
    }

    public function detailLaunches()
    {
        return view('pages.detailLaunches');
    }
}
