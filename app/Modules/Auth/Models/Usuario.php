<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password_hash',
        'telefono',
        'tipo_usuario',
        'fecha_registro',
        'activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_registro' => 'datetime',
        'activo' => 'boolean',
    ];

    /**
     * Tipos de usuario disponibles
     */
    const TIPO_ADMINISTRADOR = 'Administrador';
    const TIPO_RESIDENTE = 'Residente';
    const TIPO_VISITANTE = 'Visitante';

    /**
     * Relación con Administradores
     */
    public function administrador()
    {
        return $this->hasOne(\App\Modules\Auth\Models\Administrador::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Relación con Residentes
     */
    public function residente()
    {
        return $this->hasOne(\App\Modules\Auth\Models\Residente::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Relación con Visitantes
     */
    public function visitante()
    {
        return $this->hasOne(\App\Modules\Auth\Models\Visitante::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Verificar si es administrador
     */
    public function esAdministrador(): bool
    {
        return $this->tipo_usuario === self::TIPO_ADMINISTRADOR;
    }

    /**
     * Verificar si es residente
     */
    public function esResidente(): bool
    {
        return $this->tipo_usuario === self::TIPO_RESIDENTE;
    }

    /**
     * Verificar si es visitante
     */
    public function esVisitante(): bool
    {
        return $this->tipo_usuario === self::TIPO_VISITANTE;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'tipo_usuario' => $this->tipo_usuario,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
        ];
    }

    /**
     * Override para usar password_hash en lugar de password
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}