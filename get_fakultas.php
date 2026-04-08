<?php
// get_subkelas.php
require 'koneksi.php'; // pastikan koneksi DB sudah dibuat

header('Content-Type: application/json');

if (isset($_GET['kode_univ'])) {
    $kode_univ = $_GET['kode_univ'];

    $stmt = $db->prepare("SELECT kode_fakultas, nama_fakultas FROM d_fakultas WHERE kode_univ = ? ORDER BY nama_fakultas");
    $stmt->execute([$kode_univ]);

    $fakultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fakultas);
} else {
    echo json_encode([]);
}
