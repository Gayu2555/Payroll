<?php
include 'config.php';

header('Content-Type: application/json');
file_put_contents('debug_post.log', "ID Divisi: " . ($_POST['id_divisi'] ?? 'NULL') . "\n", FILE_APPEND);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Hanya metode POST yang diperbolehkan.');
    }

    // Debug POST data
    file_put_contents('debug_post.log', print_r($_POST, true));

    // Ambil data dari POST
    $nama_karyawan = htmlspecialchars(trim($_POST['nama_karyawan'] ?? ''));
    $id_divisi = isset($_POST['id_divisi']) ? (int)$_POST['id_divisi'] : null;
    $tanggal_masuk = htmlspecialchars(trim($_POST['tanggal_masuk'] ?? ''));
    $alamat = htmlspecialchars(trim($_POST['alamat'] ?? ''));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $no_hp = htmlspecialchars(trim($_POST['no_hp'] ?? ''));

    // Validasi input
    $errors = [];
    if (empty($nama_karyawan) || strlen($nama_karyawan) < 2) $errors[] = 'Nama karyawan tidak valid';
    if (!$id_divisi) $errors[] = 'Divisi tidak valid';
    if (empty($tanggal_masuk)) $errors[] = 'Tanggal masuk tidak valid';
    if (empty($alamat)) $errors[] = 'Alamat tidak valid';
    if (!$email) $errors[] = 'Email tidak valid';
    if (!preg_match('/^[0-9]{10,13}$/', $no_hp)) $errors[] = 'Nomor telepon tidak valid';

    // Validasi manual divisi
    $valid_divisi = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    if (!in_array((int)$id_divisi, $valid_divisi, true)) {
        throw new Exception("Divisi tidak valid: $id_divisi");
    }

    // Jika ada error, kirim response error
    if (!empty($errors)) {
        throw new Exception(implode(', ', $errors));
    }

    // Simpan data karyawan
    $stmt = $conn->prepare("INSERT INTO karyawan (nama_karyawan, id_divisi, tanggal_masuk, alamat, email, nomor_telepon) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sissss', $nama_karyawan, $id_divisi, $tanggal_masuk, $alamat, $email, $no_hp);

    if (!$stmt->execute()) {
        file_put_contents('db_error.log', $stmt->error);
        throw new Exception('Gagal menyimpan data. Kesalahan database.');
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Data karyawan berhasil disimpan'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
