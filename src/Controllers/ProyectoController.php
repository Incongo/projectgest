<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Tarea;
use App\Models\Usuario;

class ProyectoController extends Controller
{
    public function index(): void
    {
        $usuarioId = $_SESSION['user_id'];

        $proyectos = Proyecto::where('usuario_id', $usuarioId)
            ->with('estado')
            ->get();

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
        if (empty($_POST['titulo'])) {
            $this->view('proyecto/nuevo', [
                'errores' => ['El título es obligatorio.']
            ]);
            return;
        }

        // Creamos el proyecto y lo guardamos en una variable
        $proyecto = Proyecto::create([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
            'fecha_fin' => $_POST['fecha_fin'] ?? null,
            'usuario_id' => $_SESSION['user_id'],
            'estado_id' => 1
        ]);

        // Redirigimos al ver del proyecto recién creado
        $this->redirect(BASE_URL . 'proyecto/ver/' . $proyecto->proyecto_id);
    }


    public function editar(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) die('Proyecto no encontrado');
        if ($proyecto->usuario_id !== $_SESSION['user_id']) die('No tienes permiso');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view('proyecto/editar', ['proyecto' => $proyecto]);
            return;
        }

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
            'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
            'fecha_fin' => $_POST['fecha_fin'] ?? null
        ]);

        $this->redirect(BASE_URL . 'proyecto');
    }

    public function borrar(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) die('Proyecto no encontrado');
        if ($proyecto->usuario_id !== $_SESSION['user_id']) die('No tienes permiso');

        $proyecto->delete();

        $this->redirect(BASE_URL . 'proyecto');
    }

    public function ver(int $id): void
    {
        $proyecto = Proyecto::with([
            'estado',
            'creador',
            'tareas',
            'tareas.estado',
            'tareas.asignado'
        ])->find($id);

        if (!$proyecto) die('Proyecto no encontrado');

        $usuarioId = $_SESSION['user_id'];

        $esCreador = $proyecto->usuario_id === $usuarioId;

        $esAsignado = Tarea::where('proyecto_id', $proyecto->proyecto_id)
            ->where('usuario_id', $usuarioId)
            ->exists();

        if (!$esCreador && !$esAsignado) {
            die('No tienes permiso para ver este proyecto');
        }

        $usuarios = Usuario::all();

        $this->view('proyecto/ver', [
            'proyecto' => $proyecto,
            'usuarios' => $usuarios,
            'esCreador' => $esCreador
        ]);
    }
    public function cambiarEstado(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            die('Proyecto no encontrado');
        }

        if ($proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso para cambiar el estado de este proyecto');
        }

        $proyecto->update([
            'estado_id' => $_POST['estado_id']
        ]);

        $this->redirect(BASE_URL . 'proyecto/ver/' . $id);
    }


    /* ============================================================
       ===============  GESTIÓN DE TAREAS (MODALES) ===============
       ============================================================ */

    public function guardarTarea(): void
    {
        if (empty($_POST['titulo'])) die('El título es obligatorio');

        $proyecto = Proyecto::find($_POST['proyecto_id']);
        if (!$proyecto) die('Proyecto no encontrado');

        if ($proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso para añadir tareas');
        }

        Tarea::create([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'comentario' => null,
            'usuario_id' => $_POST['usuario_id'], // asignado
            'estado_id' => 1,
            'proyecto_id' => $proyecto->proyecto_id
        ]);

        $this->redirect(BASE_URL . 'proyecto/ver/' . $proyecto->proyecto_id);
    }

    public function actualizarTarea(int $id): void
    {
        $tarea = Tarea::with('proyecto')->find($id);
        if (!$tarea) die('Tarea no encontrada');

        if ($tarea->proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso para editar esta tarea');
        }

        $tarea->update([
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? null
            // NO tocamos usuario_id
        ]);

        $this->redirect(BASE_URL . 'proyecto/ver/' . $tarea->proyecto_id);
    }


    public function borrarTarea(int $id): void
    {
        $tarea = Tarea::with('proyecto')->find($id);
        if (!$tarea) die('Tarea no encontrada');

        if ($tarea->proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso');
        }

        $proyectoId = $tarea->proyecto_id;

        $tarea->delete();

        $this->redirect(BASE_URL . 'proyecto/ver/' . $proyectoId);
    }

    public function cambiarEstadoTarea(int $id): void
    {
        $tarea = Tarea::with('proyecto')->find($id);
        if (!$tarea) die('Tarea no encontrada');

        $usuarioId = $_SESSION['user_id'];

        $esCreador = $tarea->proyecto->usuario_id === $usuarioId;
        $esAsignado = $tarea->usuario_id === $usuarioId;

        if (!$esCreador && !$esAsignado) die('No tienes permiso');

        $tarea->update([
            'estado_id' => $_POST['estado_id']
        ]);

        $this->redirect(BASE_URL . 'proyecto/ver/' . $tarea->proyecto_id);
    }
}
