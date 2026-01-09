<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php
/** @var \App\Models\Tarea $tarea */
$usuarioId   = $_SESSION['user_id'];
$proyecto    = $tarea->proyecto;
$creadorProj = $proyecto->creador ?? $proyecto->usuario; // por seguridad
$asignado    = $tarea->usuario;
?>

<div class="ui segment">

    <!-- ENCABEZADO -->
    <div class="ui breadcrumb">
        <a class="section" href="<?= BASE_URL ?>proyecto">Proyectos</a>
        <div class="divider"> / </div>
        <a class="section" href="<?= BASE_URL ?>proyecto/ver/<?= $proyecto->proyecto_id ?>">
            <?= htmlspecialchars($proyecto->titulo) ?>
        </a>
        <div class="divider"> / </div>
        <div class="active section">
            Tarea: <?= htmlspecialchars($tarea->titulo) ?>
        </div>
    </div>

    <h1 class="ui header" style="margin-top:1rem;">
        <?= htmlspecialchars($tarea->titulo) ?>
        <div class="sub header">
            Proyecto: <?= htmlspecialchars($proyecto->titulo) ?>
        </div>
    </h1>

    <!-- INFO PRINCIPAL -->
    <div class="ui grid stackable">
        <div class="eight wide column">
            <div class="ui list">
                <div class="item">
                    <strong>Creada por:</strong>
                    <?= htmlspecialchars($creadorProj->nombre ?? 'Desconocido') ?>
                </div>
                <div class="item">
                    <strong>Asignada a:</strong>
                    <?= htmlspecialchars($asignado->nombre ?? 'Sin asignar') ?>
                </div>
                <div class="item">
                    <strong>Estado:</strong>
                    <?= htmlspecialchars($tarea->estado->nombre ?? 'Sin estado') ?>
                </div>
            </div>
        </div>

        <div class="eight wide column" style="text-align:right;">
            <a href="<?= BASE_URL ?>proyecto/ver/<?= $proyecto->proyecto_id ?>" class="ui button">
                Volver al proyecto
            </a>
        </div>
    </div>

    <!-- DESCRIPCIÓN -->
    <?php if (!empty($tarea->descripcion)): ?>
        <div class="ui segment">
            <h4 class="ui header">Descripción</h4>
            <p><?= nl2br(htmlspecialchars($tarea->descripcion)) ?></p>
        </div>
    <?php endif; ?>

    <!-- COMENTARIO -->
    <div class="ui segment">
        <h4 class="ui header">Comentario</h4>

        <?php if ($tarea->comentario): ?>
            <p><?= nl2br(htmlspecialchars($tarea->comentario)) ?></p>
        <?php else: ?>
            <p class="ui small text">Sin comentario.</p>
        <?php endif; ?>

        <?php if ($esAsignado): ?>
            <div class="ui divider"></div>

            <form action="<?= BASE_URL ?>tarea/comentar/<?= $tarea->tarea_id ?>" method="POST" class="ui form">
                <div class="field">
                    <label>Actualizar comentario</label>
                    <textarea name="comentario" rows="3"><?= htmlspecialchars($tarea->comentario) ?></textarea>
                </div>
                <button class="ui primary button">Guardar comentario</button>
            </form>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>