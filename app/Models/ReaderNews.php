<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReaderNews extends Model
{
    protected $guarded = [];

    public static function mark_as_read($reader_id, $news_id){
        ReaderNews::create(
            [
                'reader_id' => $reader_id,
                'news_id' => $news_id
            ]
        );
    }
}
