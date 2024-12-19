<?php
include 'config.php';

header('Content-Type: application/json');

if ($conn->connect_error) {
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}

// Ganti 'id_karyawan', 'nama_karyawan', 'nomor_telepon', dan 'alamat' sesuai dengan nama kolom sebenarnya di database
$query = "SELECT id_karyawan AS id, nama_karyawan AS nama, nomor_telepon, alamat, email FROM karyawan";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(["error" => $conn->error]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}



echo json_encode($data);
$conn->close();
