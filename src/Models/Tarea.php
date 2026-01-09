<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'tarea_id';

    protected $fillable = [
        'titulo',
        'descripcion',
        'comentario',
        'usuario_id',   // asignado
        'creador_id',   // NUEVO: creador de la tarea
        'estado_id',
        'proyecto_id'
    ];

    // Usuario asignado
    public function asignado()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }


    // Creador de la tarea
    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'creador_id', 'usuario_id');
    }

    // Estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'estado_id');
    }

    // Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'proyecto_id');
    }
}
