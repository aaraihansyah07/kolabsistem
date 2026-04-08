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

	$id_undangan = $_POST['id_undangan'];
    $uuidporto = $_POST['uuidporto'];

	$sql6 = "SELECT st_konfirmasi
	from f_undangan_kerjasama where id_undangan = $id_undangan";
    $hasil6 = $db->query($sql6);
	$baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);

    if ($baris6['st_konfirmasi'] == NULL) {
		$sql5 = "DELETE FROM f_favourite_pencari_porto where id_undangan = :id_undangan";
        $stmt5 = $db->prepare($sql5);
        $stmt5->execute(['id_undangan' => $id_undangan]);
		
		$sql6 = "DELETE FROM log_favourite_pencari_porto where id_undangan = :id_undangan";
        $stmt6 = $db->prepare($sql6);
        $stmt6->execute(['id_undangan' => $id_undangan]);

        $sql4 = "DELETE FROM f_undangan_kerjasama where id_undangan = :id_undangan";
        $stmt4 = $db->prepare($sql4);
        $stmt4->execute(['id_undangan' => $id_undangan]);

        echo "<script>alert('Undangan kolaborasi berhasil dihapus/dibatalkan!!'); window.location.href='modul_view.php?md=".$uuidporto."&fk=&uv=';</script>";
    }
    else {
        echo "<script>alert('Tidak dapat menghapus undangan kolaborasi ini karena sudah dikonfirmasi user tersebut'); window.location.href='modul_view.php?md=".$uuidporto."&fk=&uv=';</script>";
    }
?>