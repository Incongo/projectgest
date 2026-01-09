<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="ui segment">

    <?php $usuarioId = $_SESSION['user_id']; ?>
    <?php $esCreador = $proyecto->usuario_id === $usuarioId; ?>

    <!-- ENCABEZADO DEL PROYECTO -->
    <h1 class="ui header">
        <?= htmlspecialchars($proyecto->titulo) ?>
        <div class="sub header">
            Creado por: <?= htmlspecialchars($proyecto->creador->nombre) ?>
        </div>
    </h1>

    <!-- ESTADO DEL PROYECTO -->
    <div class="ui label large">
        Estado: <?= htmlspecialchars($proyecto->estado->nombre) ?>
    </div>

    <?php if ($esCreador): ?>
        <form action="<?= BASE_URL ?>proyecto/cambiarEstado/<?= $proyecto->proyecto_id ?>" method="POST" class="ui form" style="margin-top:1rem;">
            <div class="fields">
                <div class="field">
                    <select name="estado_id" class="ui dropdown">
                        <option value="1" <?= $proyecto->estado_id == 1 ? 'selected' : '' ?>>Pendiente</option>
                        <option value="2" <?= $proyecto->estado_id == 2 ? 'selected' : '' ?>>En progreso</option>
                        <option value="3" <?= $proyecto->estado_id == 3 ? 'selected' : '' ?>>Finalizado</option>
                    </select>
                </div>
                <div class="field">
                    <button class="ui green button">Actualizar estado</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <!-- DESCRIPCIÓN -->
    <?php if (!empty($proyecto->descripcion)): ?>
        <div class="ui segment">
            <?= nl2br(htmlspecialchars($proyecto->descripcion)) ?>
        </div>
    <?php endif; ?>

    <!-- FECHAS -->
    <div class="ui two column grid">
        <div class="column">
            <strong>Inicio:</strong> <?= $proyecto->fecha_inicio ?: '—' ?>
        </div>
        <div class="column">
            <strong>Fin:</strong> <?= $proyecto->fecha_fin ?: '—' ?>
        </div>
    </div>

    <div class="ui divider"></div>

    <!-- TAREAS -->
    <div class="ui clearing segment">
        <h2 class="ui header left floated">Tareas del proyecto</h2>

        <?php if ($esCreador): ?>
            <button class="ui primary button right floated" onclick="$('#modalNuevaTarea').modal('show')">
                Añadir tarea
            </button>
        <?php endif; ?>

        <div style="clear:both;"></div>
    </div>

    <?php
    $activas = $proyecto->tareas->where('estado_id', '!=', 3);
    $finalizadas = $proyecto->tareas->where('estado_id', 3);
    ?>

    <!-- TAREAS ACTIVAS -->
    <h3 class="ui header">Tareas activas</h3>

    <?php if ($activas->isEmpty()): ?>
        <div class="ui message">No hay tareas activas.</div>
    <?php else: ?>
        <div class="ui three stackable cards">
            <?php foreach ($activas as $t): ?>
                <div class="ui card">
                    <div class="content">
                        <div class="header"><?= htmlspecialchars($t->titulo) ?></div>
                        <div class="meta">
                            Estado: <?= htmlspecialchars($t->estado->nombre) ?>
                        </div>
                        <div class="description">
                            <?= nl2br(htmlspecialchars($t->descripcion)) ?>
                        </div>
                    </div>

                    <div class="extra content">
                        <div class="ui list">
                            <div class="item">
                                <strong>Creada por:</strong> <?= htmlspecialchars($proyecto->creador->nombre) ?>
                            </div>
                            <div class="item">
                                <strong>Asignada a:</strong> <?= htmlspecialchars($t->asignado->nombre ?? 'Sin asignar') ?>

                            </div>
                        </div>
                    </div>

                    <div class="extra content">
                        <a href="<?= BASE_URL ?>tarea/ver/<?= $t->tarea_id ?>" class="ui blue button small">Ver</a>

                        <?php if ($esCreador): ?>
                            <button class="ui button small" onclick="editarTarea(<?= $t->tarea_id ?>, '<?= htmlspecialchars($t->titulo) ?>', '<?= htmlspecialchars($t->descripcion) ?>', <?= $t->usuario_id ?>)">
                                Editar
                            </button>

                            <a href="<?= BASE_URL ?>proyecto/borrarTarea/<?= $t->tarea_id ?>"
                                class="ui red button small"
                                onclick="return confirm('¿Seguro que deseas borrar esta tarea?')">
                                Borrar
                            </a>
                        <?php endif; ?>

                        <button class="ui teal button small" onclick="cambiarEstado(<?= $t->tarea_id ?>)">
                            Cambiar estado
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- TAREAS FINALIZADAS -->
    <h3 class="ui header">Tareas finalizadas</h3>

    <?php if ($finalizadas->isEmpty()): ?>
        <div class="ui message">No hay tareas finalizadas.</div>
    <?php else: ?>
        <div class="ui three stackable cards">
            <?php foreach ($finalizadas as $t): ?>
                <div class="ui card">
                    <div class="content">
                        <div class="header"><?= htmlspecialchars($t->titulo) ?></div>
                        <div class="meta">Finalizada</div>
                        <div class="description">
                            <?= nl2br(htmlspecialchars($t->descripcion)) ?>
                        </div>
                    </div>

                    <div class="extra content">
                        <a href="<?= BASE_URL ?>tarea/ver/<?= $t->tarea_id ?>" class="ui blue button small">Ver</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<!-- ============================================================
     ====================== MODALES ==============================
     ============================================================ -->

