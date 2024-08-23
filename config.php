<?php
// Database configuration
$host = 'localhost';
$dbname = 'examcrud'; // replace with your database name
$username = 'root'; // replace with your MySQL username
$password = '@root'; // replace with your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
