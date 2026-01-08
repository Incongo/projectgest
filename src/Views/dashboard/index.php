<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5 fade-in">

    <h1 class="fw-bold mb-4">Panel de Control</h1>
    <p class="text-light mb-5">Accede rápidamente a tus herramientas principales.</p>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card text-dark shadow-sm h-100 border-0 card-hover">
                <div class="card-body text-center">
                    <i class="bi bi-kanban fs-1 text-primary"></i>
                    <h4 class="fw-bold mt-3">Proyectos</h4>
                    <p>Gestiona tus proyectos activos.</p>
                    <a href="<?= BASE_URL ?>proyecto" class="btn btn-primary w-100">Ir a Proyectos</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-dark shadow-sm h-100 border-0 card-hover">
                <div class="card-body text-center">
                    <i class="bi bi-check2-square fs-1 text-success"></i>
                    <h4 class="fw-bold mt-3">Tareas</h4>
                    <p>Revisa y organiza tus tareas.</p>
                    <a href="<?= BASE_URL ?>tarea" class="btn btn-success w-100">Ir a Tareas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-dark shadow-sm h-100 border-0 card-hover">
                <div class="card-body text-center">
                    <i class="bi bi-flag fs-1 text-danger"></i>
                    <h4 class="fw-bold mt-3">Estados</h4>
                    <p>Configura tus estados personalizados.</p>
                    <a href="<?= BASE_URL ?>estado" class="btn btn-danger w-100">Ir a Estados</a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>