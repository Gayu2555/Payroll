<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_divisi = $_POST['nama_divisi'];

    $query = "INSERT INTO divisi (nama_divisi) VALUES (?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama_divisi);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Divisi berhasil ditambahkan"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Gagal menambahkan divisi"]);
    }

    $stmt->close();
    $conn->close();
}
