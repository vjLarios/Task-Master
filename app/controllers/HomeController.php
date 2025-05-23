<?php
// app/controllers/HomeController.php

class HomeController
{
    public function index()
    {
        // Carga la vista de inicio
        require __DIR__ . '/../resources/views/home.view.php';
    }
}
