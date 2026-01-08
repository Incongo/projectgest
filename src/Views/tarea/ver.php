<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1"><?= htmlspecialchars($tarea->titulo) ?></h1>

            <!-- Estado -->
            <?php
            $estado = $tarea->estado->nombre ?? 'Sin estado';

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
            <a href="<?= BASE_URL ?>tarea/editar/<?= $tarea->id ?>" class="btn btn-primary me-2">
                <i class="bi bi-pencil"></i> Editar
            </a>

            <a href="<?= BASE_URL ?>tarea/borrar/<?= $tarea->id ?>"
                class="btn btn-danger"
                onclick="return confirm('¿Seguro que deseas borrar esta tarea?')">
                <i class="bi bi-trash"></i> Borrar
            </a>
        </div>
    </div>

    <!-- Proyecto -->
    <p class="text-muted mb-4">
        <i class="bi bi-folder2-open"></i>
        Proyecto:
        <a href="<?= BASE_URL ?>proyecto/ver/<?= $tarea->proyecto->proyecto_id ?>">
            <?= htmlspecialchars($tarea->proyecto->titulo) ?>
        </a>
    </p>

    <!-- Descripción -->
    <?php if (!empty($tarea->descripcion)): ?>
        <div class="mb-4">
            <h5 class="fw-bold">Descripción</h5>
            <p class="text-muted"><?= nl2br(htmlspecialchars($tarea->descripcion)) ?></p>
        </div>
    <?php endif; ?>

    <!-- Comentario -->
    <?php if (!empty($tarea->comentario)): ?>
        <div class="mb-4">
            <h5 class="fw-bold">Comentario</h5>
            <p class="text-muted"><?= nl2br(htmlspecialchars($tarea->comentario)) ?></p>
        </div>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>proyecto/ver/<?= $tarea->proyecto->proyecto_id ?>" class="btn btn-secondary">
        Volver al proyecto
    </a>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>