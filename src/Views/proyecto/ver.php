<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <!-- Encabezado del proyecto -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1"><?= htmlspecialchars($proyecto->titulo) ?></h1>

            <!-- Estado del proyecto -->
            <?php
            $estado = $proyecto->estado->nombre ?? 'Sin estado';

            $badgeClass = match ($estado) {
                'Pendiente'   => 'bg-warning text-dark',
                'En progreso' => 'bg-info text-dark',
                'Finalizado'  => 'bg-success',
                default       => 'bg-secondary'
            };
            ?>
            <span class="badge <?= $badgeClass ?> px-3 py-2">
                <?= htmlspecialchars($estado) ?>
            </span>
        </div>

        <div>
            <a href="<?= BASE_URL ?>proyecto/editar/<?= $proyecto->proyecto_id ?>" class="btn btn-primary me-2">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="<?= BASE_URL ?>proyecto" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>

    <!-- Descripción -->
    <?php if (!empty($proyecto->descripcion)): ?>
        <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($proyecto->descripcion)) ?></p>
    <?php endif; ?>

    <!-- Fechas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <p class="text-muted">
                <i class="bi bi-calendar-event"></i>
                <strong>Inicio:</strong> <?= $proyecto->fecha_inicio ?: '—' ?>
            </p>
        </div>
        <div class="col-md-6">
            <p class="text-muted">
                <i class="bi bi-calendar-check"></i>
                <strong>Fin:</strong> <?= $proyecto->fecha_fin ?: '—' ?>
            </p>
        </div>
    </div>

    <hr class="my-4">

    <!-- Zona de tareas del proyecto -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Tareas del proyecto</h3>

        <a href="<?= BASE_URL ?>tarea/nueva?proyecto=<?= $proyecto->proyecto_id ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Añadir tarea
        </a>
    </div>

    <?php if (!$proyecto->tareas || $proyecto->tareas->isEmpty()): ?>

        <div class="alert alert-info">
            Este proyecto no tiene tareas todavía.
        </div>
    <?php else: ?>
        <div class="row g-3">

            <?php foreach ($proyecto->tareas as $t): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 card-hover">

                        <div class="card-body">

                            <h5 class="fw-bold mb-2"><?= htmlspecialchars($t->titulo) ?></h5>

                            <!-- Estado de la tarea -->
                            <?php
                            $estadoT = $t->estado->nombre ?? 'Sin estado';

                            $badgeClassT = match ($estadoT) {
                                'Pendiente'   => 'bg-warning text-dark',
                                'En progreso' => 'bg-info text-dark',
                                'Finalizado'  => 'bg-success',
                                default       => 'bg-secondary'
                            };
                            ?>

                            <span class="badge <?= $badgeClassT ?> px-2 py-1 mb-2">
                                <?= htmlspecialchars($estadoT) ?>
                            </span>

                            <?php if (!empty($t->descripcion)): ?>
                                <p class="text-muted small mt-2">
                                    <?= nl2br(htmlspecialchars($t->descripcion)) ?>
                                </p>
                            <?php endif; ?>

                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="<?= BASE_URL ?>tarea/ver/<?= $t->id ?>" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Ver
                            </a>

                            <div>
                                <a href="<?= BASE_URL ?>tarea/editar/<?= $t->id ?>" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= BASE_URL ?>tarea/borrar/<?= $t->id ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Seguro que deseas borrar esta tarea?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>