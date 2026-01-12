<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="ui segment">

    <h1 class="ui header">Panel general</h1>
    <p class="ui small text">Aquí ves todos los proyectos en los que participas.</p>

    <a href="<?= BASE_URL ?>proyecto/nuevo" class="ui primary button">
        <i class="plus icon"></i>
        Crear nuevo proyecto
    </a>

    <div class="ui divider"></div>


    <?php if ($proyectos->isEmpty()): ?>
        <div class="ui message">
            No participas en ningún proyecto.
        </div>
    <?php else: ?>

        <div class="ui styled fluid accordion">

            <?php foreach ($proyectos as $p): ?>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?= htmlspecialchars($p->titulo) ?>
                    <span class="ui label"><?= htmlspecialchars($p->estado->nombre) ?></span>
                </div>

                <div class="content">

                    <!-- DESCRIPCIÓN -->
                    <?php if ($p->descripcion): ?>
                        <p><?= nl2br(htmlspecialchars($p->descripcion)) ?></p>
                    <?php endif; ?>

                    <!-- BOTONES -->
                    <a href="<?= BASE_URL ?>proyecto/ver/<?= $p->proyecto_id ?>" class="ui blue button small">
                        Ver proyecto
                    </a>

                    <?php if ($p->usuario_id === $usuarioId): ?>
                        <a href="<?= BASE_URL ?>proyecto/editar/<?= $p->proyecto_id ?>" class="ui button small">
                            Editar
                        </a>
                    <?php endif; ?>

                    <div class="ui divider"></div>

                    <!-- TAREAS EN CASCADA -->
                    <h4 class="ui header">Tareas</h4>

                    <?php if ($p->tareas->isEmpty()): ?>
                        <div class="ui message">Este proyecto no tiene tareas.</div>
                    <?php else: ?>

                        <div class="ui relaxed divided list">

                            <?php foreach ($p->tareas as $t): ?>
                                <div class="item">

                                    <i class="large tasks middle aligned icon"></i>

                                    <div class="content">

                                        <div class="header">
                                            <?= htmlspecialchars($t->titulo) ?>
                                            <span class="ui mini label"><?= htmlspecialchars($t->estado->nombre) ?></span>
                                        </div>

                                        <div class="description">
                                            <?= nl2br(htmlspecialchars($t->descripcion)) ?>
                                        </div>

                                        <div class="ui small horizontal list" style="margin-top:0.5rem;">
                                            <div class="item">
                                                <strong>Asignada a:</strong>
                                                <?= htmlspecialchars($t->asignado->nombre) ?>
                                            </div>
                                        </div>

                                        <div style="margin-top:0.5rem;">
                                            <a href="<?= BASE_URL ?>tarea/ver/<?= $t->tarea_id ?>" class="ui blue button tiny">
                                                Ver
                                            </a>

                                            <?php if ($p->usuario_id === $usuarioId): ?>
                                                <a href="<?= BASE_URL ?>tarea/editar/<?= $t->tarea_id ?>"
                                                    class="ui button tiny">
                                                    Editar

                                                    <a href="<?= BASE_URL ?>proyecto/borrarTarea/<?= $t->tarea_id ?>"
                                                        class="ui red button tiny"
                                                        onclick="return confirm('¿Seguro que deseas borrar esta tarea?')">
                                                        Borrar
                                                    </a>
                                                <?php endif; ?>

                                        </div>

                                    </div>

                                </div>
                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<script>
    $('.ui.accordion').accordion();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>