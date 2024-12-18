<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/config.php';

header('Content-Type: application/json');

try {
    if (!$conn) {
        throw new Exception('Gagal koneksi ke database: ' . $conn->connect_error);
    }

    if (!isset($_POST['id_karyawan'], $_POST['status_kehadiran'], $_POST['jam_masuk'])) {
        throw new Exception('Data input tidak lengkap');
    }

    $id_karyawan = $_POST['id_karyawan'];
    $status_kehadiran = $_POST['status_kehadiran'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = !empty($_POST['jam_keluar']) ? $_POST['jam_keluar'] : null;

    $stmt = $conn->prepare("
        INSERT INTO absensi (id_karyawan, status_kehadiran, jam_masuk, jam_keluar, tanggal_absen)
        VALUES (?, ?, ?, ?, NOW())
    ");

    if (!$stmt) {
        throw new Exception('Query prepare gagal: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $id_karyawan, $status_kehadiran, $jam_masuk, $jam_keluar);

    if (!$stmt->execute()) {
        throw new Exception('Gagal eksekusi query: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Absensi berhasil disimpan']);
} catch (Exception $e) {
    file_put_contents('debug_log.txt', date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
