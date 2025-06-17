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
        $featuredArticles = NewsArticle::where('is_featured', true)->latest('publication_date')->take(3)->get();
        $articles = NewsArticle::where('is_featured', false)->latest('publication_date')->paginate(8);

        return view('pages.news', [
            'featuredArticles' => $featuredArticles,
            'articles'         => $articles,
        ]);
    }

    // Method untuk halaman hasil pencarian (jika form disubmit tanpa JS)
    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $articles = NewsArticle::where('title', 'LIKE', "%{$searchQuery}%")
            ->latest('publication_date')
            ->paginate(12);

        return view('pages.search_results', [
            'articles' => $articles,
            'searchQuery' => $searchQuery
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


    public function details(NewsArticle $newsArticle)
    {
        // Ambil 10 komentar pertama untuk halaman awal, diurutkan dari yang terbaru.
        // 'with('replies')' untuk efisiensi, agar tidak ada query tambahan saat menampilkan balasan.
        $comments = $newsArticle->comments()
            ->with('replies')
            ->latest()
            ->paginate(10);

        // Sekarang kita mengirim variabel 'newsArticle' DAN 'comments' ke view.
        return view('pages.detailNews', [
            'newsArticle' => $newsArticle,
            'comments'    => $comments  // <-- INI YANG MENYELESAIKAN ERROR
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

    // Method baru untuk menangani request AJAX "Load More"
    public function loadMoreComments(Request $request)
    {
        // Validasi untuk memastikan article_id dikirim
        $request->validate(['article_id' => 'required|exists:news_articles,id']);

        $comments = NewsComment::where('news_article_id', $request->article_id)
            ->with('replies')
            ->latest()
            ->paginate(10);

        // Mengembalikan data dalam format JSON
        return response()->json($comments);
    }

    // METHOD BARU UNTUK API
    public function apiSearch(Request $request)
    {
        $query = $request->input('query');
        $articles = NewsArticle::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->latest('publication_date')
            ->take(12)->get();
        return response()->json($articles);
    }
}
