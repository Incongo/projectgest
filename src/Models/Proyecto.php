<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'proyecto_id';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'usuario_id',   // creador
        'estado_id'
    ];

    // Creador del proyecto
    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    // Estado del proyecto
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'estado_id');
    }

    // Tareas del proyecto
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proyecto_id', 'proyecto_id');
    }

    // Usuarios invitados
    public function invitados()
    {
        return $this->belongsToMany(
            Usuario::class,
            'proyecto_usuario',
            'proyecto_id',
            'usuario_id'
        );
    }
}
