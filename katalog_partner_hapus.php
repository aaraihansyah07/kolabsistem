<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		$user = "Login";
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
	
	if (isset($_POST['hapus_produk'])) {
        if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) != 'admin_shoficraft')) {
            header('location:index_pencari_kos.php');
        }

        $uuidproduk = $_POST['uuidproduk'];

        $sql6 = "SELECT berkas from produk_shoficraft_gambar where uuidproduk = '$uuidproduk'";
        $hasil6 = $db->query($sql6);
        
        while($baris6 = $hasil6->fetch(PDO::FETCH_ASSOC)) {
            unlink($baris6['berkas']);
        }

        $sql5 = "DELETE FROM produk_shoficraft_gambar where uuidproduk = :uuidproduk";
        $stmt5 = $db->prepare($sql5);
        $stmt5->execute(['uuidproduk' => $uuidproduk]);

        $sql4 = "DELETE FROM produk_shoficraft where uuidproduk = :uuidproduk";
        $stmt4 = $db->prepare($sql4);
        $stmt4->execute(['uuidproduk' => $uuidproduk]);

        header('location:katalog_partner.php');
    }
?>
