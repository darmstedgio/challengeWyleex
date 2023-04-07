<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\ReaderNews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->simplePaginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valido el request
        $data = $request->validate([
            'title' => ['required', 'string', 'min:10', 'max:255'],
            'content' => ['required', 'string'],
            'image_path' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Save Image
        $image_path_name = null;
        if($data['image_path'] ?? false){
            $image_path_name = time().$request->image_path->getClientOriginalName();
            Storage::disk('news')->put($image_path_name, File::get($request->image_path));
        }

        $data = array_merge($data, [
            'author' => Auth::user()->name, 
            'datetime' => Carbon::now(),
            'user_id' => Auth::user()->id,
            'image_path' => $image_path_name,
        ]);

        News::create($data);

        toast('¡Noticia creada con éxito!','success');
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Valido el request
        $data = $request->validate([
            'title' => ['required', 'string', 'min:10', 'max:255'],
            'content' => ['required', 'string'],
            'image_path' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Delete old image
        $entity = News::find($id);
        if($entity->image_path){
            if(Storage::disk('news')->exists($entity->image_path)){
                Storage::disk('news')->delete($entity->image_path);
            }
        }

        // Save Image (it could be improved)
        $image_path_name = null;
        if($data['image_path'] ?? false){
            $image_path_name = time().$request->image_path->getClientOriginalName();
            Storage::disk('news')->put($image_path_name, File::get($request->image_path));
        }

        $data = array_merge($data, [
            'datetime' => Carbon::now(),
            'image_path' => $image_path_name,
        ]);


        $data = array_merge($data, [
            'author' => Auth::user()->name, 
            'datetime' => Carbon::now(),
            'user_id' => Auth::user()->id,
            'image_path' => $image_path_name,
        ]);

        News::updateOrCreate(
            [ 'id' => $id ],
            $data
        );

        toast('¡Noticia actualizada con éxito!','success');
        
        // If it comes_from=front-news.show, go there...
        if($request->comes_from){
            return redirect()->route('front-news.show', ['id' => $id, 'title' => formate_title_url($data['title'])]);
        } else {
            return redirect()->route('news.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if($news){
            // Delete records about views of this news
            ReaderNews::where('news_id', $id)->delete();

            $news->delete();
            toast('Noticia eliminada con éxito','success');
        } else {
            toast('Algo salió mal','info');
        }
        return redirect()->route('news.index');
    }
}
