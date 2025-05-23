<?php
// app/classes/DB.php

class DB
{
    /** @var \PDO|null */
    private static $pdo = null;

    /**
     * Devuelve una instancia PDO conectada a MySQL.
     *
     * @return \PDO
     */
    public static function connect(): \PDO
    {
        if (self::$pdo === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                DB_HOST,
                DB_NAME
            );
            self::$pdo = new PDO($dsn, DB_USER, DB_PASS);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
