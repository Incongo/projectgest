<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'ProjectGest' ?></title>

    <!-- Semantic UI -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>

    <style>
        body {
            background: #f4f4f4;
        }

        .main-container {
            margin-top: 2rem;
            margin-bottom: 4rem;
        }
    </style>
</head>

<body>

    <!-- NAVBAR Semantic UI -->
    <div class="ui inverted menu">
        <div class="ui container">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>dashboard" class="header item">
                    ProjectGest
                </a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>" class="header item">
                    ProjectGest
                </a>
            <?php endif; ?>


            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>dashboard" class="item">Inicio</a>
                <a href="<?= BASE_URL ?>auth/logout" class="item">Salir</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>auth/login" class="item">Login</a>
                <a href="<?= BASE_URL ?>auth/register" class="item">Registro</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="ui container main-container">