<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Mis Proyectos</h2>
    <a href="<?= BASE_URL ?>proyecto/nueva" class="btn btn-success">Nuevo Proyecto</a>
</div>

<?php if (empty($proyectos)): ?>
    <div class="alert alert-info">Aún no tienes proyectos creados.</div>
<?php else: ?>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th style="width: 180px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyectos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p->titulo) ?></td>
                            <td><?= $p->fecha_inicio ?: '-' ?></td>
                            <td><?= $p->fecha_fin ?: '-' ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>proyecto/editar/<?= $p->proyecto_id ?>" class="btn btn-sm btn-primary">Editar</a>
                                <a href="<?= BASE_URL ?>proyecto/borrar/<?= $p->proyecto_id ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Seguro que deseas borrar este proyecto?')">
                                    Borrar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>