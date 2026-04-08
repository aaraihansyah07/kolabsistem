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

    if (isset($_POST['konfirmasi'])) {
        $uuiduserpengundang = $_POST['uuiduserpengundang'];
        $st_konfirmasi = $_POST['st_konfirmasi'];
        $kontak_yg_diberikan   = $_POST['kontak_yg_diberikan'];
        $id_undangan = $_POST['id_undangan'];
        $uuidporto = $_POST['uuidporto'];
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");

        if ($st_konfirmasi == 'N') {
            $kontak_yg_diberikan = NULL;
        }

        // $sqlb = "SELECT count(1) cek_dobel from f_undangan_kerjasama 
        // where uuiduserpengundang = '$uuiduserpengundang' AND uuiduserdiundang = '$uuiduserdiundang' AND st_konfirmasi is null";
        // $hasilb = $db->query($sqlb);
        // $barisb = $hasilb->fetch(PDO::FETCH_ASSOC);

        $sql5 = "UPDATE f_undangan_kerjasama set 
        st_konfirmasi = '$st_konfirmasi',
        kontak_yg_diberikan = '$kontak_yg_diberikan',
        updatedate = '$now',
        updateuser = '$uuiduser'    
        where id_undangan = :id_undangan";
        $stmt5 = $db->prepare($sql5);
        $stmt5->execute(['id_undangan' => $id_undangan]);

        
        $sql2 = "INSERT INTO f_favourite_pencari_porto
                (uuiduserpemilik, usercreate, uuiduserfav, jenis_notif, id_undangan, uuidporto) 
                VALUES 
                (:uuiduserpengundang, :usercreate, :uuiduser, 'KON', :id_undangan, :uuidporto)";

        $stmt2 = $db->prepare($sql2);
        $stmt2->execute([
            ':uuiduserpengundang' => $uuiduserpengundang,
            ':usercreate'        => $uuiduserpengundang,
            ':uuiduser'        => $uuiduser,
            ':id_undangan'          => $id_undangan,
            ':uuidporto'          => $uuidporto
        ]);

        echo "<script>alert('Konfirmasi Undangan kolaborasi berhasil!!'); window.location.href='riwayat_add_fav.php';</script>";
        
    }
?>
