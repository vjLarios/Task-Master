<?php
class HomeController
{
    public function index()
    {
        // Recoge filtros de GET
        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? '';
        $sort = $_GET['sort'] ?? '';
        $tasks = Task::filterAndSort($search, $status, $sort);
        require __DIR__ . '/../resources/views/home.view.php';
    }
}
