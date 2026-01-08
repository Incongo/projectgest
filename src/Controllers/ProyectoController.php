<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;
use App\Models\Estado;

class ProyectoController extends Controller
{
    public function index(): void
    {
        $usuarioId = $_SESSION['user_id'] ?? null;

        $proyectos = Proyecto::where('usuario_id', $usuarioId)
            ->with('estado') // ← Añadido para mostrar estado en index
            ->get();

        $this->view('proyecto/index', [
            'titulo' => 'Mis Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public function nuevo(): void
    {
        $estados = Estado::all(); // ← Cargar estados globales

        $this->view('proyecto/nuevo', [
            'titulo' => 'Nuevo Proyecto',
            'estados' => $estados
        ]);
    }

    public function guardar(): void
    {
        $errores = [];

        if (empty($_POST['titulo'])) {
            $errores[] = 'El título es obligatorio.';
        }

        if (empty($_POST['estado_id'])) {
            $errores[] = 'Debes seleccionar un estado.';
        }

        if (!empty($errores)) {
            $this->view('proyecto/nuevo', [
                'errores' => $errores,
                'estados' => Estado::all() // ← Volver a cargar estados
            ]);
            return;
        }

        Proyecto::create([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
            'fecha_fin' => $_POST['fecha_fin'] ?? null,
            'usuario_id' => $_SESSION['user_id'],
            'estado_id' => $_POST['estado_id'] // ← Guardar estado
        ]);

        $this->redirect(BASE_URL . 'proyecto');
    }

    public function editar(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            die('Proyecto no encontrado');
        }

        $estados = Estado::all(); // ← Cargar estados globales

        // GET → mostrar formulario
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view('proyecto/editar', [
                'proyecto' => $proyecto,
                'estados' => $estados
            ]);
            return;
        }

        // POST → procesar actualización
        if (empty($_POST['titulo'])) {
            $this->view('proyecto/editar', [
                'proyecto' => $proyecto,
                'estados' => $estados,
                'error' => 'El título es obligatorio.'
            ]);
            return;
        }

        $proyecto->update([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
            'fecha_fin' => $_POST['fecha_fin'] ?? null,
            'estado_id' => $_POST['estado_id'] // ← Actualizar estado
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
    public function ver(int $id): void
    {
        $proyecto = Proyecto::with(['estado', 'tareas', 'tareas.estado'])->find($id);


        if (!$proyecto) {
            die('Proyecto no encontrado');
        }

        // Comprobación de permisos: solo el dueño del proyecto puede verlo
        $usuarioId = $_SESSION['user_id'];

        if ($proyecto->usuario_id !== $usuarioId) {
            die('No tienes permiso para ver este proyecto');
        }

        $this->view('proyecto/ver', [
            'proyecto' => $proyecto
        ]);
    }
}
