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
	
    $id_promosi = $_GET['md'];

	$sql6 = "SELECT filename
	from d_promosi_mahasiswa where id_promosi = $id_promosi";
    $hasil6 = $db->query($sql6);
	$baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);
    $filename = $baris6['filename'];
	// $thumbnail_filename2 = $baris6['thumbnail_filename2'];
	// $thumbnail_filename3 = $baris6['thumbnail_filename3'];
	// $thumbnail_filename4 = $baris6['thumbnail_filename4'];
	// $thumbnail_filename5 = $baris6['thumbnail_filename5'];

	unlink('uploads/promosi/'. $filename);
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

	$sql4 = "DELETE FROM f_klik_pengunjung_promosi_log where id_promosi = :id_promosi";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['id_promosi' => $id_promosi]);

	$sql4 = "DELETE FROM d_promosi_mahasiswa where id_promosi = :id_promosi";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['id_promosi' => $id_promosi]);

    header('location:promosi_mahasiswa_upload.php');
?>
