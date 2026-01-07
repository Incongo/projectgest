<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h2 class="fw-bold mb-4">Editar Proyecto</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>proyecto/actualizar/<?= $proyecto->proyecto_id ?>">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input
            type="text"
            name="titulo"
            class="form-control"
            value="<?= htmlspecialchars($proyecto->titulo) ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($proyecto->descripcion) ?></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Fecha Inicio</label>
            <input
                type="date"
                name="fecha_inicio"
                class="form-control"
                value="<?= $proyecto->fecha_inicio ?>">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Fecha Fin</label>
            <input
                type="date"
                name="fecha_fin"
                class="form-control"
                value="<?= $proyecto->fecha_fin ?>">
        </div>
    </div>

    <button class="btn btn-primary">Guardar Cambios</button>
    <a href="<?= BASE_URL ?>proyecto" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>