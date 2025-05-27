<?php
// app/controllers/TasksController.php

class TasksController
{
    /**
     * Muestra el listado de todas las tareas
     */
    public function index()
    {
        // 1. Obtiene todas las tareas desde el modelo
        $tasks = Task::all();

        // 2. Carga la vista de listado
        require __DIR__ . '/../resources/views/tasks/index.view.php';
    }

    /**
     * Muestra el formulario para crear una nueva tarea
     */
    public function create()
    {
        require __DIR__ . '/../resources/views/tasks/create.view.php';
    }

    /**
     * Procesa el formulario y almacena la nueva tarea
     */
    public function store()
    {
        // 1. Recoge datos del POST
        $data = [
            'title'       => $_POST['title']       ?? '',
            'description' => $_POST['description'] ?? '',
            'due_date'    => $_POST['due_date']    ?? '',
            'status'      => $_POST['status']      ?? 'pendiente',
        ];

        // 2. Validación mínima
        if (empty($data['title'])) {
            die('El título es obligatorio.');
        }

        // 3. Inserta la nueva tarea
        $newId = Task::insert($data);

        // 4. Redirige al listado de tareas
        header('Location: ' . BASE_URL . '/tasks');
        exit;
    }
        /**
     * Muestra el formulario para editar una tarea existente
     *
     * @param array $params  Parámetros de ruta (incluye 'id')
     */
    public function edit(array $params)
    {
        // 1. Recupera el ID de la ruta
        $id = (int) $params['id'];

        // 2. Busca la tarea en el modelo
        $task = Task::find($id);
        if (!$task) {
            die('Tarea no encontrada.');
        }

        // 3. Carga la vista de edición
        require __DIR__ . '/../resources/views/tasks/edit.view.php';
    }

    /**
     * Procesa el formulario de edición y actualiza la tarea
     *
     * @param array $params
     */
    public function update(array $params)
    {
        // 1. ID de la tarea
        $id = (int) $params['id'];

        // 2. Recoge datos del POST
        $data = [
            'title'       => $_POST['title']       ?? '',
            'description' => $_POST['description'] ?? '',
            'due_date'    => $_POST['due_date']    ?? '',
            'status'      => $_POST['status']      ?? 'pendiente',
        ];

        // 3. Validación mínima
        if (empty($data['title'])) {
            die('El título es obligatorio.');
        }

        // 4. Actualiza en BD
        Task::update($id, $data);

        // 5. Redirige al listado
        header('Location: ' . BASE_URL . '/tasks');
        exit;
    }

        /**
     * Muestra los detalles de una tarea
     *
     * @param array $params ['id' => ...]
     */
    public function show(array $params)
    {
        $id = (int)$params['id'];
        $task = Task::find($id);
        if (!$task) {
            die('Tarea no encontrada.');
        }
        require __DIR__ . '/../resources/views/tasks/show.view.php';
    }

    /**
     * Elimina la tarea especificada
     *
     * @param array $params ['id' => ...]
     */
    public function destroy(array $params)
    {
        $id = (int)$params['id'];
        Task::delete($id);
        // Tras eliminar, redirige al listado
        header('Location: ' . BASE_URL . '/tasks');
        exit;
    }


}
