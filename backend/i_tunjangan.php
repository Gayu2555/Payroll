<?php
include 'config.php';

$action = $_POST['action'] ?? '';

if ($action === 'save') {
    $nama_tunjangan = $_POST['nama_tunjangan'] ?? '';
    $jumlah_tunjangan = $_POST['jumlah_tunjangan'] ?? 0;

    if (empty($nama_tunjangan) || $jumlah_tunjangan <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Input tidak valid']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tunjangan (nama_tunjangan, jumlah_tunjangan) VALUES (?, ?)");
    $stmt->bind_param('sd', $nama_tunjangan, $jumlah_tunjangan);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Tunjangan berhasil disimpan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
    }

    $stmt->close();
}

if ($action === 'fetch') {
    $result = $conn->query("SELECT * FROM tunjangan");

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(['status' => 'success', 'data' => $data]);
}

if ($action === 'delete') {
    $id_tunjangan = $_POST['id_tunjangan'] ?? 0;

    if ($id_tunjangan <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM tunjangan WHERE id_tunjangan = ?");
    $stmt->bind_param('i', $id_tunjangan);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Tunjangan berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
    }

    $stmt->close();
}
