<?php

header('Content-Type: application/json');
//get_absen.php
// Fungsi untuk mengirim response JSON yang aman
function sendJsonResponse($success, $message = '', $data = null)
{
    $response = [
        'success' => $success,
        'message' => $message
    ];

    if ($data !== null) {
        $response['data'] = $data;
    }

    echo json_encode($response);
    exit;
}

// Tangkap semua error
ini_set('display_errors', 0);
error_reporting(E_ALL);

try {
    // Sertakan koneksi database dengan penanganan error
    require_once 'config.php';

    // Periksa koneksi database
    if ($conn->connect_error) {
        sendJsonResponse(false, 'Kesalahan koneksi database: ' . $conn->connect_error);
    }

    $query = "SELECT 
        a.tanggal_absen, 
        a.status_kehadiran, 
        a.jam_masuk, 
        a.jam_keluar,
        k.nama_karyawan
    FROM absensi a
    JOIN karyawan k ON a.id_karyawan = k.id_karyawan
    ORDER BY a.tanggal_absen DESC
    LIMIT 50"; // Membatasi 50 rekaman terakhir untuk kinerja

    // Eksekusi query
    $result = $conn->query($query);

    if (!$result) {
        sendJsonResponse(false, 'Gagal mengambil riwayat absensi: ' . $conn->error);
    }

    // Kumpulkan data
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Kirim response JSON dengan data
    sendJsonResponse(true, 'Berhasil', $data);

    // Tutup koneksi
    $conn->close();
} catch (Exception $e) {
    // Tangkap exception yang tidak terduga
    sendJsonResponse(false, 'Terjadi kesalahan: ' . $e->getMessage());
}
