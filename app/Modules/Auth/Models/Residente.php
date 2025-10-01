<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    use HasFactory;

    protected $table = 'residentes';
    protected $primaryKey = 'id_residente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'id_departamento',
        'fecha_mudanza',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_mudanza' => 'date',
    ];

    /**
     * Relación con Usuario
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Relación con Departamento (se creará en el módulo Propiedades)
     */
    public function departamento()
    {
        return $this->belongsTo(\App\Modules\Propiedades\Models\Departamento::class, 'id_departamento', 'id_departamento');
    }

    /**
     * Relación con Visitantes que lo visitan
     */
    public function visitantes()
    {
        return $this->hasMany(Visitante::class, 'id_residente_visita', 'id_residente');
    }
}