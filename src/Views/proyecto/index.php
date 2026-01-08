<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Mis Proyectos</h1>
        <a href="<?= BASE_URL ?>proyecto/nuevo" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Nuevo Proyecto
        </a>
    </div>

    <?php if (empty($proyectos)): ?>
        <div class="alert alert-info text-center">
            Aún no tienes proyectos creados.
        </div>
    <?php else: ?>

        <div class="row g-4">

            <?php foreach ($proyectos as $p): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 card-hover">

                        <div class="card-body">

                            <!-- Título -->
                            <h4 class="fw-bold mb-2">
                                <?= htmlspecialchars($p->titulo) ?>
                            </h4>

                            <!-- Estado del proyecto -->
                            <div class="mb-3">
                                <?php
                                $estado = $p->estado->nombre ?? 'Sin estado';

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

                            <!-- Fechas -->
                            <p class="text-muted small mb-1">
                                <i class="bi bi-calendar-event"></i>
                                Inicio: <?= $p->fecha_inicio ?: '—' ?>
                            </p>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-calendar-check"></i>
                                Fin: <?= $p->fecha_fin ?: '—' ?>
                            </p>

                            <!-- Descripción -->
                            <?php if (!empty($p->descripcion)): ?>
                                <p class="text-muted small">
                                    <?= nl2br(htmlspecialchars($p->descripcion)) ?>
                                </p>
                            <?php endif; ?>

                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="<?= BASE_URL ?>proyecto/ver/<?= $p->proyecto_id ?>" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Ver
                            </a>

                            <div>
                                <a href="<?= BASE_URL ?>proyecto/editar/<?= $p->proyecto_id ?>" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= BASE_URL ?>proyecto/borrar/<?= $p->proyecto_id ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Seguro que deseas borrar este proyecto?')">
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