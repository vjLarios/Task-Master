<?php
// public/index.php

declare(strict_types=1);

// 1. Arranca la aplicación: carga config, Autoloader y Router
require __DIR__ . '/../app/app.php';

// 2. (Opcional más adelante) aquí incluirás tus rutas, 
//    por ejemplo: require __DIR__ . '/../app/routes.php';

// 3. Dispara el dispatcher para responder a la solicitud actual
$router->dispatch();
