<?php
	session_start();
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
		header('location:login.php');
	}
	
    $uuidporto = $_GET['md'];

	$sql6 = "SELECT thumbnail_filename
	from d_portofolio where uuidporto = '$uuidporto'";
    $hasil6 = $db->query($sql6);
	$baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);
    $thumbnail_filename = $baris6['thumbnail_filename'];
	// $thumbnail_filename2 = $baris6['thumbnail_filename2'];
	// $thumbnail_filename3 = $baris6['thumbnail_filename3'];
	// $thumbnail_filename4 = $baris6['thumbnail_filename4'];
	// $thumbnail_filename5 = $baris6['thumbnail_filename5'];

	unlink('uploads/thumbnail/'. $thumbnail_filename);
	// unlink('uploads/thumbnail/'. $thumbnail_filename2);
	// unlink('uploads/thumbnail/'. $thumbnail_filename3);
	// unlink('uploads/thumbnail/'. $thumbnail_filename4);
	// unlink('uploads/thumbnail/'. $thumbnail_filename5);


	// $sql3 = "DELETE FROM f_klik_pengunjung_log where uuidruangankosan = :uuidruangankosan";
    // $stmt3 = $db->prepare($sql3);
    // $stmt3->execute(['uuidruangankosan' => $uuidruangankosan]);

	// $sql7 = "DELETE FROM f_favourite_pencari_kos where uuidruangankosan = :uuidruangankosan";
    // $stmt7 = $db->prepare($sql7);
    // $stmt7->execute(['uuidruangankosan' => $uuidruangankosan]);

	$sql4 = "DELETE FROM f_klik_pengunjung_log where uuidporto = :uuidporto";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['uuidporto' => $uuidporto]);

	$sql4 = "DELETE FROM f_favourite_pencari_porto where uuidporto = :uuidporto";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['uuidporto' => $uuidporto]);

	$sql4 = "DELETE FROM log_favourite_pencari_porto where uuidporto = :uuidporto";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['uuidporto' => $uuidporto]);

	$sql4 = "DELETE FROM f_undangan_kerjasama where uuidporto = :uuidporto";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['uuidporto' => $uuidporto]);

	$sql4 = "DELETE FROM d_portofolio where uuidporto = :uuidporto";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['uuidporto' => $uuidporto]);

    header('location:modul_saya.php');
?>
