<?php
$servername = "localhost";
$username = "axelanto_pemex_user";
$password = "PemexUser2025";
$database = "axelanto_pemex_bd";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
