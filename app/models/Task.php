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
            // Traducción de estado a valores válidos en la BD
            'status'      => self::traducirStatus($data['status']),
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
            'status'      => self::traducirStatus($data['status']),
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

    public static function filterAndSort($search = '', $status = '', $sort = ''): array
    {
        $db = DB::connect();
        $query = "SELECT * FROM " . self::$table . " WHERE 1";
        $params = [];
        if ($search !== '') {
            $query .= " AND title LIKE :search";
            $params['search'] = "%$search%";
        }
        if ($status !== '') {
            $query .= " AND status = :status";
            $params['status'] = $status;
        }
        if ($sort === 'date_asc') {
            $query .= " ORDER BY due_date ASC";
        } elseif ($sort === 'date_desc') {
            $query .= " ORDER BY due_date DESC";
        } elseif ($sort === 'title_asc') {
            $query .= " ORDER BY title ASC";
        } elseif ($sort === 'title_desc') {
            $query .= " ORDER BY title DESC";
        }
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function traducirStatus($status)
    {
        // Traduce de español a valores válidos en la BD
        switch (strtolower($status)) {
            case 'pendiente': return 'pending';
            case 'en progreso': return 'in_progress';
            case 'completada': return 'completed';
            default: return 'pending';
        }
    }
    public static function mostrarStatus($status)
    {
        switch ($status) {
            case 'pending': return 'Pendiente';
            case 'in_progress': return 'En progreso';
            case 'completed': return 'Completada';
            default: return $status;
        }
    }
}
