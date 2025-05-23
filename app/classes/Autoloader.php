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
        // Base de tu aplicación
        $baseDir = __DIR__ . '/../';

        // Directorios donde buscar clases
        $dirs = [
            'classes',     // para librerías internas si las hubiera
            'controllers', // para HomeController, TasksController…
            'models',      // para Task.php…
        ];

        foreach ($dirs as $dir) {
            $file = $baseDir . $dir . '/' . $class . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
        // Si no lo encontró, puede dejarse vacío (dará  error al instanciar)
    }
}
