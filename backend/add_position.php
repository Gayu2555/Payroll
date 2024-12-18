<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_jabatan = $_POST['nama_jabatan'];

    $query = "INSERT INTO jabatan (nama_jabatan) VALUES (?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama_jabatan);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Jabatan berhasil ditambahkan"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Gagal menambahkan jabatan"]);
    }

    $stmt->close();
    $conn->close();
}
