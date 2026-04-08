<?php
require("koneksi.php"); // koneksi PDO $db

if (isset($_POST['update'])) {
    $uuiduserdiundang   = $_POST['uuiduserdiundang'];
    $uuiduserpengundang = $_POST['uuiduserpengundang'];
    $id_jenis_kerjasama = $_POST['id_jenis_kerjasama'];
    $keterangan   = $_POST['keterangan'];
    $uuidporto = $_POST['uuidporto'];

    $sqlb = "SELECT count(1) cek_dobel from f_undangan_kerjasama 
    where uuiduserpengundang = '$uuiduserpengundang' AND uuiduserdiundang = '$uuiduserdiundang' AND st_konfirmasi is null";
    $hasilb = $db->query($sqlb);
    $barisb = $hasilb->fetch(PDO::FETCH_ASSOC);

    if ($barisb['cek_dobel'] > 0) {
         echo "<script>alert('Sudah pernah mengundang kolaborasi user ini sebelumnya, tunggu konfirmasi persetujuan dari dia ya...');window.location.href='modul_view.php?md=".$uuidporto."&fk=&uv=';</script>";
    }
    else {
        try {
            $sqlc = "SELECT nextval('seq_id_undangan') SEQ_ID";
            $hasilc = $db->query($sqlc);
            $barisc = $hasilc->fetch(PDO::FETCH_ASSOC);
            $id_undangan = $barisc['seq_id'];
            
            $sql = "INSERT INTO f_undangan_kerjasama
                    (id_undangan, uuiduserdiundang, uuiduserpengundang, id_jenis_kerjasama, keterangan, uuidporto) 
                    VALUES 
                    (:id_undangan, :uuiduserdiundang, :uuiduserpengundang, :id_jenis_kerjasama, :keterangan, :uuidporto)";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':id_undangan' => $id_undangan,
                ':uuiduserdiundang' => $uuiduserdiundang,
                ':uuiduserpengundang'        => $uuiduserpengundang,
                ':id_jenis_kerjasama'        => $id_jenis_kerjasama,
                ':keterangan'          => $keterangan,
                ':uuidporto'          => $uuidporto
            ]);

            $sql2 = "INSERT INTO f_favourite_pencari_porto
                    (uuiduserfav, usercreate, uuiduserpemilik, jenis_notif, id_undangan, uuidporto) 
                    VALUES 
                    (:uuiduserpengundang, :usercreate, :uuiduserdiundang, 'UDG', :id_undangan, :uuidporto)";

            $stmt2 = $db->prepare($sql2);
            $stmt2->execute([
                ':uuiduserpengundang' => $uuiduserpengundang,
                ':usercreate'        => $uuiduserpengundang,
                ':uuiduserdiundang'        => $uuiduserdiundang,
                ':id_undangan'          => $id_undangan,
                ':uuidporto'          => $uuidporto
            ]);

            echo "<script>alert('Undangan kolaborasi berhasil dikirim! Tunggu konfirmasi dari user tersebut ya..');window.location.href='modul_view.php?md=".$uuidporto."&fk=&uv=';</script>";
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
}
?>
