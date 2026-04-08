<?php
require("koneksi.php"); // koneksi PDO $db

if (isset($_POST['update'])) {
    try {
        $uuiduser    = $_POST['uuiduser'];
        $id_promosi   = $_POST['id_promosi'];
        $nama_promosi  = $_POST['nama_promosi'];
        $id_kat_promosi = $_POST['id_kat_promosi'];
        $keterangan  = $_POST['keterangan'];
        $link  = $_POST['link'];

        // --- Ambil data lama ---
        $sqlOld = "SELECT filename, mimetype, filename
                   FROM d_promosi_mahasiswa
                   WHERE id_promosi = :id_promosi AND uuiduser = :uuiduser";
        $stmtOld = $db->prepare($sqlOld);
        $stmtOld->execute([
            ':id_promosi' => $id_promosi,
            ':uuiduser'  => $uuiduser
        ]);
        $oldData = $stmtOld->fetch(PDO::FETCH_ASSOC);

        if (!$oldData) {
            echo "<script>alert('Data promosi usaha tidak ditemukan');window.location.href='promosi_usaha_upload.php';</script>";
            exit();
        }

        // -------------------------
        // HANDLE UPDATE THUMBNAIL
        // -------------------------
        $thumbName = $oldData['filename'];

        // Jika user klik hapus thumbnail
        if (isset($_POST['hapus_thumbnail_filename']) && $_POST['hapus_thumbnail_filename'] === "1") {
            if (!empty($thumbName) && file_exists("uploads/promosi/" . $thumbName)) {
                unlink("uploads/promosi/" . $thumbName);
            }
            $thumbName = null;
        }

        // Jika user upload thumbnail baru
        if (isset($_FILES['filename']) && $_FILES['filename']['error'] === UPLOAD_ERR_OK) {

            $file    = $_FILES['filename'];
            $size    = $file['size'];
            $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if ($size > 1 * 1024 * 1024) {
                echo "<script>alert('Ukuran gambar maksimal 1 MB.');window.location.href='promosi_mahasiswa_edit.php?id=$id_promosi';</script>";
                exit();
            }
            if (!in_array($ext, $allowed)) {
                echo "<script>alert('Gambar harus JPG/PNG/JPEG/WebP.');window.location.href='promosi_mahasiswa_edit.php?id=$id_promosi';</script>";
                exit();
            }

            $newThumbName = uniqid("thumb_") . "." . $ext;
            $path = "uploads/promosi/" . $newThumbName;

            if (!move_uploaded_file($file['tmp_name'], $path)) {
                echo "<script>alert('Gagal upload gambar baru.');window.location.href='promosi_mahasiswa_edit.php?id=$id_promosi';</script>";
                exit();
            }

            if (!empty($thumbName) && file_exists("uploads/promosi/".$thumbName)) {
                unlink("uploads/promosi/".$thumbName);
            }

            $thumbName = $newThumbName;
        }

        $sql = "UPDATE d_promosi_mahasiswa 
                SET nama_promosi     = :nama_promosi,
                    keterangan     = :keterangan,
                    id_kat_promosi   = :id_kat_promosi,
                    filename       = :filename,
                    updatedate     = NOW(),
                    link = :link
                WHERE id_promosi = :id_promosi AND uuiduser = :uuiduser";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nama_promosi'     => $nama_promosi,
            ':keterangan'     => $keterangan,
            ':id_kat_promosi'   => (int)$id_kat_promosi,
            ':filename'         => $thumbName,
            ':id_promosi'      => $id_promosi,
            ':uuiduser'       => $uuiduser,
            ':link'       => $link
        ]);

        echo "<script>alert('Gambar promosi berhasil diupdate');window.location.href='promosi_mahasiswa_upload.php';</script>";

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
