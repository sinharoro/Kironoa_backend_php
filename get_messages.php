<?php
require_once 'db_connect.php';

try {
    $stmt = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC');
    $messages = $stmt->fetchAll();
    echo json_encode($messages);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch messages: ' . $e->getMessage()]);
}
