<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\Reader;
use App\Models\ReaderNews;

class ApiReaderNewsController extends Controller
{
    public function index(){
        $news = News::all();

        // Formatted data 
        $data = [];
        foreach ($news as $item) {
            $data[] = [
                'title' => $item->title,
                'content' => $item->content,
                'datetime' => $item->datetime,
                'author' => $item->author,
                'reader_qty' => $item->views_number(),
            ];
        }
        return response()->json($data);
    }

    public function show($id){
        $news_selected = News::find($id);
        $code = 200;

        if($news_selected){
            $readers = $news_selected->readers()->toArray();

            $readers = array_map(function($readers){
            return [
                'name' => $readers['name'],
                'last_name' => $readers['last_name']
            ];
            }, $readers);

            // Formatted data 
            $data = [
                'title' => $news_selected->title,
                'content' => $news_selected->content,
                'datetime' => $news_selected->datetime,
                'author' => $news_selected->author,
                'reader_qty' => $news_selected->views_number(),
                'readers' => $readers
            ];
        } else {
            $code = 404;
            $data = [
                'error' => 'Not Found'
            ];
        }
        return response()->json($data, $code);
    }

    public function get_readers_of_a_news($id){
        $news_selected = News::find($id);
        $code = 200;
        if($news_selected){
            // Get readers of a news
            $readers = $news_selected->readers()->toArray();

            // Used Array Map to filter some data
            $readers = array_map(function($readers){
            return [
                'name' => $readers['name'],
                'last_name' => $readers['last_name']
            ];
            }, $readers);

            // Formatted data 
            $data = [
                'readers' => $readers
            ];
        } else {
            $code = 404;
            $data = [
                'error' => 'Not Found'
            ];
        }
        return response()->json($data, $code);
    }

    public function get_news_readed_for_a_reader($id){ //using a descriptive name
        $reader = Reader::find($id);
        
        if($reader){
            $code = 200;
            $data = $reader->news()->toArray();

            // Used Array Map to filter some data of the news
            $data = array_map(function($data){
                return [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'datetime' => $data['datetime'],
                    'author' => $data['author'],
                ];
            }, $data);
        } else {
            $code = 404;
            $data = [
                'error' => 'Not Found'
            ];
        }

        return response()->json($data, $code);
    }

    public function reader($id){
        $reader = Reader::find($id);
        $data = [];

        if($reader){
            // Used this way because i had an error when i wanted to use "ARRAY MERGE"
            $data[] = $reader->user->toArray() + $reader->toArray();
            $code = 200;

            $data = array_map(function($data){
                return [
                    'name' => $data['name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['user']['email'],
                    'registered' => $data['created_at']
                ];
            }, $data);
        } else {
            $code = 404;
            $data = [
                'error' => 'Not Found'
            ];
        }

        return response()->json($data, $code);
    }
}
