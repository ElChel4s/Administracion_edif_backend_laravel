<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="API de Administración de Edificios",
 *     version="1.0.0",
 *     description="API RESTful para la administración de edificios residenciales",
 *     @OA\Contact(
 *         email="admin@edificios.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor de desarrollo"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Ingrese el token JWT en el formato: Bearer {token}"
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="Endpoints de autenticación y autorización"
 * )
 *
 * @OA\Tag(
 *     name="Usuarios",
 *     description="Gestión de usuarios"
 * )
 *
 * @OA\Tag(
 *     name="Finanzas",
 *     description="Gestión financiera y facturación"
 * )
 *
 * @OA\Tag(
 *     name="Propiedades",
 *     description="Gestión de propiedades y contratos"
 * )
 *
 * @OA\Tag(
 *     name="Mantenimiento",
 *     description="Gestión de incidentes y mantenimiento"
 * )
 *
 * @OA\Tag(
 *     name="Recursos",
 *     description="Gestión de recursos y reservas"
 * )
 *
 * @OA\Tag(
 *     name="Seguridad",
 *     description="Gestión de seguridad y vehículos"
 * )
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
