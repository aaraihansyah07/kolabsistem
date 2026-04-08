<?php
	session_start();
    date_default_timezone_set("Asia/Jakarta");
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

    if (isset($_POST['edit_balas_ulasan'])) {
        $uuidbalasan = $_POST['uuidbalasan'];
        $uuiduserbalas = $_POST['uuiduserbalas'];
        $balasan = $_POST['balasan'];
        $fk = $_POST['fk'];
        $uuidruangankosan = $_POST['uuidruangankosan'];
        $now = new DateTime();
        $now = $now->format("Y-m-d"); 

        $sql4 = "UPDATE balasan_ulasan set balasan = '$balasan', st_edited = 'Y',  updatedate = '$now' where uuidbalasan = :uuidbalasan";
        $stmt4 = $db->prepare($sql4);
        $stmt4->execute(['uuidbalasan' => $uuidbalasan]);

        header('location:ruangan_kosan_view.php?rk='.$uuidruangankosan.'&fk='.$fk.'&hd=0&hs=1000000000&js=');
    }

?>