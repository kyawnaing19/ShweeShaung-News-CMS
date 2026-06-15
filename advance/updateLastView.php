<?php
// Database connection setup
$pdo = new PDO("mysql:host=localhost;dbname=shopping", "root", "root");

$user_id = 1; // Securely obtain this, e.g., from a logged-in session
$current_timestamp = date('Y-m-d H:i:s');
echo $current_timestamp;
// Update or insert the last view timestamp
$stmt = $pdo->prepare("INSERT INTO log (user_id, last_view) VALUES (?, ?) ON DUPLICATE KEY UPDATE last_view = VALUES(last_view)");
$stmt->execute([$user_id, $current_timestamp]);

echo json_encode(['status' => 'success']);
?>
