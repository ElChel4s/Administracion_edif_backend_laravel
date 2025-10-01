<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Models\Usuario;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     tags={"Auth"},
     *     summary="Iniciar sesión",
     *     description="Autenticar usuario y obtener token JWT",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@edificio.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Login exitoso"),
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *             @OA\Property(property="token_type", type="string", example="bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id_usuario", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="Juan"),
     *                 @OA\Property(property="apellido", type="string", example="Pérez"),
     *                 @OA\Property(property="email", type="string", example="admin@edificio.com"),
     *                 @OA\Property(property="tipo_usuario", type="string", example="Administrador")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales inválidas",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Credenciales inválidas")
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        
        // Buscar usuario por email
        $usuario = Usuario::where('email', $credentials['email'])->first();
        
        if (!$usuario || !Hash::check($credentials['password'], $usuario->password_hash)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        if (!$usuario->activo) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario inactivo'
            ], 401);
        }

        // Generar token JWT
        $token = JWTAuth::fromUser($usuario);

        return response()->json([
            'success' => true,
            'message' => 'Login exitoso',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600, // 1 hora
            'user' => [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email,
                'tipo_usuario' => $usuario->tipo_usuario,
                'activo' => $usuario->activo
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register",
     *     tags={"Auth"},
     *     summary="Registrar nuevo usuario",
     *     description="Crear una nueva cuenta de usuario",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre","email","password","tipo_usuario"},
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Pérez"),
     *             @OA\Property(property="email", type="string", format="email", example="juan@edificio.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="telefono", type="string", example="1234567890"),
     *             @OA\Property(property="tipo_usuario", type="string", enum={"Administrador", "Residente", "Visitante"}, example="Residente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario creado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Usuario creado exitosamente"),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id_usuario", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="Juan"),
     *                 @OA\Property(property="apellido", type="string", example="Pérez"),
     *                 @OA\Property(property="email", type="string", example="juan@edificio.com"),
     *                 @OA\Property(property="tipo_usuario", type="string", example="Residente")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error de validación"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'tipo_usuario' => $request->tipo_usuario,
            'fecha_registro' => now(),
            'activo' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente',
            'user' => [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email,
                'tipo_usuario' => $usuario->tipo_usuario,
                'activo' => $usuario->activo
            ]
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="Cerrar sesión",
     *     description="Invalidar el token JWT actual",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Logout exitoso")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token inválido",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Token inválido")
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
            'message' => 'Logout exitoso'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auth/me",
     *     tags={"Auth"},
     *     summary="Obtener información del usuario autenticado",
     *     description="Obtener los datos del usuario actual",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Información del usuario",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id_usuario", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="Juan"),
     *                 @OA\Property(property="apellido", type="string", example="Pérez"),
     *                 @OA\Property(property="email", type="string", example="juan@edificio.com"),
     *                 @OA\Property(property="tipo_usuario", type="string", example="Residente"),
     *                 @OA\Property(property="telefono", type="string", example="1234567890"),
     *                 @OA\Property(property="activo", type="boolean", example=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="No autenticado")
     *         )
     *     )
     * )
     */
    public function me(): JsonResponse
    {
        $usuario = auth('api')->user();

        return response()->json([
            'success' => true,
            'user' => [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email,
                'tipo_usuario' => $usuario->tipo_usuario,
                'telefono' => $usuario->telefono,
                'activo' => $usuario->activo,
                'fecha_registro' => $usuario->fecha_registro
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/refresh",
     *     tags={"Auth"},
     *     summary="Renovar token JWT",
     *     description="Obtener un nuevo token JWT",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token renovado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *             @OA\Property(property="token_type", type="string", example="bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600)
     *         )
     *     )
     * )
     */
    public function refresh(): JsonResponse
    {
        $token = JWTAuth::getToken();
        $newToken = JWTAuth::refresh($token);

        return response()->json([
            'success' => true,
            'token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => 3600 // 1 hora
        ]);
    }
}