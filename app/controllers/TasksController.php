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
}
