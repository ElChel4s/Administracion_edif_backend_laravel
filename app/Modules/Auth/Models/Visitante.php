<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $table = 'visitantes';
    protected $primaryKey = 'id_visitante';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'id_residente_visita',
        'motivo_visita',
        'fecha_entrada',
        'fecha_salida',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_entrada' => 'datetime',
        'fecha_salida' => 'datetime',
    ];

    /**
     * Relación con Usuario
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Relación con Residente visitado
     */
    public function residenteVisitado()
    {
        return $this->belongsTo(Residente::class, 'id_residente_visita', 'id_residente');
    }

    /**
     * Verificar si el visitante aún está en el edificio
     */
    public function estaEnEdificio(): bool
    {
        return is_null($this->fecha_salida);
    }

    /**
     * Marcar salida del visitante
     */
    public function marcarSalida()
    {
        $this->fecha_salida = now();
        $this->save();
    }
}