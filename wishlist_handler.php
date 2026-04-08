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

	if ((!isset($_SESSION['uname']))) {
		header('location:index.php');
	}

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['uuiduserfav']) || !isset($data['uuidporto']) || !isset($data['action'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit;
}

$uuiduserfav = $data['uuiduserfav'];
$uuidporto = $data['uuidporto'];
$action = $data['action'];

try {
    if ($action === 'add') {
        // Tambahkan ke wishlist
        $sqlb = "select uuiduser from d_portofolio where uuidporto = '$uuidporto'";
        $hasilb = $db->query($sqlb);
        $barisb = $hasilb->fetch(PDO::FETCH_ASSOC);
        $uuiduserpemilik = $barisb['uuiduser'];

        $sqlc = "select count(1) cek_ruangan_kosan from f_favourite_pencari_porto where uuidporto = '$uuidporto' AND uuiduserfav = '$uuiduserfav' AND jenis_notif = 'FAV'";
        $hasilc = $db->query($sqlc);
        $barisc = $hasilc->fetch(PDO::FETCH_ASSOC);

        if ($barisc['cek_ruangan_kosan'] < 1) {
            $sql = "INSERT INTO f_favourite_pencari_porto (uuiduserfav, uuidporto, uuiduserpemilik, jenis_notif) VALUES (:uuiduserfav, :uuidporto, :uuiduserpemilik, 'FAV')";
            $stmt = $db->prepare($sql);
            $stmt->execute(['uuiduserfav' => $uuiduserfav, 'uuidporto' => $uuidporto, 'uuiduserpemilik' => $uuiduserpemilik]);
            echo json_encode(['status' => 'success', 'message' => 'Wishlist added']);
        }
        else {
            echo json_encode(['status' => 'success', 'message' => 'Wishlist sudah ditambahkan sebelumnya']);
        }

        // $sql = "INSERT INTO f_favourite_pencari_kos (uuiduserfav, uuidporto, uuiduserpemilik) VALUES (:uuiduserfav, :uuidporto, :uuiduserpemilik)";
        // $stmt = $db->prepare($sql);
        // $stmt->execute(['uuiduserfav' => $uuiduserfav, 'uuidporto' => $uuidporto, 'uuiduserpemilik' => $uuiduserpemilik]);
        // echo json_encode(['status' => 'success', 'message' => 'Wishlist added']);
    } elseif ($action === 'remove') {
        // Hapus dari wishlist
        $sql2 = "DELETE FROM log_favourite_pencari_porto WHERE uuiduserfav = :uuiduserfav AND uuidporto = :uuidporto AND jenis_notif = 'FAV'";
        $stmt2 = $db->prepare($sql2);
        $stmt2->execute(['uuiduserfav' => $uuiduserfav, 'uuidporto' => $uuidporto]);

        $sql = "DELETE FROM f_favourite_pencari_porto WHERE uuiduserfav = :uuiduserfav AND uuidporto = :uuidporto AND jenis_notif = 'FAV'";
        $stmt = $db->prepare($sql);
        $stmt->execute(['uuiduserfav' => $uuiduserfav, 'uuidporto' => $uuidporto]);
        echo json_encode(['status' => 'success', 'message' => 'Wishlist removed']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
