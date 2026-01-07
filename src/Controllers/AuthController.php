<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;


class AuthController extends Controller
{
    public function login(): void
    {

        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $this->procesar();
            return;
        }
        $this->view('auth/login', []);
    }

    public function register(): void
    {
        if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            // Procesar registro
            try {
                $usuario = new Usuario();
                $usuario->nombre = $_POST["nombre"];
                $usuario->email = $_POST["email"];
                $usuario->password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                $usuario->save();
                header('Location: ' . BASE_URL . 'auth/login');
                exit;
            } catch (\Exception $e) {
                $this->view('auth/register', [
                    'error' => 'Error al registrar el usuario: El email ya existe.'
                ]);
                return;
            }
        }
        $this->view('auth/register', []);
    }

    private function procesar(): void
    {
        //usar el modelo User para validar el login
        //buscar usuario por email
        $usuario = Usuario::where('email', $_POST['email'])->first();
        if ($usuario && password_verify($_POST['password'], $usuario->password)) {
            // Credenciales correctas
            $_SESSION['user_id'] = $usuario->usuario_id;
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        } else {
            // Credenciales incorrectas
            $this->view('auth/login', [
                'error' => 'Email o contraseña incorrectos.'
            ]);
        }
    }
    public final function logout(): void
    {
        // Destruir sesión y redirigir al login
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }
}
