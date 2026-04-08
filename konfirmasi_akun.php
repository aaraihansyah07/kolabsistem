<?php
    include('koneksi.php');
    $token = $_GET['token'];
    echo $token;

    $sql5 = "SELECT count(1) token from user_pengguna where token = '$token'";
    $hasil5 = $db->query($sql5);
    $baris5 = $hasil5->fetch(PDO::FETCH_ASSOC);

    if ($baris5['token'] == 1) {
        $sql4 = "UPDATE user_pengguna SET st_active = 'Y'
        WHERE token = :token";
        $stmt4 = $db->prepare($sql4);
        $stmt4->execute([
            'token' => $token
        ]);

        echo "<script>alert('Selamat, akun Anda sudah berhasil diaktifkan!'); window.location.href='login.php';</script>";
    }
    else {
        echo "<script>alert('Token konfirmasi tidak sesuai!'); window.location.href='login.php';</script>";
    }
?>