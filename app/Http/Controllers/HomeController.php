<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Reader;
use App\Models\ReaderNews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == 'ADMIN'){
            $statics = [
                'readers_qty' => Reader::count(),
                'news_qty' => News::count(),
                'editors_qty' => User::where('role', 'ADMIN')->count(),
                'total_readed_news' => ReaderNews::count(),
            ];
            return view('admin.home', compact('statics'));
        } else {
            return redirect()->route('front-news.index');
        }
    }
}
