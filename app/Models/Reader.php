<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function news(){
        $reader_news_ids = ReaderNews::where('reader_id', $this->id)->pluck('news_id')->toArray();
        $news = News::whereIn('id', $reader_news_ids)->get();

        return $news;
    }

    public function reader_news_qty(){
        return ReaderNews::where('reader_id', $this->id)->count();
    }
    
}
