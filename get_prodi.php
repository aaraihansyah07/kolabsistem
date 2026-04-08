<?php
// get_subkelas.php
require 'koneksi.php'; // pastikan koneksi DB sudah dibuat

header('Content-Type: application/json');

if (isset($_GET['kode_fakultas'])) {
    $kode_fakultas = $_GET['kode_fakultas'];

    $stmt = $db->prepare("SELECT kode_prodi, nama_prodi FROM d_prodi WHERE kode_fakultas = ? ORDER BY nama_prodi");
    $stmt->execute([$kode_fakultas]);

    $prodi = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($prodi);
} else {
    echo json_encode([]);
}
