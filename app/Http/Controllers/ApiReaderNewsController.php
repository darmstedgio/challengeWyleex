<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\Reader;
use App\Models\ReaderNews;


class ApiReaderNewsController extends Controller
{
    /**
     * Listado de noticias
     * @OA\Get (
     *     path="/api/news",
     *     tags={"Obtener noticias"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="title",type="string",example="El clima mejorará a partir de la segunda semana de Mayo"),
     *                     @OA\Property(property="content",type="string",example="Las fuertes lluvias, y el clima extremo sufridos a inicio de este mes, han ocasionado..."),
     *                     @OA\Property(property="datetime",type="datetime",example="2023-04-03 07:06:33"),
     *                     @OA\Property(property="author",type="string",example="Jane Doe"),
     *                     @OA\Property(property="reader_qty",type="number",example="24")
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Not Found"),
     *          )
     *      ),
     *      security={{"bearerAuth": {} }}
     * )
     */
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

    /**
     * Información de una noticia
     * @OA\Get (
     *     path="/api/news/{id}",
     *     tags={"Obtener una noticia"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="title", type="string", example="El estado como facilitador, no como inversor"),
     *              @OA\Property(property="content", type="string", example="[...] como mecanismo para rescatar una vez más a la empresa"),
     *              @OA\Property(property="datetime", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="author", type="string", example="John Doe"),
     *              @OA\Property(property="reader_qty", type="string", example="22"),
     *              @OA\Property(property="readers", type="object", example="[{'name': 'John', 'last_name': 'Doe'}]")
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Not Found"),
     *          )
     *      ),
     *      security={{"bearerAuth": {} }}
     * )
     */
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

        /**
     * Listado de lectores de una noticia
     * @OA\Get (
     *     path="/api/news/{id}/readers",
     *     tags={"Obtener lectores de una noticia"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="name", type="string",example="John"),
     *                     @OA\Property(property="last_name", type="string",example="Doe"),
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Not Found"),
     *          )
     *      ),
     *      security={{"bearerAuth": {} }}
     * )
     */
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

        /**
     * Información de un lector
     * @OA\Get (
     *     path="/api/reader/{id}",
     *     tags={"Obtener un lector"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="last_name", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", example="john@mail.com"),
     *              @OA\Property(property="registered", type="datetime", example="2023-02-23T00:09:16.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Not Found"),
     *          )
     *      ),
     *      security={{"bearerAuth": {} }}
     * )
     */
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

    /**
     * Listado de noticias leidas por un lector
     * @OA\Get (
     *     path="/api/reader/{id}/news",
     *     tags={"Obtener noticias leídas por un lector"},
     *      @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="title",type="string",example="El clima mejorará a partir de la segunda semana de Mayo"),
     *                     @OA\Property(property="content",type="string",example="Las fuertes lluvias, y el clima extremo sufridos a inicio de este mes, han ocasionado..."),
     *                     @OA\Property(property="datetime",type="datetime",example="2023-04-03 07:06:33"),
     *                     @OA\Property(property="author",type="string",example="Jane Doe"),
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Not Found"),
     *          )
     *      ),
     *      security={{"bearerAuth": {} }}
     * )
     */
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
}
