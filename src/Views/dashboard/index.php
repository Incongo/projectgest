<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="row">
    <div class="col-12 mb-4">
        <h2 class="fw-bold">Bienvenido, <?= htmlspecialchars($usuario->nombre) ?> 👋</h2>
        <p class="text-muted">Aquí puedes gestionar tus proyectos y tareas.</p>
    </div>
</div>

<div class="row g-4">

    <!-- Tarjeta Proyectos -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Proyectos</h4>
                <p class="card-text text-muted">Gestiona tus proyectos activos.</p>

                <a href="<?= BASE_URL ?>proyecto" class="btn btn-primary">
                    Ver Proyectos
                </a>

                <a href="<?= BASE_URL ?>proyecto/nuevo" class="btn btn-success">
                    Nuevo Proyecto
                </a>
            </div>
        </div>
    </div>

    <!-- Tarjeta Tareas -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Tareas</h4>
                <p class="card-text text-muted">Organiza tus tareas pendientes.</p>

                <a href="<?= BASE_URL ?>tarea" class="btn btn-primary">
                    Ver Tareas
                </a>

                <a href="<?= BASE_URL ?>tarea/nueva" class="btn btn-success">
                    Nueva Tarea
                </a>
            </div>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>