<!-- MODAL NUEVA TAREA -->
<div class="ui modal" id="modalNuevaTarea">
    <div class="header">Nueva tarea</div>
    <div class="content">
        <form class="ui form" action="<?= BASE_URL ?>proyecto/guardarTarea" method="POST">
            <input type="hidden" name="proyecto_id" value="<?= $proyecto->proyecto_id ?>">

            <div class="field">
                <label>Título</label>
                <input type="text" name="titulo" required>
            </div>

            <div class="field">
                <label>Descripción</label>
                <textarea name="descripcion"></textarea>
            </div>

            <div class="field">
                <label>Asignar a</label>
                <select name="usuario_id" class="ui dropdown">
                    <?php foreach ($usuarios as $u): ?>
                        <option value="<?= $u->usuario_id ?>"><?= htmlspecialchars($u->nombre) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="ui green button">Crear tarea</button>
        </form>
    </div>
</div>

<!-- MODAL EDITAR TAREA -->
<div class="ui modal" id="modalEditarTarea">
    <div class="header">Editar tarea</div>
    <div class="content">
        <form class="ui form" id="formEditarTarea" method="POST">
            <div class="field">
                <label>Título</label>
                <input type="text" name="titulo" id="editTitulo">
            </div>

            <div class="field">
                <label>Descripción</label>
                <textarea name="descripcion" id="editDescripcion"></textarea>
            </div>

            <div class="field">
                <label>Asignar a</label>
                <select name="usuario_id" id="editUsuario" class="ui dropdown">
                    <?php foreach ($usuarios as $u): ?>
                        <option value="<?= $u->usuario_id ?>"><?= htmlspecialchars($u->nombre) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="ui green button">Guardar cambios</button>
        </form>
    </div>
</div>

<!-- MODAL CAMBIAR ESTADO -->
<div class="ui modal" id="modalEstado">
    <div class="header">Cambiar estado</div>
    <div class="content">
        <form class="ui form" id="formEstado" method="POST">
            <div class="field">
                <label>Estado</label>
                <select name="estado_id" class="ui dropdown">
                    <option value="1">Pendiente</option>
                    <option value="2">En progreso</option>
                    <option value="3">Finalizado</option>
                </select>
            </div>

            <button class="ui green button">Actualizar</button>
        </form>
    </div>
</div>

<script>
    function editarTarea(id, titulo, descripcion, usuarioId) {
        $('#editTitulo').val(titulo);
        $('#editDescripcion').val(descripcion);
        $('#editUsuario').val(usuarioId);

        $('#formEditarTarea').attr('action', '<?= BASE_URL ?>proyecto/actualizarTarea/' + id);

        $('#modalEditarTarea').modal('show');
    }

    function cambiarEstado(id) {
        $('#formEstado').attr('action', '<?= BASE_URL ?>proyecto/cambiarEstadoTarea/' + id);
        $('#modalEstado').modal('show');
    }
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>