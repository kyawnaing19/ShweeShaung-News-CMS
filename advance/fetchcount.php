<?php
// Assuming the same database connection setup as before
$host = 'localhost';
$dbName = 'shopping';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

    // Fetch all records from the records table
    $stmt = $pdo->query('SELECT id, category FROM category ORDER BY id DESC');
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($records);
} catch (PDOException $e) {
    die("Could not connect to the database $dbName :" . $e->getMessage());
}
?>