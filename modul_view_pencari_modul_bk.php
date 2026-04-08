<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		$user = 'Login';
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
		session_start();
		session_unset();
		header('location:login');
	}

	$uuidruangankosan = $_GET['rk'];
	$fakultas_to = $_GET['fk'];

	if (!isset($_GET['rt'])) {
		$rating_form = 1;
	}
	else {
		echo "<script>alert('Silakan isi rating terlebih dahulu dalam ulasan');</script>";
	}

	if (isset($_POST["klik_$uuidruangankosan"]) AND isset($uuiduser)) {
		$sql9 = "SELECT count(1) jml_visitor FROM f_klik_pengunjung_log
		WHERE createdate::date =CURRENT_DATE AND userklik = '$uuiduser' AND uuidruangankosan = '$uuidruangankosan'";
		$hasil9 = $db->query($sql9);
		$baris9 = $hasil9->fetch(PDO::FETCH_ASSOC);

		if ($baris9['jml_visitor'] == 0) {
			$sql3 = "INSERT INTO f_klik_pengunjung_log(uuidruangankosan, ip_address, userklik, inc_klik) VALUES (:uuidruangankosan, :ip_address, :uuiduser, 1)";
			$stmt3 = $db->prepare($sql3);
			$stmt3->execute(['uuidruangankosan' => $uuidruangankosan, 'ip_address' => $ip_address, 'uuiduser' => $uuiduser]);

			$sql4 = "SELECT sum(inc_klik) jml_klik from f_klik_pengunjung_log where uuidruangankosan = '$uuidruangankosan'";
			$hasil4 = $db->query($sql4);
			$baris4 = $hasil4->fetch(PDO::FETCH_ASSOC);

			$jml_klik = $baris4['jml_klik'];
			
			$sql5 = "UPDATE d_ruangan_kosan set jml_klik = $jml_klik where uuidruangankosan = :uuidruangankosan";
			$stmt5 = $db->prepare($sql5);
			$stmt5->execute(['uuidruangankosan' => $uuidruangankosan]);
		}

		//KEPENTINGAN DISKON REWARD
		$sql4b = "SELECT COUNT(1) total_wishlist FROM f_favourite_pencari_kos WHERE uuiduserfav = '$uuiduser'";
		$hasil4b = $db->query($sql4b);
		$baris4b = $hasil4b->fetch(PDO::FETCH_ASSOC);
		if ($baris4b['total_wishlist'] == 5) {
			$kode_diskon = "ADD_5_WISHLIST";
			$nama_diskon = "Reward Berhasil Add 5 Wishlist Kosan";
			
			$sql4c = "SELECT COUNT(1) cek_diskon FROM d_diskon_reward WHERE uuiduser_reward= '$uuiduser' AND kode_diskon = '$kode_diskon'";
			$hasil4c = $db->query($sql4c);
			$baris4c = $hasil4c->fetch(PDO::FETCH_ASSOC);

			if ($baris4c['cek_diskon'] < 1) {
				$tgl_jatuh_tempo = date('Y-m-d', strtotime('+7 days'));
			    $disc_amount = 20000;
				
				$sql4d = "INSERT INTO d_diskon_reward(kode_diskon, nama_diskon, tgl_jatuh_tempo, disc_amount, uuiduser_reward) VALUES 
				(:kode_diskon, :nama_diskon, :tgl_jatuh_tempo, :disc_amount, :uuiduser)";
				$stmt4d = $db->prepare($sql4d);
				$stmt4d->execute(['kode_diskon' => $kode_diskon, 'nama_diskon' => $nama_diskon, 'tgl_jatuh_tempo' => $tgl_jatuh_tempo, 'disc_amount' => $disc_amount, 'uuiduser' => $uuiduser]);
			
				// Simpan JS sebagai string agar dipanggil di akhir
				$popupScript = "<script>window.onload = function() {
					showPopup('Hore!! dapat diskon Rp. ".number_format($disc_amount).", selengkapnya cek di menu Reward Diskon');
				};</script>";

				echo $popupScript;
			}
		}
	}
