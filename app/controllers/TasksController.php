<?php
// app/controllers/TasksController.php

class TasksController
{
        /**
     * Muestra el listado de todas las tareas
     */
    public function index()
    {
        // 1. Obtiene todas las tareas
        $tasks = Task::all();

        // 2. Hace disponible la variable en la vista
        require __DIR__ . '/../resources/views/tasks/index.view.php';
    }

}
