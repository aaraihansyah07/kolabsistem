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
    if ((!isset($_SESSION['uname'])) or ($user !== 'admin_shoficraft' AND $role_id != 2)) {
		header('location:index_pencari_kos.php');
	}

if (isset($_POST['tambah'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = !empty($_POST['harga']) ? $_POST['harga'] : 0;    
    $harga = (int) str_replace('.', '', $harga);
    
    $jumlah_stok = !empty($_POST['jumlah_stok']) ? $_POST['jumlah_stok'] : 0;
    $deskripsi = $_POST['deskripsi'];
    $id_kategori = $_POST['id_kategori'];
    $bahan = $_POST['bahan'];

    $uploadDir = "uploads/produk_shoficraft/"; // Folder penyimpanan gambar
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 
    $maxSize = 1 * 1024 * 1024; // 1MB dalam byte;

    $sql5 = "SELECT max(seq) max_seq from produk_shoficraft";
    $hasil5 = $db->query($sql5);
    $baris5 = $hasil5->fetch(PDO::FETCH_ASSOC);

    $seq = $baris5['max_seq']+1;
    $kode_produk = 'SHFCFT00'.$seq;

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
    }
    try {
        $sql = "INSERT INTO produk_shoficraft (
                    nama_produk, harga, jumlah_stok, bahan, deskripsi, id_kategori, seq, kode_produk
                ) 
                VALUES (
                    :nama_produk, :harga, :jumlah_stok, :bahan, 
                    :deskripsi, :id_kategori, :seq, :kode_produk
                )";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nama_produk', $nama_produk, PDO::PARAM_STR);
        $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
        $stmt->bindParam(':jumlah_stok', $jumlah_stok, PDO::PARAM_INT);
        $stmt->bindParam(':bahan', $bahan, PDO::PARAM_STR);
        $stmt->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
        $stmt->bindParam(':id_kategori', $id_kategori, PDO::PARAM_INT);
        $stmt->bindParam(':seq', $seq, PDO::PARAM_INT);
        $stmt->bindParam(':kode_produk', $kode_produk, PDO::PARAM_STR);
        
        $stmt->execute();

        // **Ambil UUID dari ruangan yang baru dibuat**
        $stmt = $db->prepare("SELECT uuidproduk FROM produk_shoficraft 
        WHERE harga = :harga AND nama_produk = :nama_produk AND id_kategori = :id_kategori
        ORDER BY createdate DESC LIMIT 1");
        $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
        $stmt->bindParam(':nama_produk', $nama_produk, PDO::PARAM_STR);
        $stmt->bindParam(':id_kategori', $id_kategori, PDO::PARAM_STR);
        $stmt->execute();
        $uuidproduk = $stmt->fetchColumn(); // Ambil UUID yang baru

        if (!$uuidproduk) {
            die("❌ Gagal mendapatkan UUID Produk!");
        }

        foreach ($_FILES['gambar_produk']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['gambar_produk']['name'][$key];
            $fileSize = $_FILES['gambar_produk']['size'][$key];
            $fileTmp = $_FILES['gambar_produk']['tmp_name'][$key];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
            if ($fileSize > $maxSize) {
                echo "❌ File {$fileName} terlalu besar! Maksimal 1MB.";
                continue;
            }
            if (!in_array($fileExt, $allowedTypes)) {
                echo "❌ Format {$fileName} tidak diperbolehkan!";
                continue;
            }
        
            $newFileName = uniqid("img_") . "." . $fileExt;
            $filePath = $uploadDir . $newFileName;
        
            if (move_uploaded_file($fileTmp, $filePath)) {
                try {
                    // **Gunakan UUID yang baru**
                    $sql = "INSERT INTO produk_shoficraft_gambar (uuidproduk, filename, berkas) 
                            VALUES (:uuidproduk, :nama_file, :berkas)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':uuidproduk', $uuidproduk, PDO::PARAM_STR);
                    $stmt->bindParam(':nama_file', $newFileName, PDO::PARAM_STR);
                    $stmt->bindParam(':berkas', $filePath, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo "❌ Database error: " . $e->getMessage();
                }
            } else {
                echo "❌ Gagal mengupload {$fileName}!";
            }
            echo $uuidproduk. $nama_produk. $harga. $newFileName. $fileSize. $fileTmp. $filePath. $bahan. $deskripsi. $jumlah_stok;
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header('Location:katalog_partner.php');
    exit();
}
?>
