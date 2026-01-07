<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index(): void
    {
        $usuario = Usuario::find($_SESSION['user_id']);

        $this->view('dashboard/index', [
            'usuario' => $usuario
        ]);
    }
}
