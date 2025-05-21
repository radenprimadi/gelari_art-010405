<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "galeri_seni2";

$conn = new mysqli($host, $user, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
