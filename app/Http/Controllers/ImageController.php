<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index($filename, $disk){
        $file = Storage::disk($disk)->get($filename);
        $code = 200;
        return new Response($file, $code);
    }

    public function showImage($filename, $disk){
        if (Storage::disk($disk)->exists($filename)) {
            return '<img src=" ' . route('get.image', ['filename' => $filename, 'disk' => $disk]) . '">';
        }

    }
}
