<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['uuiduser'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

include('koneksi.php');

$uuiduser = $_SESSION['uuiduser']; // UUID pemilik kos

try {
    $sql = "SELECT COUNT(*) AS total
            FROM ulasan_user u
            LEFT JOIN d_modul r ON r.uuidmodul = u.uuidmodul
            WHERE r.uuiduser = :uuiduser AND u.st_view IS NULL";
    
    $stmt = $db->prepare($sql);
    $stmt->execute(['uuiduser' => $uuiduser]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'count' => (int)$result['total']
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
