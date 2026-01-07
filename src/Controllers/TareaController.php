<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;

class TareaController extends Controller
{
    public function index(): void
    {
        $usuarioId = $_SESSION['user_id'];

        $tareas = Tarea::where('usuario_id', $usuarioId)
            ->with(['estado', 'proyecto'])
            ->get();

        $this->view('tarea/index', [
            'titulo' => 'Mis Tareas',
            'tareas' => $tareas
        ]);
    }

    public function nueva(): void
    {
        $usuarioId = $_SESSION['user_id'];

        $proyectos = Proyecto::where('usuario_id', $usuarioId)->get();
        $estados = Estado::all();

        $this->view('tarea/nueva', [
            'proyectos' => $proyectos,
            'estados' => $estados
        ]);
    }

    public function guardar(): void
    {
        $errores = [];

        if (empty($_POST['titulo'])) {
            $errores[] = 'El título es obligatorio.';
        }

        if (empty($_POST['proyecto_id'])) {
            $errores[] = 'Debes seleccionar un proyecto.';
        }

        if (empty($_POST['estado_id'])) {
            $errores[] = 'Debes seleccionar un estado.';
        }

        if (!empty($errores)) {
            $this->view('tarea/nueva', [
                'errores' => $errores,
                'proyectos' => Proyecto::where('usuario_id', $_SESSION['user_id'])->get(),
                'estados' => Estado::all()
            ]);
            return;
        }

        Tarea::create([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'comentario' => $_POST['comentario'] ?? null,
            'usuario_id' => $_SESSION['user_id'],
            'estado_id' => $_POST['estado_id'],
            'proyecto_id' => $_POST['proyecto_id']
        ]);

        $this->redirect(BASE_URL . 'tarea');
    }

    public function editar(int $id): void
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            die('Tarea no encontrada');
        }

        $proyectos = Proyecto::where('usuario_id', $_SESSION['user_id'])->get();
        $estados = Estado::all();

        $this->view('tarea/editar', [
            'tarea' => $tarea,
            'proyectos' => $proyectos,
            'estados' => $estados
        ]);
    }

    public function actualizar(int $id): void
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            die('Tarea no encontrada');
        }

        if (empty($_POST['titulo'])) {
            $this->view('tarea/editar', [
                'tarea' => $tarea,
                'error' => 'El título es obligatorio.',
                'proyectos' => Proyecto::where('usuario_id', $_SESSION['user_id'])->get(),
                'estados' => Estado::all()
            ]);
            return;
        }

        $tarea->update([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'comentario' => $_POST['comentario'] ?? null,
            'estado_id' => $_POST['estado_id'],
            'proyecto_id' => $_POST['proyecto_id']
        ]);

        $this->redirect(BASE_URL . 'tarea');
    }

    public function borrar(int $id): void
    {
        $tarea = Tarea::find($id);

        if ($tarea) {
            $tarea->delete();
        }

        $this->redirect(BASE_URL . 'tarea');
    }
}
