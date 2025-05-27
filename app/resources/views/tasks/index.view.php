<!-- app/resources/views/tasks/index.view.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Task Master – Mis Tareas</title>
</head>
<body>
    <h1>Mis Tareas</h1>
    <p><a href="<?php echo BASE_URL; ?>/tasks/create">Crear nueva tarea</a></p>

    <?php if (empty($tasks)): ?>
        <p>No hay tareas registradas.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Vencimiento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['id']); ?></td>
                    <td><?php echo htmlspecialchars($task['title']); ?></td>
                    <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                    <td><?php echo htmlspecialchars($task['status']); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>">Ver</a> |
                        <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>/edit">Editar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
