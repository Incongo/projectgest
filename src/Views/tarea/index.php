<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Mis tareas</h1>
        <a href="<?= BASE_URL ?>tarea/nueva" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva tarea
        </a>
    </div>

    <?php if (empty($tareas)): ?>
        <div class="alert alert-info text-center">
            No tienes tareas todavía.
            <a href="<?= BASE_URL ?>tarea/nueva">Crea tu primera tarea</a>.
        </div>
    <?php else: ?>

        <div class="row g-4">

            <?php foreach ($tareas as $tarea): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 card-hover">

                        <div class="card-body">

                            <!-- Título -->
                            <h5 class="fw-bold mb-2">
                                <?= htmlspecialchars($tarea->titulo) ?>
                            </h5>

                            <!-- Proyecto -->
                            <p class="text-muted mb-1">
                                <i class="bi bi-folder2-open"></i>
                                <?= $tarea->proyecto ? htmlspecialchars($tarea->proyecto->nombre) : 'Sin proyecto' ?>
                            </p>

                            <!-- Descripción -->
                            <?php if (!empty($tarea->descripcion)): ?>
                                <p class="mt-3 text-muted small">
                                    <?= nl2br(htmlspecialchars($tarea->descripcion)) ?>
                                </p>
                            <?php endif; ?>


                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="<?= BASE_URL ?>tarea/editar/<?= $tarea->id ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>

                            <a href="<?= BASE_URL ?>tarea/borrar/<?= $tarea->id ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                                <i class="bi bi-trash"></i> Borrar
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>