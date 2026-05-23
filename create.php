<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Only POST method is allowed']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['username']) || !isset($input['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and message are required']);
    exit();
}

$username = trim($input['username']);
$message  = trim($input['message']);

if (empty($username) || empty($message)) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and message cannot be empty']);
    exit();
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO messages (username, message) VALUES (:username, :message)'
    );
    $stmt->execute([
        'username' => $username,
        'message'  => $message,
    ]);

    http_response_code(201);
    echo json_encode([
        'success' => true,
        'id'      => $pdo->lastInsertId(),
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create message: ' . $e->getMessage()]);
}
