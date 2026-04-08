<?php
include('koneksi.php');
$stmt = $db->query("SELECT kode_fakultas, alamat FROM d_fakultas_upi");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($data);
?>
