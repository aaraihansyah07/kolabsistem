<?php
require("koneksi.php"); // koneksi PDO $db

if (isset($_POST['update'])) {
    try {
        $uuiduser    = $_POST['uuiduser'];
        $uuidporto   = $_POST['uuidporto'];
        $nama_porto  = $_POST['nama_porto'];
        $id_kat_porto = $_POST['id_kat_porto'];
        $keterangan  = $_POST['keterangan'];

        // --- Ambil data lama ---
        $sqlOld = "SELECT filename, mimetype, thumbnail_filename
                   FROM d_portofolio
                   WHERE uuidporto = :uuidporto AND uuiduser = :uuiduser";
        $stmtOld = $db->prepare($sqlOld);
        $stmtOld->execute([
            ':uuidporto' => $uuidporto,
            ':uuiduser'  => $uuiduser
        ]);
        $oldData = $stmtOld->fetch(PDO::FETCH_ASSOC);

        if (!$oldData) {
            echo "<script>alert('Data portofolio tidak ditemukan');window.location.href='modul_saya.php';</script>";
            exit();
        }

        // -------------------------
        // HANDLE UPDATE THUMBNAIL
        // -------------------------
        $thumbName = $oldData['thumbnail_filename'];

        // Jika user klik hapus thumbnail
        if (isset($_POST['hapus_thumbnail_filename']) && $_POST['hapus_thumbnail_filename'] === "1") {
            if (!empty($thumbName) && file_exists("uploads/thumbnail/" . $thumbName)) {
                unlink("uploads/thumbnail/" . $thumbName);
            }
            $thumbName = null;
        }

        // Jika user upload thumbnail baru
        if (isset($_FILES['thumbnail_filename']) && $_FILES['thumbnail_filename']['error'] === UPLOAD_ERR_OK) {

            $file    = $_FILES['thumbnail_filename'];
            $size    = $file['size'];
            $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if ($size > 1 * 1024 * 1024) {
                echo "<script>alert('Ukuran thumbnail maksimal 1 MB.');window.location.href='edit_modul.php?id=$uuidporto';</script>";
                exit();
            }
            if (!in_array($ext, $allowed)) {
                echo "<script>alert('Thumbnail harus JPG/PNG/JPEG/WebP.');window.location.href='edit_modul.php?id=$uuidporto';</script>";
                exit();
            }

            $newThumbName = uniqid("thumb_") . "." . $ext;
            $path = "uploads/thumbnail/" . $newThumbName;

            if (!move_uploaded_file($file['tmp_name'], $path)) {
                echo "<script>alert('Gagal upload thumbnail baru.');window.location.href='edit_modul.php?id=$uuidporto';</script>";
                exit();
            }

            if (!empty($thumbName) && file_exists("uploads/thumbnail/".$thumbName)) {
                unlink("uploads/thumbnail/".$thumbName);
            }

            $thumbName = $newThumbName;
        }

        // -------------------------
        // HANDLE EDIT PDF (opsional)
        // -------------------------
        $pdfName = $oldData['filename'];
        $pdfMime = $oldData['mimetype'];

        // Jika ada PDF baru yang diupload
        if (isset($_FILES['filename']) && $_FILES['filename']['error'] === UPLOAD_ERR_OK) {

            $pdfFile = $_FILES['filename'];
            $pdfSize = $pdfFile['size'];
            $pdfType = mime_content_type($pdfFile['tmp_name']);

            $newPdfName = uniqid("modul_") . ".pdf";

            // Validasi PDF
            if ($pdfSize > 7 * 1024 * 1024) {
                echo "<script>alert('Maksimal ukuran PDF adalah 7 MB.');window.location.href='edit_modul.php?id=$uuidporto';</script>";
                exit();
            }

            if ($pdfType !== "application/pdf") {
                echo "<script>alert('File harus berformat PDF.');window.location.href='edit_modul.php?id=$uuidporto';</script>";
                exit();
            }

            // Hapus PDF lama
            if (!empty($oldData['filename']) && file_exists("uploads/modul/" . $oldData['filename'])) {
                unlink("uploads/modul/" . $oldData['filename']);
            }

            // Simpan PDF baru
            $pdfPath = "uploads/modul/" . $newPdfName;
            if (!move_uploaded_file($pdfFile['tmp_name'], $pdfPath)) {
                echo "<script>alert('Gagal upload PDF baru.');window.location.href='edit_modul.php?id=$uuidporto';</script>";
                exit();
            }

            // Set data baru
            $pdfName = $newPdfName;
            $pdfMime = $pdfType;
        }

        $sql = "UPDATE d_portofolio 
                SET nama_porto     = :nama_porto,
                    keterangan     = :keterangan,
                    id_kat_porto   = :id_kat_porto,
                    thumbnail_filename = :thumb1,
                    filename       = :filename,
                    mimetype       = :mimetype,
                    updatedate     = NOW()
                WHERE uuidporto = :uuidporto AND uuiduser = :uuiduser";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nama_porto'     => $nama_porto,
            ':keterangan'     => $keterangan,
            ':id_kat_porto'   => (int)$id_kat_porto,
            ':thumb1'         => $thumbName,
            ':filename'       => $pdfName,
            ':mimetype'       => $pdfMime,
            ':uuidporto'      => $uuidporto,
            ':uuiduser'       => $uuiduser
        ]);

        echo "<script>alert('Portofolio berhasil diupdate');window.location.href='modul_saya.php';</script>";

    } catch (PDOException $e) {
        echo "<pre>";
        print_r($e->errorInfo);
        echo "Message: " . $e->getMessage();
        echo "</pre>";
        exit;
    } catch (Exception $e) {
        echo "<pre>General Error: " . $e->getMessage() . "</pre>";
        exit;
    }
}
?>
