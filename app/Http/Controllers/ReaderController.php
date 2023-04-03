<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\ReaderNews;
use App\Models\User;

class ReaderController extends Controller
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
        $readers = User::where('role', 'READER')->orderBy('id', 'DESC')->simplePaginate(10);
        return view('admin.readers.index', compact('readers'));
    }
}