?>
<html lang="en">
<head>
	<title>Detail Ruangan Kosan</title>
	<style>
		.harga-box {
        background-color: #DCCEF9; /* Warna ungu kalem */
        border-radius: 8px; /* Sudut membulat */
        padding: 8px 12px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */
        font-size: 80%; /* Ukuran font */
        font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
		margin-bottom:2px
    }
	.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	.carousel-container {position: relative;width: 100%;max-width: 1000px;
    }

    .carousel-wrapper {overflow: hidden; }

    .carousel-track {display: flex;transition: transform 0.3s ease-in-out;gap: 20px;}
	    .card { flex: 0 0 auto;width: 320px;background: white;border-radius: 16px;box-shadow: 0 4px 8px rgba(0,0,0,0.1);text-align: center;padding: 10px;}

    .card img {width: 100%;border-radius: 12px;}

    .nav-btn {
      position: absolute;top: 50%;transform: translateY(-50%);background-color: #3b82f6;color: white; border: none; padding: 10px 14px;font-size: 24px;
      cursor: pointer; z-index: 10;border-radius: 50%;box-shadow: 0 2px 6px rgba(0,0,0,0.3);transition: background 0.2s;
    }

    .nav-btn:hover { background-color: #2563eb;}

    .nav-left {left: 10px;}

    .nav-right { right: 10px; }

    @media (max-width: 600px) {
      .card {
        width: 80vw;
      }
    }
	.map-container {
            position: relative;
            padding-bottom: 56.25%; /* Rasio 16:9 */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #eee;
        }
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
		.radio-group {
		display: flex; flex-wrap: wrap; gap: 1rem; /* Awalnya 2rem, sekarang lebih rapat */
		background: #fff; padding: 1rem 1.5rem; /* Diperkecil juga */
		border-radius: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); justify-content: start;
		}

		.radio-option {
		display: flex; flex-direction: column; align-items: center; cursor: pointer; transition: all 0.2s ease;
		width: 60px; /* Atur lebar agar tetap sejajar dan rapi */
		}

		.radio-option input[type="radio"] {
		appearance: none; width: 1rem; height: 1rem; border: 2px solid #717fe0; border-radius: 50%;
		outline: none; margin-bottom: 0.3rem; /* sedikit lebih rapat ke teks */
		transition: 0.2s ease;
		}

		.radio-option input[type="radio"]:checked {
		background-color: #717fe0; box-shadow: 0 0 0 3px rgba(113, 127, 224, 0.3);
		}

		.radio-option span {
		font-size: 10px; color: #333; text-align: center;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<!-- Header -->
	 <?php
		include('nav_top_pencari_kos.php');
	 ?>
	<!-- Cart -->
	<!-- <div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-02.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-03.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href='index_pencari_kos.php?hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>&fk=<?php echo $fakultas_to;?>'><button style="top: 10px; right: 10px; background-color: #717fe0; color: white;
            border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Kembali</button></a>
		</div>
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index_pencari_kos.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a class="stext-109 cl8 hov-cl1 trans-04">
				View Ruangan Kosan
			</a>
		</div>
	</div>

	<div style="display: flex; justify-content: center; padding: 1rem;">
		<form class="radio-group" method="GET" action="ruangan_kosan_view_pencari_kos.php">
			<input type="hidden" name="rk" value="<?php echo htmlspecialchars($uuidruangankosan); ?>">
			<input type="hidden" name="hd" value="<?php echo $_GET['hd'] ?? 0; ?>">
			<input type="hidden" name="hs" value="<?php echo $_GET['hs'] ?? 1000000000; ?>">
			<input type="hidden" name="js" value="<?php echo $_GET['js'] ?? ''; ?>">

			<?php
				$sqlf = "SELECT nama_fakultas, kode_fakultas from d_fakultas_upi";
				$hasilf = $db->query($sqlf);
				while($barisf = $hasilf->fetch(PDO::FETCH_ASSOC)) {
			?>
			<label class="radio-option">
				<input type="radio" name="fk" value="<?php echo $barisf['kode_fakultas'];?>" onchange="this.form.submit()" 
				<?php if ($fakultas_to  === $barisf['kode_fakultas']) echo 'checked'; ?>>
				<span>Dari <?php echo $barisf['kode_fakultas'];?></span>
			</label>
			<?php
				}
			?>
		</form>
	</div>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60" style="margin-top:-40px">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
					<div class="map-container">
							<?php
								$sql = "SELECT u.nama_lengkap, u.gender, k.alamat_kosan_lengkap, k.nama_kosan, rk.uuidruangankosan, rk.uuidkosan, rk.uuiduser, rk.nama_ruangan,
								rk.deskripsi, rk.harga, rk.jml_tersisa, rk.ukuran_ruangan, 
								rk.biaya_listrik, rk.biaya_wifi, rk.biaya_kebersihan, rk.jenis_sewa, k.tipe_kosan, rk.letak_kamar_mandi, rk.tipe_kloset, u.no_hp FROM d_ruangan_kosan rk
								LEFT JOIN d_kosan k on k.uuidkosan = rk.uuidkosan
								LEFT JOIN users u on rk.uuiduser = u.uuiduser
								where rk.uuidruangankosan = '$uuidruangankosan'
								";
								//$hasil = mysqli_query($koneksi, $sql);
								//$baris = mysqli_fetch_array($hasil);
								$hasil = $db->query($sql);
								$baris = $hasil->fetch(PDO::FETCH_ASSOC);

								$sql8 = "SELECT alamat FROM d_fakultas_Upi where kode_fakultas = '$fakultas_to'";
								$hasil8 = $db->query($sql8);
								$baris8 = $hasil8->fetch(PDO::FETCH_ASSOC);
								$to = $baris8['alamat'];

								$from = $baris['alamat_kosan_lengkap'];
								$from_encoded = urlencode($from);
								$to_encoded = urlencode($to);
								$maps_url = "https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d15841.614153417732!2d107.5930253!3d-6.8607789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m5!1s" . $from_encoded . "!2s" . $to_encoded . "!3m2!1d-6.8615468!2d107.5937623!4m5!1s" . $to_encoded . "!2s" . $from_encoded . "!3m2!1d-6.8691913!2d107.5974973!5e0!3m2!1sid!2sid!4v1712064000000";
							?>
							<iframe 
								src="<?php echo $maps_url; ?>"
								allowfullscreen="" 
								loading="lazy" 
								referrerpolicy="no-referrer-when-downgrade">
							</iframe>
						</div><br>
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<?php
									$sql2 = "SELECT filename from d_ruangan_kosan_gambar where uuidruangankosan = '$uuidruangankosan'";
									$hasil2 = $db->query($sql2);
									while ($baris2 = $hasil2->fetch(PDO::FETCH_ASSOC)) {
								?>
								<div class="item-slick3" data-thumb="uploads/<?php echo $baris2['filename'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/<?php echo $baris2['filename'];?>" alt="IMG-PRODUCT" style="height:270">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/<?php echo $baris2['filename'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
					
				<?php
					switch ($baris['jenis_sewa']) {
						case 1:
							$jenis_sewa = "Tahunan";
							$desc = "bulan";
							break;
						case 2:
							$jenis_sewa = "Bulanan";
							$desc = "bulan";
							break;
						case 3:
							$jenis_sewa = "Mingguan";
							$desc = "minggu";
							break;
						case 4:
							$jenis_sewa = "Harian";
							$desc = "hari";
							break;
					}

					switch ($baris['gender']) {
						case 'L':
							$caption_gender = "👨 Bapak ". $baris['nama_lengkap'];
							break;
						case 'P':
							$caption_gender = "👧 Ibu ". $baris['nama_lengkap'];
							break;
					}
				?>
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<?php
							if ($user != "Login") {
								$sql5 = "SELECT count(1) uuidruangankosan from f_favourite_pencari_kos where uuiduserfav = '$uuiduser' and uuidruangankosan = '$uuidruangankosan'";
								$hasil5 = $db->query($sql5);
								$baris5 = $hasil5->fetch(PDO::FETCH_ASSOC);

								if ($baris5['uuidruangankosan'] > 0) {
									echo "<button class='wishlist-btn active' data-ruangan='".$uuidruangankosan."'>";
									echo "<i class='fa-solid fa-heart' style='color:red; font-size:160%'></i>";
									echo "</button>";
								}
								else {
									echo "<button class='wishlist-btn inactive' data-ruangan='".$uuidruangankosan."'>";
									echo "<i class='fa-solid fa-heart' style='color:lightgray; font-size:160%'></i>";
									echo "</button>";								
								}
							}
						?>
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $baris['nama_ruangan']. ' | '. $baris['nama_kosan'].''?>
						</h4>
						<h6 class="mtext-56 cl2 js-name-detail p-b-14">
							<?php echo $baris['alamat_kosan_lengkap']; ?>
						</h6>
						<span class="harga-box" style="font-size:12">
                            <?php echo $caption_gender; ?>
                        </span>
						<hr style='background:black; margin-top:3%'></hr>
                        <span class="harga-box mt-3" style="font-size:12">
                            <?php echo '🏠 '. $baris['tipe_kosan']; ?>
                        </span>
                        <span class="harga-box" style="font-size:12">
                            <?php echo '🏢 '. number_format($baris['jml_tersisa']). " ruangan tersisa";?>
                        </span>
                        <span class="harga-box" style="font-size:12">
                             <?php echo "💰 Rp. ". number_format($baris['harga']);?>
                        </span>
                        <span class="harga-box" style="font-size:12">
                             <?php echo '📆 '. $jenis_sewa; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
							<?php echo '🚿 Kamar mandi di '. $baris['letak_kamar_mandi']; ?>
						</span>
						<span class="harga-box" style="font-size:12">
							<?php echo '🚽 Kloset '. $baris['tipe_kloset']; ?>
						</span>
						<span class="harga-box" style="font-size:12">
							<?php echo '🏠 Ukuran : '. $baris['ukuran_ruangan'].' meter'?>
						</span>

						<p class="stext-102 cl3 p-t-23">
							<?php echo $baris['deskripsi']; ?>
						</p><br>
                        <div class="d-flex flex-column gap-1">
                            <p class="mb-1">
                                ⚡ Listrik per <?php echo $desc;?> :
                                <b class="text-danger">Rp. <?php echo number_format($baris['biaya_listrik']); ?></b>
                            </p>
                            <p class="mb-1">
                                🌐 WiFi per <?php echo $desc;?> :
                                <b class="text-danger">Rp. <?php echo number_format($baris['biaya_wifi']); ?></b>
                            </p>
                            <p class="mb-1">
                                🧹 Kebersihan per <?php echo $desc;?> :
                                <b class="text-danger">Rp. <?php echo number_format($baris['biaya_kebersihan']); ?></b>
                            </p>
                        </div>
                        <div class="text-center mt-3">
                            <a href="https://wa.me/<?php echo $baris['no_hp'];?>" target="_blank" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                <i class="fab fa-whatsapp fa-lg"></i> Chat via WhatsApp
                            </a>
                        </div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<!-- <div class="flex-m bor9 p-r-10 m-r-11">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
									<i class="zmdi zmdi-favorite"></i>
								</a>
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a> -->
						</div>
					</div>
				</div>
			</div>

			<div class="p-b-7" style='margin-top:-7px'>
				<h3 class="ltext-103 cl5" style="font-size:20px">
					<?php
						$sql12 = "SELECT*FROM d_ruangan_kosan where uuidruangankosan = '$uuidruangankosan'";
						$hasil12 = $db->query($sql12);
						$baris12 = $hasil12->fetch(PDO::FETCH_ASSOC);
						$user_pemilik_kos = $baris12['uuiduser'];

						$sql11 = "SELECT*FROM d_gambar_promo where uuiduser = '$user_pemilik_kos'";
						$hasil11 = $db->query($sql11);
						$baris11 = $hasil11->fetch(PDO::FETCH_ASSOC);

						if (!isset($baris11['uuidgambarpromo'])) {
							$judul2 = '';
							$st_ada = 'N';
						}
						else {
							$st_ada = 'Y';
							$judul2 = 'Ada hal menarik apa lagi di Kosan Ini?';
						}

						echo $judul2;
					?>
				</h3><br>
				<?php
					if ($st_ada == 'Y' AND $baris12['uuiduser'] == $uuiduser) {
				?>
				
				<form method='POST' action='gambar_promo_edit.php?rk=<?php echo $uuidruangankosan;?>'>
					<!-- <button><img src='' height='320px' width='300px' style='border-radius:10px'/></button><br> -->
					<button>
						<div style="width: 300px; height: 200px; background: #f2f2f2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
						<img src="<?php echo $baris11['berkas'];?>"
							style="max-width: 100%; max-height: 100%; object-fit: contain;" />
						</div>
					</button>
				</form>
				<?php
					}
					else if ($st_ada == 'Y' AND $baris12['uuiduser'] !== $uuiduser){
				?>
						<div style="width: 300px; height: 200px; background: #f2f2f2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
						<img src="<?php echo $baris11['berkas'];?>"
							style="max-width: 100%; max-height: 100%; object-fit: contain;" />
						</div>				
				<?php
					}
				?>
				<!-- <img src='cth_usaha2.png' height='250px' width='400px' style='border-radius:10px'/> -->
			</div><br>

			<h3 class="ltext-103 cl5" style="font-size:20px">
				<?php
					$uuiduser_pemilik = $baris12['uuiduser'];
					$sql9 = "SELECT k.tipe_kosan, r.jml_tersisa, r.ukuran_ruangan, TO_CHAR(r.harga, 'L999G999G999') harga, r.jenis_sewa, k.nama_kosan, k.uuidkosan, r.nama_ruangan, r.uuidruangankosan from d_ruangan_kosan r 
					left join d_kosan k on k.uuidkosan = r.uuidkosan
					where k.st_active = 'Y' AND r.uuiduser = '$uuiduser_pemilik' AND uuidruangankosan <> '$uuidruangankosan'";
					$hasil9 = $db->query($sql9);

					$hasil9b = $db->query($sql9);
					$baris9b = $hasil9b->fetch(PDO::FETCH_ASSOC);
					if (!isset($baris9b['uuidruangankosan'])) {
						$judul = '';
					}
					else {
						$judul = 'Ruangan lain di kosan ini';
					}
					echo $judul;
				?>
				
			</h3><br>
			<div class="carousel-container">
				<button class="nav-btn nav-left" onclick="moveSlide(-1)">‹</button>
				<div class="carousel-wrapper">
					<div class="flex overflow-x-auto no-scrollbar gap-4" id="track">
						<?php
							while ($baris9 = $hasil9->fetch(PDO::FETCH_ASSOC)) {
								$uuidruangankosan_other = $baris9['uuidruangankosan'];
								$sql10 = "SELECT id_gambar, nama_gambar, filename, mimetype, berkas
								FROM public.d_ruangan_kosan_gambar where uuidruangankosan = '$uuidruangankosan_other' order by berkas desc limit 1";
								$hasil10 = $db->query($sql10);
								$baris10 = $hasil10->fetch(PDO::FETCH_ASSOC);

								switch ($baris9['jenis_sewa']) {
									case 1:
										$jenis_sewa = "Tahunan";
										$desc = "bulan";
										break;
									case 2:
										$jenis_sewa = "Bulanan";
										$desc = "bulan";
										break;
									case 3:
										$jenis_sewa = "Mingguan";
										$desc = "minggu";
										break;
									case 4:
										$jenis_sewa = "Harian";
										$desc = "hari";
										break;
								}
						?>
						<div class="card">
							<a href="ruangan_kosan_view_pencari_kos.php?rk=<?php echo $baris9['uuidruangankosan'];?>&fk=<?php echo $fakultas_to;?>&hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>">
							<img src="<?php echo $baris10['berkas'];?>" alt="IMG-PRODUCT" style="height:220px">
							</a><br>
							<a href="ruangan_kosan_view_pencari_kos.php?rk=<?php echo $baris9['uuidruangankosan'];?>&fk=<?php echo $fakultas_to;?>&hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<?php echo $baris9['nama_ruangan']. " | ". $baris9['nama_kosan']; ?>
							</a>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">💰 <?php echo $baris9['harga'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📅 <?php echo $jenis_sewa;?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏠 <?php echo $baris9['tipe_kosan'];?></span>
									<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">🛏️ <?php echo $baris9['jml_tersisa'];?> ruangan tersisa</span>
									<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">🏠 <?php echo $baris9['ukuran_ruangan'];?> meter</span>
								</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>

				<button class="nav-btn nav-right" onclick="moveSlide(1)">›</button>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<?php
						$sql6 = "SELECT count(au.uuiduserulas) jml_ulasan FROM ulasan_user au
						WHERE au.uuidruangankosan = '$uuidruangankosan'";
						$hasil6 = $db->query($sql6);
						$baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);
					?>
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link" role="tab">Ulasan (<?php echo $baris6['jml_ulasan'];?>)</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Weight
											</span>

											<span class="stext-102 cl6 size-206">
												0.79 kg
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>

											<span class="stext-102 cl6 size-206">
												110 x 33 x 100 cm
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Materials
											</span>

											<span class="stext-102 cl6 size-206">
												60% cotton
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>

											<span class="stext-102 cl6 size-206">
												Black, Blue, Grey, Green, Red, White
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>

											<span class="stext-102 cl6 size-206">
												XL, L, M, S
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- - -->
						<div id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<?php
											$sql7 = "SELECT TO_CHAR(au.createdate, 'DD-MON-YYYY HH24:MI') AS createdate, 
											au.uuiduserulas, 
											au.rating, 
											au.ulasan, 
											u.uname,
											au.uuidulasan
									 FROM ulasan_user au
									 LEFT JOIN users u ON u.uuiduser = au.uuiduserulas
									 WHERE au.uuidruangankosan = '$uuidruangankosan' order by createdate desc;
									 ";
											$hasil7 = $db->query($sql7);
											while ($baris7 = $hasil7->fetch(PDO::FETCH_ASSOC)) {
												$uuidulasan = $baris7['uuidulasan'];
										?>
											<div class="flex-w flex-t p-b-10">
												<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
													<img src="images/avatar-02.png" alt="AVATAR">
												</div>
												<div class="size-207">
													<div class="flex-w flex-sb-m p-b-17">
														<span class="mtext-107 cl2 p-r-20">
															<?php echo $baris7['uname']; ?>
														</span>
														<span class="fs-18 cl11">
															<?php
																$rating = $baris7['rating'];
																for ($i = 1; $i <= $rating; $i++) {
																	echo "<i class='zmdi zmdi-star'></i>";
																}
															?>
														</span>
													</div>
													<p class="stext-102 cl6" style="margin-top:-3%; color:black"><?php echo $baris7['createdate']; ?></p>
													<p class="stext-102 cl6">
														<?php echo $baris7['ulasan']; ?>
													</p>
													
													<!-- Jika sudah ada balasan -->
													<?php 
														$sql13 = "SELECT uuidulasan, balasan, TO_CHAR(createdate, 'DD-MON-YYYY') AS createdate from balasan_ulasan where uuidulasan = '$uuidulasan'";
														$hasil13 = $db->query($sql13);
														$baris13 = $hasil13->fetch(PDO::FETCH_ASSOC);
														if (isset($baris13['uuidulasan'])):
													?>
														<div class="bg-light p-3 rounded mt-3" style="border-left: 4px solid #888;">
															<p class="mtext-106 cl2" style="margin-bottom: 5px; font-size: 15px;">
																Balasan dari pemilik kos:
															</p>
															<p style='font-size:12px'><?php echo $baris13['createdate']; ?></p>
															<p class="stext-102 cl6" style="color: #444;">
																<?php echo $baris13['balasan']; ?>
															</p>
														</div>

													<!-- Jika belum ada balasan, tampilkan textarea -->
													<?php else: 
														if ($baris12['uuiduser'] == $uuiduser):
													?>
														<form method="POST" action="balasan_ulasan_insert.php" class="mt-3">
															<input type="hidden" name="uuidruangankosan" value="<?php echo $uuidruangankosan;?>">
															<input type="hidden" name="fk" value="<?php echo $fakultas_to;?>">
															<input type="hidden" name="uuidulasan" value="<?php echo $uuidulasan;?>">
															<input type="hidden" name="uuiduserbalas" value="<?php echo $uuiduser;?>">
															<label class="stext-102 cl6">Balas ulasan ini:</label>
															<textarea name="balasan" rows="3" class="form-control" required></textarea>
															<button type="submit" name="balas_ulasan" class="btn btn-sm btn-primary mt-2">Kirim Balasan</button>
														</form>
													<?php 
														endif;
													endif; 
													?>
												</div>
											</div>
											<hr style='background:silver'>
										<?php
											}
										?>
									
										
										<!-- Add review -->
										 <br>
										<form class="w-full" method="post" action="ulasan_user_buat.php" id="ratingForm">
											<h5 class="mtext-108 cl2 p-b-7">
												Berikan Ulasan
											</h5>

											<p class="stext-102 cl6">
												*Ulasan harus diberikan secara jujur
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input name="rating" class="dis-none" type="number" value="0"/>
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Ulasan</label>
													<input type='hidden' name='js' value='<?php echo $_GET['js'];?>'/>
													<input type='hidden' name='hd' value='<?php echo $_GET['hd'];?>'/>
													<input type='hidden' name='hs' value='<?php echo $_GET['hs'];?>'/>
													<input type='hidden' name='uuidruangankosanform' value='<?php echo $uuidruangankosan;?>'/>
													<input type='hidden' name='kode_fakultas_to' value='<?php echo $fakultas_to;?>'/>
													<textarea name="ulasan" class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" required></textarea>
												</div>
											</div>

											<button name="ulas" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Kirim Ulasan
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				SKU: JAK-01
			</span>

			<span class="stext-107 cl6 p-lr-25">
				Categories: Jacket, Men
			</span>
		</div> -->
	</section>
		

	<!-- Footer -->
	<?php
		include('footer.php');
	?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<div id="popup" class="fixed inset-0 bg-black bg-opacity-10 flex items-center justify-center z-50 hidden">
  		<div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-lg text-center animate-fade-in">
			<h2 id="popup-message" class="text-lg font-semibold mb-4 text-gray-800">Pesan Diskon</h2>
			<button onclick="closePopup()" 
					class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
			Tutup
			</button>
		</div>
	</div>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
        document.addEventListener('DOMContentLoaded', async function() {
			function showSwalMessage(title, text, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-center'
            });
        }
            let uuiduserfav = "<?php echo $uuiduser; ?>"; // Ambil dari sesi user

            async function updateWishlistCount() {
                let response = await fetch('wishlist_count.php?uuiduserfav=' + uuiduserfav);
                let result = await response.json();
                //document.getElementById('wishlist-count').textContent = result.count || 0;
				document.querySelectorAll('.wishlist-count').forEach(el => {
					el.textContent = result.count || 0;
				});
            }

			async function toggleWishlist(button) {
				let uuidruangankosan = button.dataset.ruangan;
				let isAdding = button.classList.contains('inactive');

				let response = await fetch('wishlist_handler.php', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({ uuiduserfav, uuidruangankosan, action: isAdding ? 'add' : 'remove' })
				});

				let result = await response.json();
				if (result.status === 'success') {
					button.classList.toggle('active', isAdding);
					button.classList.toggle('inactive', !isAdding);
					button.innerHTML = isAdding
						? '<i class="fa-solid fa-heart" style="color: red; font-size:160%"></i>'
						: '<i class="fa-solid fa-heart" style="color: lightgray; font-size:160%"></i>';

					showSwalMessage(
						isAdding ? "Berhasil Ditambahkan!" : "Berhasil Dihapus!",
						isAdding ? "Kosan telah masuk wishlist Anda." : "Kosan telah dihapus dari wishlist.",
						"success"
					);

					updateWishlistCount();

					// ⏳ Refresh halaman setelah 1.6 detik
					setTimeout(() => {
						location.reload();
					}, 700);
				} else {
					showSwalMessage("Terjadi Kesalahan!", result.message, "error");
				}
			}
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', () => toggleWishlist(button));
            });

            updateWishlistCount();
        });
    </script>
	<script>
	const track = document.getElementById("track");
	const btnLeft = document.querySelector(".nav-left");
	const btnRight = document.querySelector(".nav-right");
	let scrollAmount = 0;

	function getCardWidth() {
		const card = track.querySelector(".card");
		if (!card) return 0;
		const style = getComputedStyle(track);
		const gap = parseInt(style.columnGap || style.gap || 0);
		return card.offsetWidth + gap;
	}

	function updateNavVisibility() {
		const cardCount = track.querySelectorAll(".card").length;
		const maxVisible = 3;

		if (cardCount <= maxVisible) {
		btnLeft.style.display = "none";
		btnRight.style.display = "none";
		} else {
		btnLeft.style.display = "block";
		btnRight.style.display = "block";
		}
	}

	function moveSlide(direction) {
	const cardWidth = getCardWidth();
	track.scrollBy({
		left: direction * cardWidth,
		behavior: 'smooth'
	});
	}

	window.addEventListener("load", updateNavVisibility);
	window.addEventListener("resize", () => {
		scrollAmount = 0;
		track.style.transform = "translateX(0)";
		updateNavVisibility();
	});
	</script>
	<script>
		function showPopup(message) {
		document.getElementById("popup-message").textContent = message;
		document.getElementById("popup").classList.remove("hidden");
		}
		function closePopup() {
		document.getElementById("popup").classList.add("hidden");
		}
	</script>
</body>
</html>