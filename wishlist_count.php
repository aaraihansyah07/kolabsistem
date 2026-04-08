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

	if ((!isset($_SESSION['uname']))) {
		header('location:index.php');
	}

header('Content-Type: application/json');

if (!isset($_GET['uuiduserfav'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid user']);
    exit;
}

$uuiduserfav = $_GET['uuiduserfav'];

try {
    $sql = "SELECT COUNT(1) AS total FROM f_favourite_pencari_porto fav 
	LEFT JOIN d_portofolio r on r.uuidporto = fav.uuidporto
	WHERE uuiduserfav = :uuiduserfav AND jenis_notif = 'FAV'";
    $stmt = $db->prepare($sql);
    $stmt->execute(['uuiduserfav' => $uuiduserfav]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'count' => $result['total']]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
