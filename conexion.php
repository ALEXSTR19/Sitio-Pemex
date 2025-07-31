<?php
$servername = "localhost";
$username = "axelanto_pemex_user";
$password = "PemexUser2025";
$database = "axelanto_pemex_bd";

// Create connection
mysqli_report(MYSQLI_REPORT_OFF);
try {
    $conn = @new mysqli($servername, $username, $password, $database);
} catch (mysqli_sql_exception $e) {
    error_log('Connection failed: ' . $e->getMessage());
    $conn = null;
    return;
}

// Check connection
if ($conn->connect_error) {
    error_log('Connection failed: ' . $conn->connect_error);
    $conn = null;
    return;
}

$conn->set_charset("utf8mb4");
?>
