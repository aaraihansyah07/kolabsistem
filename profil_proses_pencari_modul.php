<?php
	session_start();
    date_default_timezone_set("Asia/Jakarta");
	if (!isset($_SESSION['uname'])) {
		$user = "Login";
	}
	else {
		$user = $_SESSION['uname'];
		$nama_lengkap = $_SESSION['nama_lengkap'];
		$uuiduser = $_SESSION['uuiduser'];
		//$no_hp = $_SESSION['no_hp'];
		//$alamat_kosan_lengkap = $_SESSION['alamat_kosan_lengkap'];
        //$email = $_SESSION['email'];
		$role_id = $_SESSION['role_id'];
		$st_penjual = $_SESSION['st_penjual'];
	}
	include('koneksi.php');

	if ($st_penjual == 'Y') {
		header('location:index_pencari_modul.php');
	}
    
    // if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 2)) {
	// 	header('location:index_pencari_kos.php');
	// }

if (isset($_POST['edit'])) {
    $uuidusers = $_POST['uuiduser'];
    $nama_lengkaps = $_POST['fname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $now = new DateTime();
    $now = $now->format("Y-m-d H:i:s");

    $sql5 = "UPDATE user_pengguna set 
    email = '$email',
    fname = '$nama_lengkaps',
    gender = '$gender',
    userupdate = '$uuiduser',
    updatedate = '$now'
    where uuiduser = :uuidusers";
    $stmt5 = $db->prepare($sql5);
    $stmt5->execute(['uuidusers' => $uuidusers]);

    $_SESSION['nama_lengkap'] = $nama_lengkaps;
    
    echo "<script>alert('Data berhasil diedit!!'); window.location.href='profil_pencari_modul.php';</script>";
}
?>
