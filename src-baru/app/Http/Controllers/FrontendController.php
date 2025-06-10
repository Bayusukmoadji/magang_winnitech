<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function techstocks()
    {
        return view('pages.techstocks');
    }

    public function launches()
    {
        return view('pages.launches');
    }

    public function detailNews()
    {
        return view('pages.detailNews');
    }

    public function detailLaunches()
    {
        return view('pages.detailLaunches');
    }
}
