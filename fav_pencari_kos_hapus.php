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
    if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 2)) {
		header('location:index_pencari_kos.php');
	}

    if (isset($_POST['unwish'])) {
        $uuidruangankosanfav = $_POST['unwish'];
        $sql2 = "DELETE FROM f_favourite_pencari_kos where uuidruangankosan = :uuidruangankosanfav AND uuiduserfav = :uuiduserfav";
        $stmt2 = $db->prepare($sql2);
        $stmt2->execute([
            'uuidruangankosanfav' => $uuidruangankosanfav,
            'uuiduserfav' => $uuiduser,
        ]);                  
    }
    header('location:fav_pencari_kos.php');
?>