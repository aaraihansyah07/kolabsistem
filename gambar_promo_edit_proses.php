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

    if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
		header('location:index_pencari_kos.php');
	}

if (isset($_POST['hapus_gambar'])) {
    $uuidruangankosan = $_POST['uuidruangankosan'];
    $uuidkosan = $_POST['uuidkosan'];
    $id_gambar_satuan = $_POST['hapus_gambar'];

    $sql6 = "SELECT berkas from d_gambar_promo where uuidgambarpromo = '$id_gambar_satuan'";
    $hasil6 = $db->query($sql6);
    $baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);

    $sql5 = "DELETE FROM d_gambar_promo where uuidgambarpromo = :id_gambar_satuan";
    $stmt5 = $db->prepare($sql5);
    $stmt5->execute(['id_gambar_satuan' => $id_gambar_satuan]);
    unlink($baris6['berkas']);

    header('location:gambar_promo_edit.php?rk='.$uuidruangankosan. '&st=Y');
}

if (isset($_POST['edit'])) {
    $uuidruangankosan = $_POST['uuidruangankosan'];
    $uuidkosan = $_POST['uuidkosan'];
    $now = new DateTime();
    $now = $now->format("Y-m-d H:i:s");

    $uploadDir = "uploads/promosi_usaha/"; // Folder penyimpanan gambar
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 
    $maxSize = 1 * 1024 * 1024; // 1MB dalam byte;
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
    }

    if (!isset($_FILES['gambar_ruangan']['tmp_name'])) {
        echo "GAMBAR RUANGAN TIDAK BOLEH KOSONG";
    }
else {
    foreach ($_FILES['gambar_ruangan']['tmp_name'] as $key => $tmpName) {
        $uuidgambarpromo = $_POST['uuidgambarpromo'][$key] ?? null; 
        
        $fileName = $_FILES['gambar_ruangan']['name'][$key];
        $fileSize = $_FILES['gambar_ruangan']['size'][$key];
        $fileTmp = $_FILES['gambar_ruangan']['tmp_name'][$key];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        if (!$uuidgambarpromo) {
            // INSERT LOGIC (sama seperti sebelumnya)
            if ($fileSize > $maxSize) {
                echo "❌ File {$fileName} terlalu besar! Maksimal 1MB.";
                continue;
            }
            if (!in_array($fileExt, $allowedTypes)) {
                echo "❌ Format {$fileName} file tidak diperbolehkan/File yang diupload kosong!";
                continue;
            }
        
            $newFileName = uniqid("img_") . "." . $fileExt;
            $filePath = $uploadDir . $newFileName;
        
            if (move_uploaded_file($fileTmp, $filePath)) {
                try {
                    $sql = "INSERT INTO d_gambar_promo (uuiduser, uuidkosan, filename, berkas) 
                            VALUES (:uuiduser, :uuidkosan, :nama_file, :berkas)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':uuiduser', $uuiduser, PDO::PARAM_STR);
                    $stmt->bindParam(':uuidkosan', $uuidkosan, PDO::PARAM_STR);
                    $stmt->bindParam(':nama_file', $newFileName, PDO::PARAM_STR);
                    $stmt->bindParam(':berkas', $filePath, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo "❌ Database error: " . $e->getMessage();
                }
            } else {
                echo "❌ Gagal mengupload {$fileName}!";
            }
        } else {
            // UPDATE LOGIC
            if ($fileSize > $maxSize) {
                echo "❌ File {$fileName} terlalu besar! Maksimal 1MB.";
                continue;
            }
            if (!in_array($fileExt, $allowedTypes)) {
                echo "❌ Format {$fileName} file tidak diperbolehkan/File yang diupload kosong!";
                continue;
            }

            $newFileName = uniqid("img_") . "." . $fileExt;
            $filePath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmp, $filePath)) {
                // 🔥 Tambahan: Hapus file lama dari folder
                try {
                    $stmt = $db->prepare("SELECT berkas FROM d_gambar_promo WHERE uuidgambarpromo = :uuidgambarpromo AND uuidkosan = :uuidkosan");
                    $stmt->execute([
                        'uuidgambarpromo' => $uuidgambarpromo,
                        'uuidkosan' => $uuidkosan
                    ]);
                    $old = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($old && file_exists($old['berkas'])) {
                        unlink($old['berkas']); // hapus file lama
                    }
                } catch (PDOException $e) {
                    echo "❌ Gagal mengambil data lama: " . $e->getMessage();
                }

                // Lanjutkan update database
                try {
                    $sql = "UPDATE d_gambar_promo 
                            SET FILENAME = :filename,
                                BERKAS = :berkas
                            WHERE uuidgambarpromo = :uuidgambarpromo 
                              AND uuidkosan = :uuidkosan";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([
                        'filename' => $newFileName,
                        'uuidgambarpromo' => $uuidgambarpromo,
                        'uuidkosan' => $uuidkosan,
                        'berkas' => $filePath
                    ]);
                } catch (PDOException $e) {
                    echo "❌ Database error: " . $e->getMessage();
                }
            } else {
                echo "❌ Gagal mengupload {$fileName}!";
            }
        }
    }
}
    header('location:gambar_promo_edit.php?rk='.$uuidruangankosan. '&st=Y');
}
?>
