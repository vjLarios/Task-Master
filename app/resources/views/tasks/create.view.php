<!-- app/resources/views/tasks/create.view.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tarea – Task Master</title>
</head>
<body>
    <h1>Crear Nueva Tarea</h1>
    <form action="<?php echo BASE_URL; ?>/tasks" method="POST">
        <label for="title">Título:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Descripción:</label><br>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="due_date">Fecha de vencimiento:</label><br>
        <input type="date" id="due_date" name="due_date"><br><br>

        <label for="status">Estado:</label><br>
        <select id="status" name="status">
            <option value="pendiente">Pendiente</option>
            <option value="en progreso">En progreso</option>
            <option value="completada">Completada</option>
        </select><br><br>

        <button type="submit">Guardar tarea</button>
    </form>

    <p><a href="<?php echo BASE_URL; ?>/tasks">← Volver al listado</a></p>
</body>
</html>
