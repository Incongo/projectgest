<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="ui segment">

    <h1 class="ui header">Editar proyecto</h1>

    <?php if (!empty($error)): ?>
        <div class="ui red message">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form class="ui form" action="<?= BASE_URL ?>proyecto/editar/<?= $proyecto->proyecto_id ?>" method="POST">

        <div class="field">
            <label>Título</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($proyecto->titulo) ?>" required>
        </div>

        <div class="field">
            <label>Descripción</label>
            <textarea name="descripcion"><?= htmlspecialchars($proyecto->descripcion) ?></textarea>
        </div>

        <div class="two fields">
            <div class="field">
                <label>Fecha inicio</label>
                <input type="date" name="fecha_inicio" value="<?= $proyecto->fecha_inicio ?>">
            </div>

            <div class="field">
                <label>Fecha fin</label>
                <input type="date" name="fecha_fin" value="<?= $proyecto->fecha_fin ?>">
            </div>
        </div>

        <button class="ui green button">Guardar cambios</button>
        <a href="<?= BASE_URL ?>proyecto" class="ui button">Cancelar</a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>