<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <h1 class="fw-bold mb-4">Editar tarea</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>tarea/actualizar/<?= $tarea->id ?>" method="POST" class="card p-4 shadow-sm border-0">

        <!-- Título -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Título *</label>
            <input
                type="text"
                name="titulo"
                class="form-control"
                value="<?= htmlspecialchars($tarea->titulo) ?>"
                required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($tarea->descripcion) ?></textarea>
        </div>

        <!-- Comentario -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Comentario</label>
            <textarea name="comentario" class="form-control" rows="2"><?= htmlspecialchars($tarea->comentario) ?></textarea>
        </div>

        <!-- Proyecto -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Proyecto *</label>
            <select name="proyecto_id" class="form-select" required>
                <?php foreach ($proyectos as $p): ?>
                    <option value="<?= $p->proyecto_id ?>"
                        <?= $tarea->proyecto_id == $p->proyecto_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p->titulo) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Estado *</label>
            <select name="estado_id" class="form-select" required>
                <?php foreach ($estados as $e): ?>
                    <option value="<?= $e->estado_id ?>"
                        <?= $tarea->estado_id == $e->estado_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($e->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>

        <button class="btn btn-primary btn-lg">
            <i class="bi bi-save"></i> Guardar cambios
        </button>

        <a href="<?= BASE_URL ?>proyecto/ver/<?= $tarea->proyecto_id ?>" class="btn btn-secondary btn-lg ms-2">
            Cancelar
        </a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>