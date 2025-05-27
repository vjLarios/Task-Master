<!-- app/resources/views/tasks/show.view.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Tarea – Task Master</title>
</head>
<body>
    <h1>Tarea #<?php echo htmlspecialchars($task['id']); ?></h1>
    <ul>
        <li><strong>Título:</strong> <?php echo htmlspecialchars($task['title']); ?></li>
        <li><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($task['description'])); ?></li>
        <li><strong>Vencimiento:</strong> <?php echo htmlspecialchars($task['due_date']); ?></li>
        <li><strong>Estado:</strong> <?php echo htmlspecialchars($task['status']); ?></li>
    </ul>

    <p>
      <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>/edit">Editar</a> |
      <a href="<?php echo BASE_URL; ?>/tasks">Volver al listado</a>
    </p>

    <!-- Botón Eliminar -->
    <form id="delete-form" action="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" method="POST">
        <button type="button" id="btn-delete">Eliminar tarea</button>
    </form>

    <script>
    document.getElementById('btn-delete').addEventListener('click', function(){
        if (!confirm('¿Seguro que quieres eliminar esta tarea?')) return;
        fetch('<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>', {
            method: 'DELETE'
        }).then(() => {
            window.location.href = '<?php echo BASE_URL; ?>/tasks';
        });
    });
    </script>
</body>
</html>
