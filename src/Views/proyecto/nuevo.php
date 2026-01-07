<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h2 class="fw-bold mb-4">Nuevo Proyecto</h2>

<?php if (!empty($errores)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>proyecto/guardar">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="3"></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control">
        </div>
    </div>

    <button class="btn btn-success">Crear Proyecto</button>
    <a href="<?= BASE_URL ?>proyecto" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>