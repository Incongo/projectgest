<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="ui segment">

    <h1 class="ui header">Crear nuevo proyecto</h1>

    <?php if (!empty($errores)): ?>
        <div class="ui red message">
            <ul class="list">
                <?php foreach ($errores as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="ui form" action="<?= BASE_URL ?>proyecto/guardar" method="POST">

        <div class="field">
            <label>Título</label>
            <input type="text" name="titulo" required>
        </div>

        <div class="field">
            <label>Descripción</label>
            <textarea name="descripcion"></textarea>
        </div>

        <div class="two fields">
            <div class="field">
                <label>Fecha inicio</label>
                <input type="date" name="fecha_inicio">
            </div>

            <div class="field">
                <label>Fecha fin</label>
                <input type="date" name="fecha_fin">
            </div>
        </div>

        <button class="ui green button">Crear proyecto</button>
        <a href="<?= BASE_URL ?>proyecto" class="ui button">Cancelar</a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>