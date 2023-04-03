<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = [];

    public function readers(){
        $reader_news_ids = ReaderNews::where('news_id', $this->id)->pluck('reader_id')->toArray();
        $readers = Reader::whereIn('id', $reader_news_ids)->get();
        
        return $readers;
    }

    public function views_number(){
        return ReaderNews::where('news_id', $this->id)->count();
    }
}
