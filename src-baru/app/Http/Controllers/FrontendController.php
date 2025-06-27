<?php

namespace App\Http\Controllers;

use App\Models\ReplyNews;
use App\Models\NewsArticle;
use App\Models\NewsComment;
use Illuminate\Http\Request;
use App\Models\LaunchProduct;

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

        $launches = LaunchProduct::latest('launch_date')->paginate(9);


        return view('pages.launches', [
            'launches' => $launches
        ]);
    }

    public function details(NewsArticle $newsArticle)
    {
        $comments = $newsArticle->comments()
            ->with('replies')
            ->latest()
            ->paginate(10);

        return view('pages.detailNews', [
            'newsArticle' => $newsArticle,
            'comments'    => $comments
        ]);
    }

    public function detailLaunch(LaunchProduct $launchProduct)
    {
        return view('pages.detailLaunches', [
            'launch' => $launchProduct
        ]);
    }

    public function storeComment(Request $request)
    {
        $validatedData = $request->validate([
            'news_article_id' => 'required|exists:news_articles,id',
            'name' => 'required|string|max:255',
            'comment' => 'required|string|min:3',
        ]);

        NewsComment::create($validatedData);

        return back()->with('success', 'Komentar Anda berhasil dipublikasikan!');
    }

    public function storeReply(Request $request)
    {
        $validatedData = $request->validate([
            'news_comment_id' => 'required|exists:news_comments,id',
            'name' => 'required|string|max:255',
            'comment' => 'required|string|min:3',
        ]);

        ReplyNews::create($validatedData);

        return back()->with('success', 'Balasan Anda berhasil dipublikasikan!');
    }

    public function loadMoreComments(Request $request)
    {
        $request->validate(['article_id' => 'required|exists:news_articles,id']);
        $comments = NewsComment::where('news_article_id', $request->article_id)
            ->with('replies')->latest()->paginate(10);
        return response()->json($comments);
    }

    public function apiSearch(Request $request)
    {
        $query = $request->input('query');

        $articles = NewsArticle::where('title', 'LIKE', "%{$query}%")
            ->latest('publication_date')
            ->take(12)
            ->get();

        return response()->json($articles);
    }

    // METHOD UNTUK API PENCARIAN LAUNCHES
    public function apiSearchLaunches(Request $request)
    {
        $query = $request->input('query');

        $launches = LaunchProduct::where('title', 'LIKE', "%{$query}%")
            ->latest('launch_date')
            ->get();

        return response()->json($launches);
    }

    public function loadMoreNews(Request $request)
    {
        $articles = NewsArticle::where('is_featured', false)
            ->latest('publication_date')
            ->paginate(8);

        return response()->json($articles);
    }

    public function loadMoreLaunches(Request $request)
    {
        $launches = LaunchProduct::latest('launch_date')->paginate(9);

        return response()->json($launches);
    }
}
