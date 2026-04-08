<?php
// get_subkelas.php
require 'koneksi.php'; // pastikan koneksi DB sudah dibuat

header('Content-Type: application/json');

if (isset($_GET['id_jenjang'])) {
    $id_jenjang = $_GET['id_jenjang'];

    $sql = "SELECT nama_jenjang from d_jenjang_pendidikan where id_jenjang = $id_jenjang";
    $hasil = $db->query($sql);
    $baris = $hasil->fetch(PDO::FETCH_ASSOC);

    $nama_jenjang = $baris['nama_jenjang'];

    $stmt = $db->prepare("SELECT id_mapel, nama_mapel FROM d_mata_pelajaran WHERE nama_jenjang = ? ORDER BY nama_mapel");
    $stmt->execute([$nama_jenjang]);

    $mapel = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($mapel);
} else {
    echo json_encode([]);
}
