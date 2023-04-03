<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\ReaderNews;

class FrontNewsController extends Controller
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
    
    public function index(){
        $news = News::all();
        return view('readers.news.index', compact('news'));
    }

    public function show($id){
        $news_selected = News::find($id);
        $news = News::latest()
                        ->take(5)
                        ->get();

        // Mark as read this news if is a reader
        if(Auth::user()->role == 'READER')
            ReaderNews::mark_as_read(Auth::user()->reader->id, $news_selected->id);

        return view('readers.news.show', compact('news', 'news_selected'));
    }
}
