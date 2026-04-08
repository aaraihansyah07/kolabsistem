<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		header('location:login.php');
	}
	else {
		$user = $_SESSION['uname'];
		$nama_lengkap = $_SESSION['nama_lengkap'];
		$uuiduser = $_SESSION['uuiduser'];
		$no_hp = $_SESSION['no_hp'];
		$alamat_kosan_lengkap = $_SESSION['alamat_kosan_lengkap'];
        $email = $_SESSION['email'];
		$role_id = $_SESSION['role_id'];
	}
	include('koneksi.php');

    if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
		header('location:index_pencari_kos.php');
	}

    if (isset($_POST['balas_ulasan'])) {
        $uuidulasan = $_POST['uuidulasan'];
        $uuiduserbalas = $_POST['uuiduserbalas'];
        $balasan = $_POST['balasan'];
        $fk = $_POST['fk'];
        $uuidruangankosan = $_POST['uuidruangankosan'];

        $sql2 = "INSERT INTO balasan_ulasan (uuiduserbalas, uuidulasan, balasan) VALUES (:uuiduserbalas, :uuidulasan, :balasan)";
        $stmt = $db->prepare($sql2);
        $stmt->execute(['uuiduserbalas' => $uuiduserbalas, 'uuidulasan' => $uuidulasan, 'balasan' => $balasan]);
		
		//$to_back = 'ruangan_kosan_view.php?rk='.$uuidruangankosan.'&fk='.$fk.'&hd=0&hs=0&js=';

        header('location:ruangan_kosan_view.php?rk='.$uuidruangankosan.'&fk='.$fk.'&hd=0&hs=1000000000&js=');
    }

?>