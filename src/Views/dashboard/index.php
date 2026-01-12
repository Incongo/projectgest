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

        <?php
        $proyectosActivos = $proyectos->where('estado_id', '!=', 3);
        $proyectosFinalizados = $proyectos->where('estado_id', 3);
        ?>

        <!-- ============================================================
             PROYECTOS ACTIVOS
        ============================================================ -->
        <h2 class="ui header">Proyectos activos</h2>

        <?php if ($proyectosActivos->isEmpty()): ?>
            <div class="ui message">No tienes proyectos activos.</div>
        <?php else: ?>

            <div class="ui styled fluid accordion">

                <?php foreach ($proyectosActivos as $p): ?>

                    <?php
                    $claseEstado = $p->estado_id == 1 ? 'estado-pendiente' : ($p->estado_id == 2 ? 'estado-progreso' : 'estado-finalizado');
                    ?>

                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?= htmlspecialchars($p->titulo) ?>
                        <span class="ui label <?= $claseEstado ?>">
                            <?= htmlspecialchars($p->estado->nombre) ?>
                        </span>
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

                        <!-- TAREAS -->
                        <h4 class="ui header">Tareas</h4>

                        <?php if ($p->tareas->isEmpty()): ?>
                            <div class="ui message">Este proyecto no tiene tareas.</div>
                        <?php else: ?>

                            <div class="ui relaxed divided list">

                                <?php foreach ($p->tareas as $t): ?>

                                    <?php
                                    $claseEstadoTarea = $t->estado_id == 1 ? 'estado-pendiente' : ($t->estado_id == 2 ? 'estado-progreso' : 'estado-finalizado');
                                    ?>

                                    <div class="item">

                                        <i class="large tasks middle aligned icon"></i>

                                        <div class="content">

                                            <div class="header">
                                                <?= htmlspecialchars($t->titulo) ?>
                                                <span class="ui mini label <?= $claseEstadoTarea ?>">
                                                    <?= htmlspecialchars($t->estado->nombre) ?>
                                                </span>
                                            </div>

                                            <div class="description">
                                                <?= nl2br(htmlspecialchars($t->descripcion)) ?>
                                            </div>

                                            <div class="ui small horizontal list" style="margin-top:0.5rem;">
                                                <div class="item">
                                                    <strong>Asignada a:</strong>
                                                    <?= htmlspecialchars($t->asignado->nombre ?? 'Sin asignar') ?>
                                                </div>
                                            </div>

                                            <div style="margin-top:0.5rem;">
                                                <a href="<?= BASE_URL ?>tarea/ver/<?= $t->tarea_id ?>" class="ui blue button tiny">
                                                    Ver
                                                </a>

                                                <?php if ($p->usuario_id === $usuarioId): ?>
                                                    <a href="<?= BASE_URL ?>proyecto/ver/<?= $p->proyecto_id ?>?editar=<?= $t->tarea_id ?>"
                                                        class="ui button tiny">
                                                        Editar
                                                    </a>

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

        <!-- ============================================================
             PROYECTOS FINALIZADOS
        ============================================================ -->
        <h2 class="ui header" style="margin-top:3rem;">Proyectos finalizados</h2>

        <?php if ($proyectosFinalizados->isEmpty()): ?>
            <div class="ui message">No tienes proyectos finalizados.</div>
        <?php else: ?>

            <div class="ui styled fluid accordion">

                <?php foreach ($proyectosFinalizados as $p): ?>

                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?= htmlspecialchars($p->titulo) ?>
                        <span class="ui label estado-finalizado">Finalizado</span>
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

                        <div class="ui divider"></div>

                        <!-- TAREAS -->
                        <h4 class="ui header">Tareas</h4>

                        <?php if ($p->tareas->isEmpty()): ?>
                            <div class="ui message">Este proyecto no tiene tareas.</div>
                        <?php else: ?>

                            <div class="ui relaxed divided list">

                                <?php foreach ($p->tareas as $t): ?>

                                    <?php
                                    $claseEstadoTarea = $t->estado_id == 1 ? 'estado-pendiente' : ($t->estado_id == 2 ? 'estado-progreso' : 'estado-finalizado');
                                    ?>

                                    <div class="item">

                                        <i class="large tasks middle aligned icon"></i>

                                        <div class="content">

                                            <div class="header">
                                                <?= htmlspecialchars($t->titulo) ?>
                                                <span class="ui mini label <?= $claseEstadoTarea ?>">
                                                    <?= htmlspecialchars($t->estado->nombre) ?>
                                                </span>
                                            </div>

                                            <div class="description">
                                                <?= nl2br(htmlspecialchars($t->descripcion)) ?>
                                            </div>

                                            <div class="ui small horizontal list" style="margin-top:0.5rem;">
                                                <div class="item">
                                                    <strong>Asignada a:</strong>
                                                    <?= htmlspecialchars($t->asignado->nombre ?? 'Sin asignar') ?>
                                                </div>
                                            </div>

                                            <div style="margin-top:0.5rem;">
                                                <a href="<?= BASE_URL ?>tarea/ver/<?= $t->tarea_id ?>" class="ui blue button tiny">
                                                    Ver
                                                </a>
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

    <?php endif; ?>

</div>

<script>
    $('.ui.accordion').accordion();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>