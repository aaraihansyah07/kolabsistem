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
		$st_penjual = $_SESSION['st_penjual'];
	}
	include('koneksi.php');

    if (isset($_POST['update'])) {
        $id_jenis_kerjasama = $_POST['id_jenis_kerjasama'];
        $keterangan   = $_POST['keterangan'];
        $uuidporto = $_POST['uuidporto'];
        $id_undangan = $_POST['id_undangan'];
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");

        // $sqlb = "SELECT count(1) cek_dobel from f_undangan_kerjasama 
        // where uuiduserpengundang = '$uuiduserpengundang' AND uuiduserdiundang = '$uuiduserdiundang' AND st_konfirmasi is null";
        // $hasilb = $db->query($sqlb);
        // $barisb = $hasilb->fetch(PDO::FETCH_ASSOC);

        $sql5 = "UPDATE f_undangan_kerjasama set 
        id_jenis_kerjasama = $id_jenis_kerjasama,
        keterangan = '$keterangan',
        updatedate = '$now',
        updateuser = '$uuiduser'    
        where id_undangan = :id_undangan";
        $stmt5 = $db->prepare($sql5);
        $stmt5->execute(['id_undangan' => $id_undangan]);

        echo "<script>alert('Undangan kolaborasi berhasil diperbarui!!'); window.location.href='modul_view.php?md=".$uuidporto."&fk=&uv=';</script>";
        
    }
?>
