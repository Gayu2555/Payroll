<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_karyawan = $_POST['id_karyawan'];
    $status_kehadiran = $_POST['status_kehadiran'];
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO absensi (id_karyawan, status_kehadiran, tanggal) 
              VALUES (?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $id_karyawan, $status_kehadiran, $tanggal);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Absensi berhasil dicatat"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Gagal mencatat absensi"]);
    }

    $stmt->close();
    $conn->close();
}
