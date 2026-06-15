<?php
// Database connection setup
$pdo = new PDO("mysql:host=localhost;dbname=shopping", "root", "root");

$user_id = 1; // Securely obtain this, e.g., from a logged-in session

// Fetch the last view timestamp
$stmt = $pdo->prepare("SELECT last_view FROM log WHERE user_id = ?");
$stmt->execute([$user_id]);
$lastView = $stmt->fetchColumn();

// Count new records since the last view timestamp
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE order_at > ?");
$countStmt->execute([$lastView]);
$newRecordsCount = $countStmt->fetchColumn();

echo json_encode(['newRecordsCount' => $newRecordsCount]);
?>
