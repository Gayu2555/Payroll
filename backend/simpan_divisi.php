<?php
header('Content-Type: application/json');
include 'config.php';

function getData($conn)
{
    $sql = "SELECT d.id_divisi, d.nama_divisi, g.gaji_pokok
            FROM divisi d
            LEFT JOIN gaji_pokok g ON d.id_divisi = g.id_divisi
            ORDER BY d.id_divisi";

    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'get':
        echo json_encode(['data' => getData($conn)]);
        break;

    case 'add':
        $conn->begin_transaction();
        try {
            if (empty($_POST['nama_divisi']) || empty($_POST['gaji_pokok'])) {
                throw new Exception("Nama divisi dan gaji pokok harus diisi");
            }

            // Insert ke tabel divisi
            $stmt = $conn->prepare("INSERT INTO divisi (nama_divisi) VALUES (?)");
            if (!$stmt) {
                throw new Exception("Error preparing divisi statement: " . $conn->error);
            }
            $stmt->bind_param("s", $_POST['nama_divisi']);
            if (!$stmt->execute()) {
                throw new Exception("Error executing divisi statement: " . $stmt->error);
            }
            $divisi_id = $conn->insert_id;

            // Insert ke tabel gaji_pokok
            $stmt = $conn->prepare("INSERT INTO gaji_pokok (id_divisi, gaji_pokok) VALUES (?, ?)");
            if (!$stmt) {
                throw new Exception("Error preparing gaji statement: " . $conn->error);
            }
            $stmt->bind_param("id", $divisi_id, $_POST['gaji_pokok']);
            if (!$stmt->execute()) {
                throw new Exception("Error executing gaji statement: " . $stmt->error);
            }

            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Data divisi berhasil ditambahkan']);
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'update':
        $conn->begin_transaction();
        try {
            if (empty($_POST['nama_divisi']) || empty($_POST['gaji_pokok']) || empty($_POST['id_divisi'])) {
                throw new Exception("Semua field harus diisi");
            }

            // Update tabel divisi
            $stmt = $conn->prepare("UPDATE divisi SET nama_divisi = ? WHERE id_divisi = ?");
            if (!$stmt) {
                throw new Exception("Error preparing divisi update: " . $conn->error);
            }
            $stmt->bind_param("si", $_POST['nama_divisi'], $_POST['id_divisi']);
            if (!$stmt->execute()) {
                throw new Exception("Error executing divisi update: " . $stmt->error);
            }

            // Check if gaji_pokok record exists
            $check = $conn->prepare("SELECT COUNT(*) as count FROM gaji_pokok WHERE id_divisi = ?");
            $check->bind_param("i", $_POST['id_divisi']);
            $check->execute();
            $result = $check->get_result();
            $exists = $result->fetch_assoc()['count'] > 0;

            if ($exists) {
                // Update existing record
                $stmt = $conn->prepare("UPDATE gaji_pokok SET gaji_pokok = ? WHERE id_divisi = ?");
                $stmt->bind_param("di", $_POST['gaji_pokok'], $_POST['id_divisi']);
            } else {
                // Insert new record
                $stmt = $conn->prepare("INSERT INTO gaji_pokok (id_divisi, gaji_pokok) VALUES (?, ?)");
                $stmt->bind_param("id", $_POST['id_divisi'], $_POST['gaji_pokok']);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error updating gaji: " . $stmt->error);
            }

            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Data divisi berhasil diperbarui']);
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'delete':
        $conn->begin_transaction();
        try {
            if (empty($_POST['id_divisi'])) {
                throw new Exception("ID divisi tidak valid");
            }

            // Hapus dari gaji_pokok
            $stmt = $conn->prepare("DELETE FROM gaji_pokok WHERE id_divisi = ?");
            if (!$stmt) {
                throw new Exception("Error preparing delete gaji: " . $conn->error);
            }
            $stmt->bind_param("i", $_POST['id_divisi']);
            if (!$stmt->execute()) {
                throw new Exception("Error executing delete gaji: " . $stmt->error);
            }

            // Hapus dari divisi
            $stmt = $conn->prepare("DELETE FROM divisi WHERE id_divisi = ?");
            if (!$stmt) {
                throw new Exception("Error preparing delete divisi: " . $conn->error);
            }
            $stmt->bind_param("i", $_POST['id_divisi']);
            if (!$stmt->execute()) {
                throw new Exception("Error executing delete divisi: " . $stmt->error);
            }

            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Data divisi berhasil dihapus']);
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}

$conn->close();
