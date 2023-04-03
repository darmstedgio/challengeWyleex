<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){
            return redirect()->route('front-news.index');
        } else {
            $news = News::latest()
                            ->take(3)
                            ->get();
            return view('welcome', compact('news'));
        }
    }
}