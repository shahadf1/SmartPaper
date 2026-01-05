<?php
// =============================
// SmartPaper Database Connection
// =============================

// MySQL connection info (XAMPP default)
$host = "localhost";
$dbname = "smartpaper";
$username = "root";
$password = "";

// -----------------------------
// MySQLi Connection (for PHP backend)
// -----------------------------
$conn = new mysqli($host, $username, $password, $dbname);

// Check MySQLi connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -----------------------------
// PDO Connection (optional for advanced usage)
// -----------------------------
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

?>
