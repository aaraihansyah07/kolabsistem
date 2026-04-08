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
		//$st_penjual = $_SESSION['st_penjual'];
	}
	include('koneksi.php');
	
	if (!isset($_SESSION['uname'])) {
		header('location:index.php');
	}
    
    // if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
	// 	header('location:index_pencari_kos.php');
	// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function isQuillEmptyCheck($html) {
        // hapus semua tag HTML dan whitespace
        return trim(strip_tags($html)) === '';
    }

    $uuidusers = $_POST['uuiduser'];
    $no_hp = $_POST['no_hp'];
    $nama_lengkaps = $_POST['fname'];
    //$email = $_POST['email'];
    //$no_rekening = $_POST['no_rekening'];
    $gender = $_POST['gender'];
    $now = new DateTime();
    $now = $now->format("Y-m-d H:i:s");
    $nama_perusahaan = $_POST['nama_perusahaan'];
    
    if ($role_id == 3) {
        $nama_perusahaan = "nama_perusahaan = '". $nama_perusahaan. "'";
    }
    else {
        $nama_perusahaan = "nama_perusahaan = null";
    }

    $sql5 = "UPDATE user_pengguna set 
    fname = '$nama_lengkaps',
    no_hp = '$no_hp',
    gender = '$gender',
    userupdate = '$uuiduser',
    updatedate = '$now',
    $nama_perusahaan
    where uuiduser = :uuidusers";
    $stmt5 = $db->prepare($sql5);
    $stmt5->execute(['uuidusers' => $uuidusers]);

    $_SESSION['nama_lengkap'] = $nama_lengkaps;
    
        echo "<script>alert('Data berhasil diedit!!'); window.location.href='profil.php';</script>";
}
?>
