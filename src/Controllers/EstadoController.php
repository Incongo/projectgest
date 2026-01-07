<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function index(): void
    {
        $estados = Estado::all();

        $this->view('estado/index', [
            'titulo' => 'Estados',
            'estados' => $estados
        ]);
    }
}
