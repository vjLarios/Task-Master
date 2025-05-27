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
        $data = [
            'title'       => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'due_date'    => $_POST['due_date'] ?? '',
            'status'      => $_POST['status'] ?? 'pendiente',
        ];
        $today = date('Y-m-d');
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = 'El título es obligatorio.';
        }
        if (empty($data['due_date'])) {
            $errors[] = 'La fecha es obligatoria.';
        } elseif ($data['due_date'] < $today) {
            $errors[] = 'La fecha debe ser igual o mayor a hoy.';
        }
        if (empty($data['status'])) {
            $errors[] = 'El estado es obligatorio.';
        }
        if ($errors) {
            $_SESSION['swal'] = [
                'icon' => 'error',
                'title' => 'Error al crear tarea',
                'text' => implode("\n", $errors)
            ];
            header('Location: ' . BASE_URL . '/tasks/create');
            exit;
        }
        Task::insert($data);
        $_SESSION['swal'] = [
            'icon' => 'success',
            'title' => 'Tarea creada',
            'text' => 'La tarea fue creada correctamente.'
        ];
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
        $id = (int) $params['id'];
        $data = [
            'title'       => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'due_date'    => $_POST['due_date'] ?? '',
            'status'      => $_POST['status'] ?? 'pendiente',
        ];
        $today = date('Y-m-d');
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = 'El título es obligatorio.';
        }
        if (empty($data['due_date'])) {
            $errors[] = 'La fecha es obligatoria.';
        } elseif ($data['due_date'] < $today) {
            $errors[] = 'La fecha debe ser igual o mayor a hoy.';
        }
        if (empty($data['status'])) {
            $errors[] = 'El estado es obligatorio.';
        }
        if ($errors) {
            $_SESSION['swal'] = [
                'icon' => 'error',
                'title' => 'Error al editar tarea',
                'text' => implode("\n", $errors)
            ];
            header('Location: ' . BASE_URL . '/tasks/' . $id . '/edit');
            exit;
        }
        Task::update($id, $data);
        $_SESSION['swal'] = [
            'icon' => 'success',
            'title' => 'Tarea actualizada',
            'text' => 'La tarea fue actualizada correctamente.'
        ];
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
    if (! Task::delete($id)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al eliminar']);
        exit;
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Tarea eliminada']);
    exit;
}



}
