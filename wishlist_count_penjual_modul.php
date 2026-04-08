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
            FROM log_favourite_pencari_porto fk
            LEFT JOIN d_portofolio r ON r.uuidporto = fk.uuidporto
            WHERE r.uuiduser = :uuiduser AND fk.st_view IS NULL";
    
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
