<?php
$servername = "localhost";
$username = "root";
$password = "Gayu251005777";
$database = "payroll";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
