<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <h1 class="fw-bold mb-4">Crear nuevo proyecto</h1>

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errores as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>proyecto/guardar" class="card p-4 shadow-sm border-0">

        <!-- SELECT DE ESTADO -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Estado *</label>
            <select name="estado_id" class="form-select" required>
                <?php foreach ($estados as $e): ?>
                    <option value="<?= $e->estado_id ?>">
                        <?= htmlspecialchars($e->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Título *</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>


        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Fecha inicio</label>
                <input type="date" name="fecha_inicio" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Fecha fin</label>
                <input type="date" name="fecha_fin" class="form-control">
            </div>
        </div>

        <button class="btn btn-primary btn-lg">
            <i class="bi bi-check-circle"></i> Crear proyecto
        </button>

        <a href="<?= BASE_URL ?>proyecto" class="btn btn-secondary btn-lg ms-2">
            Cancelar
        </a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>