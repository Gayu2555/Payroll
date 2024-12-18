<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

include 'config.php';

// Fungsi untuk menangani kesalahan koneksi database
function handleDatabaseError($conn)
{
    if ($conn->connect_error) {
        $response = [
            'status' => 'error',
            'message' => 'Koneksi database gagal: ' . $conn->connect_error
        ];
        return $response;
    }
    return null;
}

// Fungsi untuk mendapatkan daftar karyawan
function getEmployees($conn)
{
    $query = "SELECT 
                k.id_karyawan AS id, 
                k.nama_karyawan AS nama, 
                k.nomor_telepon, 
                k.alamat,
                j.nama_jabatan,
                d.nama_divisi
              FROM karyawan k
              LEFT JOIN jabatan j ON k.id_jabatan = j.id_jabatan
              LEFT JOIN divisi d ON k.id_divisi = d.id_divisi";

    $result = $conn->query($query);

    if (!$result) {
        return [
            'status' => 'error',
            'message' => 'Gagal mengambil data karyawan: ' . $conn->error
        ];
    }

    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }

    return [
        'status' => 'success',
        'data' => $employees
    ];
}

// Fungsi untuk menyimpan atau memperbarui gaji pokok
function saveEmployeeSalary($conn, $data)
{
    $required_fields = ['id_karyawan', 'id_jabatan', 'gaji_pokok', 'tunjangan', 'bonus', 'email'];
    foreach ($required_fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            return [
                'status' => 'error',
                'message' => "Field $field wajib diisi"
            ];
        }
    }

    $conn->begin_transaction();

    try {
        $check_query = "SELECT id_gaji_pokok FROM gaji_pokok WHERE id_karyawan = ?";
        $stmt_check = $conn->prepare($check_query);
        $stmt_check->bind_param('i', $data['id_karyawan']);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $update_query = "UPDATE gaji_pokok 
                             SET gaji_pokok = ?, 
                                 tunjangan = ?, 
                                 bonus = ?, 
                                 total_gaji = gaji_pokok + tunjangan + bonus,
                                 email = ?
                             WHERE id_karyawan = ?";
            $stmt_update = $conn->prepare($update_query);
            $stmt_update->bind_param(
                'dddsi',
                $data['gaji_pokok'],
                $data['tunjangan'],
                $data['bonus'],
                $data['email'],
                $data['id_karyawan']
            );
            $stmt_update->execute();
        } else {
            $insert_query = "INSERT INTO gaji_pokok 
                             (id_karyawan, id_jabatan, gaji_pokok, tunjangan, bonus, total_gaji, email) 
                             VALUES (?, ?, ?, ?, ?, gaji_pokok + tunjangan + bonus, ?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param(
                'iiddds',
                $data['id_karyawan'],
                $data['id_jabatan'],
                $data['gaji_pokok'],
                $data['tunjangan'],
                $data['bonus'],
                $data['email']
            );
            $stmt_insert->execute();
        }

        $conn->commit();
        return [
            'status' => 'success',
            'message' => 'Data gaji berhasil disimpan'
        ];
    } catch (Exception $e) {
        $conn->rollback();
        return [
            'status' => 'error',
            'message' => 'Gagal menyimpan data: ' . $e->getMessage()
        ];
    }
}

// Tangani permintaan
$method = $_SERVER['REQUEST_METHOD'];

$dbError = handleDatabaseError($conn);
if ($dbError) {
    http_response_code(500);
    echo json_encode($dbError);
    exit();
}

$response = [];
switch ($method) {
    case 'GET':
        $response = getEmployees($conn);
        break;

    case 'POST':
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            $response = [
                'status' => 'error',
                'message' => 'Data JSON tidak valid: ' . json_last_error_msg()
            ];
            break;
        }

        $response = saveEmployeeSalary($conn, $data);
        break;

    default:
        http_response_code(405);
        $response = [
            'status' => 'error',
            'message' => 'Metode tidak diizinkan'
        ];
        break;
}

echo json_encode($response);

$conn->close();
