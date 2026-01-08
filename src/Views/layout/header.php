<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Mi App' ?></title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">ProjectGest</a>

            <div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASE_URL ?>dashboard" class="btn btn-outline-light btn-sm">Inicio</a>
                    <a href="<?= BASE_URL ?>auth/logout" class="btn btn-danger btn-sm">Salir</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>auth/login" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="<?= BASE_URL ?>auth/register" class="btn btn-success btn-sm">Registro</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">