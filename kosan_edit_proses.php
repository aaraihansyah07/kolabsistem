<?php
session_start();
ini_set('max_execution_time', 120);
ini_set('memory_limit', '256M');
date_default_timezone_set("Asia/Jakarta");

if (!isset($_SESSION['uname'])) {
    header('location:login.php');
    exit;
}

$user = $_SESSION['uname'];
$nama_lengkap = $_SESSION['nama_lengkap'];
$uuiduser = $_SESSION['uuiduser'];
$no_hp = $_SESSION['no_hp'];
$alamat_kosan_lengkap = $_SESSION['alamat_kosan_lengkap'];
$email = $_SESSION['email'];
$role_id = $_SESSION['role_id'];

include('koneksi.php');
if ($role_id != 1) {
    header('location:index_pencari_kos.php');
    exit;
}

if (isset($_POST['edit'])) {
    $uuidusers = $_POST['uuiduser'];
    $nama_lengkaps = $_POST['nama_lengkap'];
    $nama_kosan = $_POST['nama_kosan'];
    $alamat_kosan_lengkap = $_POST['alamat_kosan_lengkap'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $deskripsi = $_POST['deskripsi'];
    $tipe_kosan = $_POST['tipe_kosan'];
    $now = date("Y-m-d H:i:s");

    // Update data kosan (tanpa menyentuh jarak_* dulu)
    $sql4 = "UPDATE d_kosan SET 
        nama_kosan = :nama_kosan,
        deskripsi = :deskripsi,
        alamat_kosan_lengkap = :alamat_kosan_lengkap,
        tipe_kosan = :tipe_kosan,
        userupdate = :userupdate,
        updatedate = :updatedate
        WHERE uuiduser = :uuidusers";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute([
        'nama_kosan' => $nama_kosan,
        'deskripsi' => $deskripsi,
        'alamat_kosan_lengkap' => $alamat_kosan_lengkap,
        'tipe_kosan' => $tipe_kosan,
        'userupdate' => $uuiduser,
        'updatedate' => $now,
        'uuidusers' => $uuidusers
    ]);

    // Update data user
    $sql5 = "UPDATE users SET 
        email = :email,
        no_hp = :no_hp,
        nama_lengkap = :nama_lengkap,
        alamat_kosan_lengkap = :alamat_kosan_lengkap,
        tipe_kosan = :tipe_kosan,
        userupdate = :userupdate,
        updatedate = :updatedate
        WHERE uuiduser = :uuidusers";
    $stmt5 = $db->prepare($sql5);
    $stmt5->execute([
        'email' => $email,
        'no_hp' => $no_hp,
        'nama_lengkap' => $nama_lengkaps,
        'alamat_kosan_lengkap' => $alamat_kosan_lengkap,
        'tipe_kosan' => $tipe_kosan,
        'userupdate' => $uuiduser,
        'updatedate' => $now,
        'uuidusers' => $uuidusers
    ]);

    // Tangkap data jarak dari JavaScript jika ada
    if (isset($_POST['jarak_data'])) {
        $jarakData = json_decode($_POST['jarak_data'], true);

        if (is_array($jarakData)) {
            $setClause = [];
            $params = ['uuidusers' => $uuidusers];

            foreach ($jarakData as $column => $value) {
                $setClause[] = "$column = :$column";
                $params[$column] = $value;
            }

            if (!empty($setClause)) {
                $sqlUpdate = "UPDATE d_kosan SET " . implode(', ', $setClause) . " WHERE uuiduser = :uuidusers";
                $stmtUpdate = $db->prepare($sqlUpdate);
                $stmtUpdate->execute($params);
            }
        }
    }

    header('location:kosan_saya.php?us='.$uuidusers. '&st=Y');
    exit;
}
?>
