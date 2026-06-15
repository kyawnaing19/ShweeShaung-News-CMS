<?php
// Database connection variables
$host = 'localhost';
$dbName = 'shopping';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

    // Fetch the maximum ID from the records table
    $stmt = $pdo->query('SELECT MAX(id) AS maxId FROM category');
    $maxId = $stmt->fetch(PDO::FETCH_ASSOC)['maxId'];

    echo json_encode(['maxId' => $maxId]);
} catch (PDOException $e) {
    die("Could not connect to the database $dbName :" . $e->getMessage());
}
?>