<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_karyawan = $_POST['id_karyawan'];
    $tanggal_lembur = $_POST['tanggal_lembur'];
    $durasi_jam = $_POST['durasi_jam'];
    $tarif_per_jam = $_POST['tarif_per_jam'];

    if (empty($id_karyawan) || empty($tanggal_lembur) || empty($durasi_jam) || empty($tarif_per_jam)) {
        die("Semua data harus diisi.");
    }

    $stmt = $conn->prepare("INSERT INTO lembur (id_karyawan, tanggal_lembur, durasi_jam, tarif_per_jam) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isid', $id_karyawan, $tanggal_lembur, $durasi_jam, $tarif_per_jam);

    if ($stmt->execute()) {
        echo "Data lembur berhasil disimpan.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
