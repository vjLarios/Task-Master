<?php
// public/test_db.php

// 1. Carga tu framework
require __DIR__ . '/../app/app.php';

// 2. Intenta la conexión
try {
    $pdo = DB::connect();
    echo "<p style='color:green;'>✔ Conexión exitosa a la base de datos taskmaster.</p>";
} catch (PDOException $e) {
    echo "<p style='color:red;'>✖ Error de conexión: " . htmlspecialchars($e->getMessage()) . "</p>";
}
