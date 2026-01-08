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
        'usuario_id',
        'estado_id',
        'proyecto_id'
    ];


    // Una tarea pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    // Una tarea pertenece a un estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'estado_id');
    }

    // Una tarea pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'proyecto_id');
    }
}
