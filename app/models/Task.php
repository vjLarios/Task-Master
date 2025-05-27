<?php
// app/models/Task.php

class Task
{
    protected static $table = 'tasks';

    public static function all(): array
    {
        $db = DB::connect();
        $stmt = $db->query("SELECT * FROM " . self::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $db = DB::connect();
        $stmt = $db->prepare(
            "SELECT * FROM " . self::$table . " WHERE id = :id LIMIT 1"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function insert(array $data): int
    {
        $db = DB::connect();
        $stmt = $db->prepare(
            "INSERT INTO " . self::$table . " (title, description, due_date, status)
             VALUES (:title, :description, :due_date, :status)"
        );
        $stmt->execute([
            'title'       => $data['title'],
            'description' => $data['description'],
            'due_date'    => $data['due_date'],
            'status'      => $data['status'],
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $db = DB::connect();
        $stmt = $db->prepare(
            "UPDATE " . self::$table . "
             SET title = :title,
                 description = :description,
                 due_date = :due_date,
                 status = :status
             WHERE id = :id"
        );
        return $stmt->execute([
            'id'          => $id,
            'title'       => $data['title'],
            'description' => $data['description'],
            'due_date'    => $data['due_date'],
            'status'      => $data['status'],
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = DB::connect();
        $stmt = $db->prepare(
            "DELETE FROM " . self::$table . " WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
