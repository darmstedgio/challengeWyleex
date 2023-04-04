<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthClientController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'isLogged']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\POST(
     *     path="/api/login",
     *     tags={"Auth Login: Obtener token"},
     *     summary="Login",
     *     description="Login",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", example="admin@mail.com"),
     *              @OA\Property(property="password", type="string", example="admin123")
     *          ),
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LhAuMC4xOjgwMDAvYXBpL3JlZnJlc2giLCJpYXQiOjE2ODA2MzUyNTMsImV4cCI6MTY4MTI0MDA5MCwibmJmIjoxNjgwNjM1MjkwLCJqdGkiOiJIR1o5M1JFbU1wc2hJTUt3Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzll2zAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.B8ogV3E5tMPfII1-vTvzqpXO_pt73II0koXkb63jEVQ"),
     *              @OA\Property(property="token_type", type="string", example="bearer"),
     *              @OA\Property(property="expires_in", type="number", example="604800"),
     *          )
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     * )
    */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } 
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    /**
     * Información usuario logueado
     * @OA\Get (
     *     path="/api/me",
     *     tags={"Auth Me: Obtener información del usuario logueado"},
     *     description="Retorna los datos del usuario autentificado",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example="1"),
     *              @OA\Property(property="name", type="string", example="John Doe"),
     *              @OA\Property(property="email", type="string", example="john@mail.com"),
     *              @OA\Property(property="email_verified_at", type="string|null", example="null"),
     *              @OA\Property(property="role", type="string", example="ADMIN"),
     *              @OA\Property(property="created_at", type="string", example="2023-04-03T09:23:30.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-04-03T09:23:30.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      security={{"bearerAuth": {} }}
     * )
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\POST(
     *     path="/api/logout",
     *     tags={"Auth Logout: Cerrar Sesión"},
     *     summary="Logout",
     *     description="Logout",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out"),
     *         )
     *     ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      security={{"bearerAuth": {} }}
     * )
    */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\POST(
     *     path="/api/refresh",
     *     tags={"Auth Refresh: Actualizar Token"},
     *     summary="Refresh",
     *     description="Refresh",
     *     @OA\Response(
     *                response=200,
     *                description="OK",
     *                @OA\JsonContent(
     *                    @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LhAuMC4xOjgwMDAvYXBpL3JlZnJlc2giLCJpYXQiOjE2ODA2MzUyNTMsImV4cCI6MTY4MTI0MDA5MCwibmJmIjoxNjgwNjM1MjkwLCJqdGkiOiJIR1o5M1JFbU1wc2hJTUt3Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzll2zAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.B8ogV3E5tMPfII1-vTvzqpXO_pt73II0koXkb63jEVQ"),
     *                     @OA\Property(property="token_type", type="string", example="bearer"),
     *                     @OA\Property(property="expires_in", type="number", example="604800"),
     *                 )
     *      ),
     *      @OA\Response(
     *                  response=401, 
     *                  description="Error: Unauthorized",
     *                  @OA\JsonContent(
     *                     @OA\Property(property="message", type="string", example="Unauthenticated."),
     *                  )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      security={{"bearerAuth": {} }}
     * )
    */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
