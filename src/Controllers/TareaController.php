<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function ver(int $id): void
    {
        $tarea = Tarea::with(['estado', 'proyecto', 'asignado'])->find($id);


        if (!$tarea) {
            die('Tarea no encontrada');
        }

        $usuarioId = $_SESSION['user_id'];

        $esCreador = $tarea->proyecto->usuario_id === $usuarioId;
        $esAsignado = $tarea->usuario_id === $usuarioId;

        if (!$esCreador && !$esAsignado) {
            die('No tienes permiso para ver esta tarea');
        }

        $this->view('tarea/ver', [
            'tarea' => $tarea,
            'esCreador' => $esCreador,
            'esAsignado' => $esAsignado
        ]);
    }

    public function comentar(int $id): void
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            die('Tarea no encontrada');
        }

        $usuarioId = $_SESSION['user_id'];

        if ($tarea->usuario_id !== $usuarioId) {
            die('No tienes permiso para comentar esta tarea');
        }

        $tarea->update([
            'comentario' => $_POST['comentario'] ?? null
        ]);

        $this->redirect(BASE_URL . 'tarea/ver/' . $id);
    }
}
