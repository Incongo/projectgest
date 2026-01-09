<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;
use App\Models\Tarea;

class DashboardController extends Controller
{
    public function index(): void
    {
        $usuarioId = $_SESSION['user_id'];

        // Proyectos creados por el usuario
        $proyectosCreados = Proyecto::with([
            'estado',
            'tareas',
            'tareas.estado',
            'tareas.asignado'
        ])
            ->where('usuario_id', $usuarioId)
            ->get();

        // Proyectos donde tiene tareas asignadas
        $proyectosAsignados = Proyecto::with([
            'estado',
            'tareas',
            'tareas.estado',
            'tareas.asignado'
        ])
            ->whereHas('tareas', function ($q) use ($usuarioId) {
                $q->where('usuario_id', $usuarioId);
            })
            ->get();

        // Unimos ambos sin duplicados
        $todos = $proyectosCreados->merge($proyectosAsignados)->unique('proyecto_id');

        $this->view('dashboard/index', [
            'proyectos' => $todos,
            'usuarioId' => $usuarioId
        ]);
    }
}
