<?php
require("koneksi.php"); // koneksi PDO $db

if (isset($_POST['tambah'])) {
    try {
        $uuiduser      = $_POST['uuiduser'];
        $nama_porto    = $_POST['nama_porto'];
        $id_kat_porto  = $_POST['id_kat_porto'];
        //$st_tawar      = $_POST['st_tawar'];
        //$harga         = $_POST['harga'];
        //$id_jenjang    = $_POST['id_jenjang'];
        //$id_mapel      = $_POST['id_mapel'];
        $keterangan    = $_POST['keterangan'];
        //$id_perangkat_ajar = $_POST['id_perangkat_ajar'];

        //$harga = (int) str_replace('.', '', $harga);

        // --- validasi upload limit & rekening seperti sebelumnya ---
        // $sql3 = "select count(1) cek_jml from d_portofolio u
        // where u.uuiduser = '$uuiduser'";
        // $hasil3 = $db->query($sql3);
        // $baris3 = $hasil3->fetch(PDO::FETCH_ASSOC);

        // if ($baris3['cek_jml'] > 0) {
        //     echo "<script>alert('Maaf, tidak bisa upload perangkat ajar karena batas maksimal jumlah upload sebanyak ".$baris3['max_upload']." sudah tercapai'); window.location.href='modul_saya.php';</script>";
        //     exit();
        // }

        // if (!isset($baris3['no_rekening'])) {
        //     echo "<script>alert('Harap isi dahulu nomor rekening Anda supaya pembayaran oleh pencari perangkat ajar dapat terkirim'); window.location.href='modul_saya.php';</script>";
        //     exit();
        // }

        // --- Validasi PDF ---
        if (!isset($_FILES['filename']) || $_FILES['filename']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File PDF wajib diupload.");
        }

        $pdfFile      = $_FILES['filename'];
        $pdfSize      = $pdfFile['size'];
        $pdfType      = mime_content_type($pdfFile['tmp_name']);
        $pdfName      = uniqid("modul_") . ".pdf";

        if ($pdfSize > 7 * 1024 * 1024) {
            echo "<script>alert('Gagal upload portofolio! maksimal ukuran pdf 7 Mb.');window.location.href='tambah_modul.php';</script>";
            exit();
        }
        if ($pdfType !== "application/pdf") {
            echo "<script>alert('Gagal upload portofolio! modul ajar harus berformat pdf.');window.location.href='tambah_modul.php';</script>";
            exit();
        }

        // --- Validasi Thumbnail Utama ---
        if (!isset($_FILES['thumbnail_gambar']) || $_FILES['thumbnail_gambar']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>alert('Gagal upload portofolio! Thumbnail utama wajib diupload.');window.location.href='tambah_modul.php';</script>";
            exit();
        }

        // Helper untuk validasi & simpan thumbnail
        function handleThumbnail($fileKey, $prefix = "thumb_") {
            if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
                return null; // tidak diupload
            }

            $thumbFile = $_FILES[$fileKey];
            $thumbSize = $thumbFile['size'];
            $ext       = strtolower(pathinfo($thumbFile['name'], PATHINFO_EXTENSION));
            $allowed   = ['jpg','jpeg','png','webp'];

            if ($thumbSize > 1 * 1024 * 1024) {
                throw new Exception("Ukuran thumbnail $fileKey maksimal 1 MB.");
            }
            if (!in_array($ext, $allowed)) {
                throw new Exception("Thumbnail $fileKey harus JPG/PNG/JPEG/WEBP.");
            }

            $thumbName = uniqid($prefix) . "." . $ext;
            $thumbPath = "uploads/thumbnail/" . $thumbName;

            if (!move_uploaded_file($thumbFile['tmp_name'], $thumbPath)) {
                throw new Exception("Gagal upload $fileKey.");
            }

            return $thumbName;
        }

        // --- Simpan PDF ---
        $pdfPath   = "uploads/modul/" . $pdfName;
        if (!move_uploaded_file($pdfFile['tmp_name'], $pdfPath)) {
            throw new Exception("Gagal upload PDF.");
        }

        // --- Simpan semua thumbnail ---
        $thumbUtama = handleThumbnail('thumbnail_gambar', "thumb_");
        // $thumb2     = handleThumbnail('thumbnail_gambar2', "thumb2_");
        // $thumb3     = handleThumbnail('thumbnail_gambar3', "thumb3_");
        // $thumb4     = handleThumbnail('thumbnail_gambar4', "thumb4_");
        // $thumb5     = handleThumbnail('thumbnail_gambar5', "thumb5_");

        // --- Insert ke database ---
        $sql = "INSERT INTO d_portofolio 
                (id_kat_porto, nama_porto, keterangan, uuiduser, filename, mimetype, 
                 thumbnail_filename) 
                VALUES 
                (:id_kat_porto, :nama_modul, :keterangan, :uuiduser, :filename, :mimetype, :thumb1)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id_kat_porto' => $id_kat_porto,
            ':nama_modul'        => $nama_porto,
            ':keterangan'        => $keterangan,
            ':uuiduser'          => $uuiduser,
            ':filename'          => $pdfName,
            ':mimetype'          => $pdfType,
            ':thumb1'            => $thumbUtama
        ]);

        echo "<script>alert('Portofolio berhasil ditambahkan');window.location.href='modul_saya.php';</script>";

    } catch (PDOException $e) {
        echo "<pre>SQLSTATE: " . $e->getCode() . "\n";
        print_r($e->errorInfo);
        echo "\nMessage: " . $e->getMessage() . "</pre>";
        exit;
    } catch (Exception $e) {
        echo "<pre>General Error: " . $e->getMessage() . "</pre>";
        exit;
    }
}
?>
