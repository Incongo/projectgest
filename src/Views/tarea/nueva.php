<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-4 fade-in">

    <h1 class="fw-bold mb-4">Crear nueva tarea</h1>

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>tarea/guardar" method="POST" class="card p-4 shadow-sm border-0">

        <!-- Título -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Título *</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>

        <!-- Comentario -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Comentario</label>
            <textarea name="comentario" class="form-control" rows="2"></textarea>
        </div>

        <div class="row">
            <!-- Proyecto -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Proyecto *</label>
                <select name="proyecto_id" class="form-select" required>
                    <option value="">Selecciona un proyecto</option>

                    <?php foreach ($proyectos as $p): ?>
                        <option value="<?= $p->proyecto_id ?>"
                            <?= isset($proyectoId) && $proyectoId == $p->proyecto_id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p->titulo) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- Estado -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Estado *</label>
                <select name="estado_id" class="form-select" required>
                    <?php foreach ($estados as $e): ?>
                        <option value="<?= $e->estado_id ?>">
                            <?= htmlspecialchars($e->nombre) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>
        </div>

        <button class="btn btn-primary btn-lg mt-3">
            <i class="bi bi-plus-circle"></i> Crear tarea
        </button>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>