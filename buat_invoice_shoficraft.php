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
	
    if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 2)) {
		header('location:index_pencari_kos.php');
	}

    if (isset($_POST['buat_invoice'])) {
        $username_pemesan = $_POST['uname'];
        $nama_pemesan = $_POST['nama_pemesan'];
        $alamat = $_POST['alamat'];
        $uuiddiskonrwd = $_POST['uuiddiskonrwd'];
        $no_hp_pemesan = $_POST['no_hp_pemesan'];
        $uuidproduk = $_POST['uuidproduk'];
        $qty = $_POST['qty'];
        $harga = $_POST['harga'];
        $jumlah_stok = $_POST['jumlah_stok'];

        $sql5 = "SELECT max(seq) max_seq from f_invoice_shoficraft_dtl";
        $hasil5 = $db->query($sql5);
        $baris5 = $hasil5->fetch(PDO::FETCH_ASSOC);
        $max_seq = $baris5['max_seq'];

        if (!isset($baris5['max_seq'])) {
            $no_invoice = 'SINV.'.Date('dmY').'.0001';
        }
        else {
            $no_invoice = 'SINV.'.Date('dmY').'.000'.$max_seq;
        }
        
        if ($uuiddiskonrwd == '') {
            $disc_amount = null;
            $nama_diskon = '';
            $uuiddiskonrwd = null;
        }
        else {
            $sql3 = "SELECT nama_diskon, disc_amount FROM d_diskon_reward where uuiddiskonrwd = '$uuiddiskonrwd'";
            $hasil3 = $db->query($sql3);
            $baris3 = $hasil3->fetch(PDO::FETCH_ASSOC);

            $disc_amount = $baris3['disc_amount']*$qty;
            $nama_diskon = $baris3['nama_diskon'];
        }

        if ($jumlah_stok < $qty) {
            header('location:katalog_partner_detail.php?upr='.$uuidproduk.'&iv=Z');
        }
        else {
            $amount = $qty*$harga;
            $netto = $amount-$disc_amount;

            $sql2 = "INSERT INTO f_invoice_shoficraft_hdr (nama_pemesan, alamat, username_pemesan, no_hp_pemesan, no_invoice) 
            VALUES (:nama_pemesan, :alamat, :username_pemesan, :no_hp_pemesan, :no_invoice)";
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute(['nama_pemesan' => $nama_pemesan, 'alamat' => $alamat, 'username_pemesan' => $username_pemesan, 'no_hp_pemesan' => $no_hp_pemesan, 'no_invoice' => $no_invoice]);

            $stmt4 = $db->prepare("SELECT uuidinvoice FROM f_invoice_shoficraft_hdr
            WHERE username_pemesan = :username_pemesan AND no_hp_pemesan = :no_hp_pemesan 
            AND nama_pemesan = :nama_pemesan
            ORDER BY tgl_pesanan DESC LIMIT 1");
            $stmt4->bindParam(':username_pemesan', $username_pemesan, PDO::PARAM_STR);
            $stmt4->bindParam(':no_hp_pemesan', $no_hp_pemesan, PDO::PARAM_STR);
            $stmt4->bindParam(':nama_pemesan', $nama_pemesan, PDO::PARAM_STR);
            $stmt4->execute();
            $uuidinvoice_new = $stmt4->fetchColumn();

            $sql = "INSERT INTO f_invoice_shoficraft_dtl (uuidinvoice, uuidproduk, qty, price, amount, netto, disc_amount, nama_diskon, uuiddiskonrwd, no_invoice) 
            VALUES (:uuidinvoice, :uuidproduk, :qty, :price, :amount, :netto, :disc_amount, :nama_diskon, :uuiddiskonrwd, :no_invoice)";
            $stmt = $db->prepare($sql);
            $stmt->execute(['uuidinvoice' => $uuidinvoice_new, 'uuidproduk' => $uuidproduk, 'qty' => $qty, 'price' => $harga, 'amount' => $amount, 'netto' => $netto, 'disc_amount' => $disc_amount, 'nama_diskon' => $nama_diskon, 'uuiddiskonrwd' => $uuiddiskonrwd, 'no_invoice' => $no_invoice]); 
            
            $sql6 = "UPDATE d_diskon_reward set st_terpakai = 'Y' where uuiddiskonrwd = :uuiddiskonrwd";
            $stmt6 = $db->prepare($sql6);
            $stmt6->execute(['uuiddiskonrwd' => $uuiddiskonrwd]);

            header('location:katalog_partner_detail.php?upr='.$uuidproduk.'&iv=Y');
        }       
    }
?>