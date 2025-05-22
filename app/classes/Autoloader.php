<?php
// app/classes/Autoloader.php

class Autoloader
{
    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    private function loadClass($class)
    {
        // Convertir namespace a ruta: App\Controllers\Home => app/controllers/Home.php
        $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($path)) {
            require $path;
        }
    }
}
