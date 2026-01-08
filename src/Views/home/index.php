<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5 fade-in">

    <!-- Hero principal -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-4">Gestiona tus proyectos con estilo</h1>
        <p class="fs-5 mt-3">
            ProjectGest te ayuda a organizar tus ideas, tareas y proyectos de forma clara y eficiente.
        </p>
    </div>

    <!-- Tarjeta premium con botones -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 card-hover p-4" style="background: #f8f9faff;">
                <div class="text-center">

                    <!-- Icono grande -->
                    <i class="bi bi-rocket-takeoff-fill text-primary" style="font-size: 4rem;"></i>

                    <h3 class="fw-bold mt-3">Empieza tu viaje</h3>
                    <p class="text-muted mb-4">
                        Da el primer paso hacia una gestión de proyectos más organizada, clara y profesional.
                    </p>

                    <div class="d-grid gap-3">
                        <a href="<?= BASE_URL ?>auth/register" class="btn btn-primary btn-lg">
                            Crear cuenta
                        </a>
                        <a href="<?= BASE_URL ?>auth/login" class="btn btn-secondary btn-lg">
                            Iniciar sesión
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Características -->
    <div class="row text-center g-4">

        <div class="col-md-4">
            <div class="card text-dark shadow-sm h-100 border-0 card-hover">
                <div class="card-body">
                    <i class="bi bi-kanban fs-1 text-primary"></i>
                    <h4 class="fw-bold mt-3">Proyectos</h4>
                    <p>Organiza tus proyectos de forma clara y visual.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-dark shadow-sm h-100 border-0 card-hover">
                <div class="card-body">
                    <i class="bi bi-check2-square fs-1 text-success"></i>
                    <h4 class="fw-bold mt-3">Tareas</h4>
                    <p>Divide tus proyectos en tareas y controla el progreso.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-dark shadow-sm h-100 border-0 card-hover">
                <div class="card-body">
                    <i class="bi bi-flag fs-1 text-danger"></i>
                    <h4 class="fw-bold mt-3">Estados</h4>
                    <p>Personaliza los estados según tu forma de trabajar.</p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>