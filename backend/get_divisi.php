<?php
header('Content-Type: application/json');
include 'config.php';

$action = $_GET['action'] ?? null;

if ($action === 'get') {
    $query = "
        SELECT 
            divisi.id_divisi,
            divisi.nama_divisi,
            gaji_pokok.gaji_pokok
        FROM 
            divisi
        LEFT JOIN 
            gaji_pokok 
        ON 
            divisi.id_divisi = gaji_pokok.id_divisi";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(['data' => $data]);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
    exit;
}
