<?php
include 'config.php';

// Set header untuk memastikan output JSON
header('Content-Type: application/json');

$stats = [];

// Total Karyawan
$result = $conn->query("SELECT COUNT(*) as total FROM karyawan");
$stats['total_employees'] = $result->fetch_assoc()['total'];

// Kehadiran Hari Ini
$result = $conn->query("SELECT COUNT(*) as total FROM absensi WHERE tanggal = CURDATE() AND status_kehadiran = 'Hadir'");
$stats['today_attendance'] = $result->fetch_assoc()['total'];

// Total Divisi
$result = $conn->query("SELECT COUNT(*) as total FROM divisi");
$stats['total_divisions'] = $result->fetch_assoc()['total'];

// Kembalikan data dalam format JSON
echo json_encode($stats);

$conn->close();
