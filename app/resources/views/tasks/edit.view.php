<!-- app/resources/views/tasks/edit.view.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea – Task Master</title>
</head>
<body>
    <h1>Editar Tarea #<?php echo htmlspecialchars($task['id']); ?></h1>
    <form action="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" method="POST">
        <label for="title">Título:</label><br>
        <input type="text" id="title" name="title"
               value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>

        <label for="description">Descripción:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea><br><br>

        <label for="due_date">Fecha de vencimiento:</label><br>
        <input type="date" id="due_date" name="due_date"
               value="<?php echo htmlspecialchars($task['due_date']); ?>"><br><br>

        <label for="status">Estado:</label><br>
        <select id="status" name="status">
            <?php
            $estados = ['pendiente','en progreso','completada'];
            foreach ($estados as $estado): ?>
            <option value="<?php echo $estado; ?>"
                <?php echo $task['status'] === $estado ? 'selected' : ''; ?>>
                <?php echo ucfirst($estado); ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Actualizar tarea</button>
    </form>

    <p><a href="<?php echo BASE_URL; ?>/tasks">← Volver al listado</a></p>
</body>
</html>
