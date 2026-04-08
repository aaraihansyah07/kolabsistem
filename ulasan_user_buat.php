<?php
    session_start();
    date_default_timezone_set("Asia/Jakarta");
    if (!isset($_SESSION['uname'])) {
        header('login.php');
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

    if (isset($_POST['ulas'])) {
        $rating = $_POST['rating'];
        $ulasan = $_POST['ulasan'];
        $uuidruangankosan = $_POST['uuidruangankosanform'];
        $kode_fakultas_to = $_POST['kode_fakultas_to'];
        $js = $_POST['js'];
        $hs = $_POST['hs'];
        $hd = $_POST['hd'];

        if ($rating == '0') {
            header('location:ruangan_kosan_view_pencari_kos.php?rk='. $uuidruangankosan. '&rt=0'.'&js='.$js.'&hs='.$hs.'&hd='.$hd.'&fk='.$kode_fakultas_to);
        }
        else {
            //echo $rating. $ulasan. $uuidruangankosan;
            $sql2 = "SELECT uuiduser FROM d_ruangan_kosan where uuidruangankosan = '$uuidruangankosan'";
            $hasil2 = $db->query($sql2);
            $baris2 = $hasil2->fetch(PDO::FETCH_ASSOC);
            $uuiduserpemilik = $baris2['uuiduser'];
            
            $sql6 = "INSERT INTO ulasan_user (uuidruangankosan, uuiduserulas, rating, ulasan, uuiduserpemilik) 
            VALUES (:uuidruangankosan, :uuiduser, :rating, :ulasan, :uuiduserpemilik)";
            $stmt6 = $db->prepare($sql6);
            $stmt6->execute(['uuidruangankosan' => $uuidruangankosan, 'uuiduser' => $uuiduser, 'rating' => $rating, 'ulasan' => $ulasan, 'uuiduserpemilik' => $uuiduserpemilik]);
            header('location:ruangan_kosan_view_pencari_kos.php?rk='. $uuidruangankosan. '&fk='. $kode_fakultas_to.'&js='.$js.'&hs='.$hs.'&hd='.$hd.'&fk='.$kode_fakultas_to);
        }
    }
?>