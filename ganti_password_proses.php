<?php
        session_start();
        if (!isset($_SESSION['uname'])) {
            header('location:index.php');
        }
        else {
            $user_update = $_SESSION['uname'];
            $nama_lengkap = $_SESSION['nama_lengkap'];
            $uuiduser = $_SESSION['uuiduser'];
            //$no_hp = $_SESSION['no_hp'];
            //$alamat_kosan_lengkap = $_SESSION['alamat_kosan_lengkap'];
            //$email = $_SESSION['email'];
            $role_id = $_SESSION['role_id'];
            //$st_penjual = $_SESSION['st_penjual'];
        }
        include('koneksi.php');

        $password_baru = $_POST['password_baru'];
        
        $salt = base64_encode(random_bytes(16));
        $hashed_pw = crypt($password_baru, '$2y$10$' . substr(strtr($salt, '+', '.'), 0, 22)); // $2y$10$ = bcrypt cost 10
        date_default_timezone_set("Asia/Jakarta");
        $now = new DateTime();
        $now = $now->format("Y-m-d h:i:s"); 

        $sql4 = "UPDATE user_pengguna set pword = '$hashed_pw', updatedate = '$now', userupdate = '$uuiduser'
        where uuiduser = :uuiduser";
        $stmt4 = $db->prepare($sql4);
        $stmt4->execute(['uuiduser' => $uuiduser]);

        echo "<script>alert('Password berhasil diganti'); window.location.href='index.php';</script>";
?>