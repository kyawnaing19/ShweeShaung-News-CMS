<?php
// Database connection variables
$host = 'localhost';
$dbName = 'shopping';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

    // Fetch all records from the table
    $stmt = $pdo->query('SELECT * FROM orders');
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($records);
} catch (PDOException $e) {
    die("Could not connect to the database $dbName :" . $e->getMessage());
}
?>