<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 *@OA\Info(
 *  title="Projecto challengeWyleex: Documentación de la API de lectores y de noticias", 
 *  version="1.0.0",
 *  description="Listado de URI's: Esta documentación provee información necesaria para la utilización correcta de los End-Points",
 *),
 *@OA\SecurityScheme(
 *  securityScheme="bearerAuth",
 *  in="header",
 *  name="bearerAuth",
 *  type="http",
 *  scheme="bearer",
 *  bearerFormat="JWT",
 *),
 * @OA\Server(url="https://challengewyleex.darmsportfolio.xyz"),
 * @OA\Server(url="http://127.0.0.1:8000"),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
