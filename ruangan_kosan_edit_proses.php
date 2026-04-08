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
    $id_gambar_satuan = $_POST['hapus_gambar'];

    $sql6 = "SELECT berkas from d_ruangan_kosan_gambar where id_gambar = $id_gambar_satuan";
    $hasil6 = $db->query($sql6);
    $baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);

    $sql5 = "DELETE FROM d_ruangan_kosan_gambar where id_gambar = :id_gambar_satuan";
    $stmt5 = $db->prepare($sql5);
    $stmt5->execute(['id_gambar_satuan' => $id_gambar_satuan]);
    unlink($baris6['berkas']);

    header('location:ruangan_kosan_edit.php?rk='.$uuidruangankosan. '&st=Y');
}

if (isset($_POST['edit'])) {
    $uuidruangankosan = $_POST['uuidruangankosan'];
    $uuidkosan = $_POST['uuidkosan'];
    $nama_ruangan = $_POST['nama_ruangan'];
    $harga = !empty($_POST['harga']) ? $_POST['harga'] : 0;
    $biaya_listrik = !empty($_POST['biaya_listrik']) ? $_POST['biaya_listrik'] : 0;
    $biaya_wifi = !empty($_POST['biaya_wifi']) ? $_POST['biaya_wifi'] : 0;
    $biaya_kebersihan = !empty($_POST['biaya_kebersihan']) ? $_POST['biaya_kebersihan'] : 0;
    $jml_tersisa = !empty($_POST['jml_tersisa']) ? $_POST['jml_tersisa'] : 0;
    $ukuran_ruangan = $_POST['ukuran_ruangan'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_sewa = $_POST['jenis_sewa'];
    $letak_kamar_mandi = $_POST['letak_kamar_mandi'];
    $tipe_kloset = $_POST['tipe_kloset'];
    $now = new DateTime();
    $now = $now->format("Y-m-d H:i:s");

    function parseRupiah($value) {
    return (int) preg_replace('/[^\d]/', '', $value);
}

    $harga = parseRupiah($_POST['harga'] ?? '0');
    $biaya_listrik = parseRupiah($_POST['biaya_listrik'] ?? '0');
    $biaya_wifi = parseRupiah($_POST['biaya_wifi'] ?? '0');
    $biaya_kebersihan = parseRupiah($_POST['biaya_kebersihan'] ?? '0');

    // $harga = (int) str_replace('.', '', $harga);
    // $biaya_listrik = (int) str_replace('.', '', $biaya_listrik);
    // $biaya_wifi = (int) str_replace('.', '', $biaya_wifi);
    // $biaya_kebersihan = (int) str_replace('.', '', $biaya_kebersihan);

    $uploadDir = "uploads/"; // Folder penyimpanan gambar
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 
    $maxSize = 1 * 1024 * 1024; // 1MB dalam byte;
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
    }

    $sql4 = "UPDATE d_ruangan_kosan set 
    deskripsi = '$deskripsi',
    nama_ruangan = '$nama_ruangan',
    harga = $harga,
    biaya_listrik = $biaya_listrik,
    biaya_kebersihan = $biaya_kebersihan,
    biaya_wifi = $biaya_wifi,
    jml_tersisa = $jml_tersisa,
    ukuran_ruangan = '$ukuran_ruangan',
    jenis_sewa = $jenis_sewa,
    letak_kamar_mandi = '$letak_kamar_mandi',
    tipe_kloset = '$tipe_kloset',
    userupdate = '$uuiduser',
    updatedate = '$now'
    where uuidruangankosan = :uuidruangankosan";
    $stmt4 = $db->prepare($sql4);
    $stmt4->execute(['uuidruangankosan' => $uuidruangankosan]);
    
    if (!isset($_FILES['gambar_ruangan']['tmp_name'])) {
        echo "GAMBAR RUANGAN TIDAK BOLEH KOSONG";
    }
else {
    foreach ($_FILES['gambar_ruangan']['tmp_name'] as $key => $tmpName) {
        $id_gambar = $_POST['id_gambar'][$key] ?? null; 
        
        $fileName = $_FILES['gambar_ruangan']['name'][$key];
        $fileSize = $_FILES['gambar_ruangan']['size'][$key];
        $fileTmp = $_FILES['gambar_ruangan']['tmp_name'][$key];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        if (!$id_gambar) {              
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
                    $sql = "INSERT INTO d_ruangan_kosan_gambar (uuidruangankosan, uuidkosan, filename, berkas) 
                            VALUES (:uuidruangankosan, :uuidkosan, :nama_file, :berkas)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':uuidruangankosan', $uuidruangankosan, PDO::PARAM_STR);
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

                // 🔥 Tambahan: hapus file lama dari folder
                try {
                    $stmt = $db->prepare("SELECT berkas FROM d_ruangan_kosan_gambar WHERE id_gambar = :id_gambar AND uuidruangankosan = :uuidruangankosan");
                    $stmt->execute([
                        'id_gambar' => $id_gambar,
                        'uuidruangankosan' => $uuidruangankosan
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
                    $sql = "UPDATE d_ruangan_kosan_gambar 
                            SET FILENAME = :filename,
                                BERKAS = :berkas
                            WHERE id_gambar = :id_gambar 
                              AND uuidruangankosan = :uuidruangankosan";
                            
                    $stmt = $db->prepare($sql);
                    $stmt->execute([
                        'filename' => $newFileName,
                        'id_gambar' => $id_gambar,
                        'uuidruangankosan' => $uuidruangankosan,
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

    header('location:ruangan_kosan_edit.php?rk='.$uuidruangankosan. '&st=Y');
}
?>
