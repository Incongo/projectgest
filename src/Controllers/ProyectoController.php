<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    public function index(): void
    {
        $usuarioId = $_SESSION['user_id'] ?? null;

        $proyectos = Proyecto::where('usuario_id', $usuarioId)->get();

        $this->view('proyecto/index', [
            'titulo' => 'Mis Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public function nuevo(): void
    {
        $this->view('proyecto/nuevo', [
            'titulo' => 'Nuevo Proyecto'
        ]);
    }

    public function guardar(): void
    {
        $errores = [];

        if (empty($_POST['titulo'])) {
            $errores[] = 'El título es obligatorio.';
        }

        if (!empty($errores)) {
            $this->view('proyecto/nuevo', [
                'errores' => $errores
            ]);
            return;
        }

        Proyecto::create([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'tareas' => $_POST['tareas'] ?? null,
            'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
            'fecha_fin' => $_POST['fecha_fin'] ?? null,
            'usuario_id' => $_SESSION['user_id']
        ]);

        $this->redirect(BASE_URL . 'proyecto');
    }

    public function editar(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            die('Proyecto no encontrado');
        }

        // Si es GET → mostrar formulario
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view('proyecto/editar', [
                'proyecto' => $proyecto
            ]);
            return;
        }

        // Si es POST → procesar actualización
        if (empty($_POST['titulo'])) {
            $this->view('proyecto/editar', [
                'proyecto' => $proyecto,
                'error' => 'El título es obligatorio.'
            ]);
            return;
        }

        $proyecto->update([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'tareas' => $_POST['tareas'] ?? null,
            'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
            'fecha_fin' => $_POST['fecha_fin'] ?? null,
        ]);

        $this->redirect(BASE_URL . 'proyecto');
    }

    public function borrar(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if ($proyecto) {
            $proyecto->delete();
        }

        $this->redirect(BASE_URL . 'proyecto');
    }
}
