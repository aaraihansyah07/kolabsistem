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
		$st_penjual = $_SESSION['st_penjual'];
	}
	include('koneksi.php');

    if (!isset($_SESSION['uname']) or $st_penjual == 'Y') {
		header('location:login.php');
	}

	$uuidmodul = $_GET['md'];
	$fakultas_to = $_GET['fk'];

	if (!isset($_GET['rt'])) {
		$rating_form = 1;
	}
	else {
		echo "<script>alert('Silakan isi rating terlebih dahulu dalam ulasan');</script>";
	}

	if (isset($_POST["klik_$uuidmodul"]) AND isset($uuiduser)) {
		$sql9 = "SELECT count(1) jml_visitor FROM f_klik_pengunjung_log
		WHERE createdate::date =CURRENT_DATE AND userklik = '$uuiduser' AND uuidmodul = '$uuidmodul'";
		$hasil9 = $db->query($sql9);
		$baris9 = $hasil9->fetch(PDO::FETCH_ASSOC);

		if ($baris9['jml_visitor'] == 0) {
			$sql3 = "INSERT INTO f_klik_pengunjung_log(uuidmodul, ip_address, userklik, inc_klik) VALUES (:uuidmodul, :ip_address, :uuiduser, 1)";
			$stmt3 = $db->prepare($sql3);
			$stmt3->execute(['uuidmodul' => $uuidmodul, 'ip_address' => $ip_address, 'uuiduser' => $uuiduser]);

			$sql4 = "SELECT sum(inc_klik) jml_klik from f_klik_pengunjung_log where uuidmodul = '$uuidmodul'";
			$hasil4 = $db->query($sql4);
			$baris4 = $hasil4->fetch(PDO::FETCH_ASSOC);

			$jml_klik = $baris4['jml_klik'];
			
			$sql5 = "UPDATE d_modul set jml_klik = $jml_klik where uuidmodul = :uuidmodul";
			$stmt5 = $db->prepare($sql5);
			$stmt5->execute(['uuidmodul' => $uuidmodul]);
		}

		//KEPENTINGAN DISKON REWARD
		$sql4b = "SELECT COUNT(1) total_wishlist FROM f_favourite_pencari_modul WHERE uuiduserfav = '$uuiduser'";
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
	<title>Detail Perangkat Ajar</title>
	<style>
		.harga-box {
        background-color: #DCCEF9; /* Warna ungu kalem */
        border-radius: 8px; /* Sudut membulat */
        padding: 8px 12px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */
        font-size: 16px; /* Ukuran font */
        font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
		margin-bottom:2%
    }
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
.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}	.notif-ulasan-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
    .notif-wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}	
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

	.pdf-page {position: relative; margin-bottom: 20px;}
 	.pdf-overlay {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); /* lapisan putih semi transparan */
    display: flex; justify-content: center; align-items: center; text-align: center; font-size: 1.2rem; font-weight: bold; color: #b91c1c; /* merah */ padding: 10px;
	}

	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js"></script>
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
	<script src="https://cdn.tailwindcss.com"></script>
<!--===============================================================================================-->
</head>
<body>
	<!-- Header -->
	 <?php
		include('nav_top_pencari_kos.php');
	 ?>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
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
	</div>

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href='index_pencari_modul.php?hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>&fk=<?php echo $fakultas_to;?>'><button style="top: 10px; right: 10px; background-color: #717fe0; color: white;
            border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Kembali</button></a>
		</div>
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php?hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>&fk=<?php echo $fakultas_to;?>" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a class="stext-109 cl8 hov-cl1 trans-04">
				View Perangkat Ajar
			</a>
		</div>
	</div>
	
	<div style="display: flex; justify-content: center; padding: 1rem;">
		<form class="radio-group" method="GET" action="modul_view_pencari_modul.php">
			<input type="hidden" name="rk" value="<?php echo htmlspecialchars($uuidmodul); ?>">
			<input type="hidden" name="hd" value="<?php echo $_GET['hd'] ?? 0; ?>">
			<input type="hidden" name="hs" value="<?php echo $_GET['hs'] ?? 1000000000; ?>">
			<input type="hidden" name="js" value="<?php echo $_GET['js'] ?? ''; ?>">
		</form>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-5 p-b-60" style="margin-top:-1%">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<?php
							$sql = "SELECT m.uuidmodul, m.id_jenjang, m.harga, j.nama_jenis, u.gender, u.fname, m.thumbnail_filename, m.filename,
							m.uuiduser, m.nama_modul, m.keterangan, j.nama_jenis, mp.nama_mapel, k.nama_jenjang||' kelas '||kelas nama_jenjang,
							p.nama_perangkat_ajar, m.thumbnail_filename2, m.thumbnail_filename3, m.thumbnail_filename4, m.thumbnail_filename5
							from d_modul m
							left join user_pengguna u on u.uuiduser = m.uuiduser
							left join d_jenis_modul j on j.id_jenis = m.id_jenis_modul
							left join d_mata_pelajaran mp on mp.id_mapel = m.id_mapel
							left join d_jenjang_pendidikan k on k.id_jenjang = m.id_jenjang
							left join d_perangkat_ajar p on p.id_perangkat_ajar = m.id_perangkat_ajar
							where m.uuidmodul = '$uuidmodul'
							";
							//$hasil = mysqli_query($koneksi, $sql);
							//$baris = mysqli_fetch_array($hasil);
							$hasil = $db->query($sql);
							$baris = $hasil->fetch(PDO::FETCH_ASSOC);
						?>
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/thumbnail/<?php echo $baris['thumbnail_filename'];?>" alt="IMG-PRODUCT" style="height:270px">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/thumbnail/<?php echo $baris['thumbnail_filename'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<?php 
									if ($baris['thumbnail_filename2'] !== null) {
								?>
								<div class="item-slick3" data-thumb="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename2'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/thumbnail/<?php echo $baris['thumbnail_filename2'];?>" alt="IMG-PRODUCT" style="height:270px">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/thumbnail/<?php echo $baris['thumbnail_filename2'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								<?php
									}
								?>

								<?php 
									if ($baris['thumbnail_filename3'] !== null) {
								?>
								<div class="item-slick3" data-thumb="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename3'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/thumbnail/<?php echo $baris['thumbnail_filename3'];?>" alt="IMG-PRODUCT" style="height:270px">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/thumbnail/<?php echo $baris['thumbnail_filename3'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								<?php
									}
								?>

								<?php 
									if ($baris['thumbnail_filename4'] !== null) {
								?>
								<div class="item-slick3" data-thumb="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename4'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/thumbnail/<?php echo $baris['thumbnail_filename4'];?>" alt="IMG-PRODUCT" style="height:270px">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/thumbnail/<?php echo $baris['thumbnail_filename4'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								<?php
									}
								?>

								<?php 
									if ($baris['thumbnail_filename5'] !== null) {
								?>
								<div class="item-slick3" data-thumb="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename5'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/thumbnail/<?php echo $baris['thumbnail_filename5'];?>" alt="IMG-PRODUCT" style="height:270px">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/thumbnail/<?php echo $baris['thumbnail_filename5'];?>">
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
					switch ($baris['gender']) {
						case 'L':
							$caption_gender = "👨 Oleh : Mr. ". $baris['fname'];
							break;
						case 'P':
							$caption_gender = "👧 Oleh : Mrs. ". $baris['fname'];
							break;
					}
				?>
				<div class="col-md-6 col-lg-5 p-b-30">
					<?php
						$sql2 = "SELECT uuiduser FROM d_modul WHERE uuidmodul = '$uuidmodul'";
						$hasil2 = $db->query($sql);
						$baris2 = $hasil2->fetch(PDO::FETCH_ASSOC);

						if ($baris2['uuiduser'] == $uuiduser) {
					?>
					<div class="size-204 flex-w flex-m respon6-next">
						<form action='modul_edit.php?rk=<?php echo $uuidmodul;?>&st=N' method='POST' style="margin-right: 3%;">
							<input type='hidden' name='to_detail' value='<?php echo $uuidmodul;?>'/>
							<button name="edit" style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">✏️ Update</button>								
						</form>
						<form action='modul_hapus.php?rk=<?php echo $uuidmodul;?>' 
							method='POST' 
							style="margin-right: 3%;"
							onsubmit="return confirm('Apakah Anda yakin ingin menghapus perangkat ajar ini? Pencari perangkat ajar tidak akan lagi bisa melihat perangkat ajar ini');">
							<button name="hapus" 
									style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">
								🗑️ Hapus
							</button>
						</form>
					</div>
					<?php
						}
						if ($user != "Login") {
							$sql5 = "SELECT count(1) uuidmodul from f_favourite_pencari_modul where uuiduserfav = '$uuiduser' and uuidmodul = '$uuidmodul'";
							$hasil5 = $db->query($sql5);
							$baris5 = $hasil5->fetch(PDO::FETCH_ASSOC);

							if ($baris5['uuidmodul'] > 0) {
								echo "<button class='wishlist-btn active' data-ruangan='".$uuidmodul."'>";
								echo "<i class='fa-solid fa-heart' style='color:red; font-size:160%'></i>";
								echo "</button>";
							}
							else {
								echo "<button class='wishlist-btn inactive' data-ruangan='".$uuidmodul."'>";
								echo "<i class='fa-solid fa-heart' style='color:lightgray; font-size:160%'></i>";
								echo "</button>";								
							}
						}
					?>
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $baris['nama_modul'];?>
						</h4>
						<span class="harga-box" style="font-size:12">
                            <?php echo $caption_gender; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            📒 <?php echo $baris['nama_jenis']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            📘 <?php echo $baris['nama_perangkat_ajar']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            <?php echo "💰 Rp. ". number_format($baris['harga']); ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            📚 <?php echo $baris['nama_mapel']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            🏫 <?php echo $baris['nama_jenjang']; ?>
                        </span>
						<hr style='background:black; margin-top:3%' ></hr>
						<p class="stext-102 cl3 p-t-23">
							Total halaman &nbsp: <a id="jml_halaman" data-pages=""></a> halaman<br>
							<?php echo $baris['keterangan']; ?>
						</p><br>
					</div>
				</div>
				<div class="w-full bg-white p-6 rounded-xl shadow-md" style="margin-top:-2%">
					<h2 class="text-xl font-semibold mb-4">Preview :</h2>

					<!-- Input file -->
					<input 
					type="hidden" 
					name="filename"
					accept="application/pdf" 
					id="pdfInput" 
					class="block w-full text-sm text-gray-500 
							file:mr-4 file:py-2 file:px-4
							file:rounded-lg file:border-0
							file:text-sm file:font-semibold
							file:bg-blue-50 file:text-blue-700
							hover:file:bg-blue-100
							cursor-pointer"
					/>

					<!-- Preview area -->
					<div id="preview" class="mt-4 border rounded-lg overflow-y-auto h-[600px] bg-gray-100 p-2 space-y-4">
					<span class="text-gray-400">Preview PDF akan muncul di sini</span>
					</div>
				</div>
			</div><br><br>
			<?php
				if ($uuiduser !== $baris['uuiduser']) {
			?>
			<div class="text-center">
				<form action="#">
					<button class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2 p-3">
						📦 Beli Perangkat Ajar Ini
					</button>
				</form>
			</div>
			<?php
				}
			?>
			<div class="p-b-7" style='margin-top:-7px'>
				<h3 class="ltext-103 cl5" style="font-size:20px">
					<?php
						$sql12 = "SELECT*FROM d_modul where uuidmodul = '$uuidmodul'";
						$hasil12 = $db->query($sql12);
						$baris12 = $hasil12->fetch(PDO::FETCH_ASSOC);
						$user_pemilik_modul = $baris12['uuiduser'];
					?>
				</h3><br>
			</div><br>
			
			<h3 class="ltext-103 cl5" style="font-size:20px; margin-top:-3%">
				<?php
					$uuiduser_pemilik = $baris12['uuiduser'];
					$sql9 = "SELECT m.nama_modul, m.keterangan, m.uuidmodul, u.fname, m.thumbnail_filename,
					TO_CHAR(m.harga, 'L999G999G999') harga, m.jml_klik, j.nama_jenis, mp.nama_mapel, k.nama_jenjang, p.nama_perangkat_ajar, k.kelas
					from d_modul m 
					left join user_pengguna u on u.uuiduser = m.uuiduser
					left join d_jenis_modul j on j.id_jenis = m.id_jenis_modul
					left join d_mata_pelajaran mp on mp.id_mapel = m.id_mapel
					left join d_jenjang_pendidikan k on k.id_jenjang = m.id_jenjang
					left join d_perangkat_ajar p on p.id_perangkat_ajar = m.id_perangkat_ajar
					where u.st_active = 'Y' AND m.uuiduser = '$uuiduser_pemilik' AND m.uuidmodul <> '$uuidmodul'";
					$hasil9 = $db->query($sql9);

					$hasil9b = $db->query($sql9);
					$baris9b = $hasil9b->fetch(PDO::FETCH_ASSOC);
					if (!isset($baris9b['uuidmodul'])) {
						$judul = '';
					}
					else {
						$judul = 'Perangkat Ajar Lain';
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
								$uuidmodul_other = $baris9['uuidmodul'];
						?>
						<div class="card">
							<a href="modul_view.php?rk=<?php echo $baris9['uuidmodul'];?>&hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>">
							<img src="uploads/thumbnail/<?php echo $baris9['thumbnail_filename'];?>" alt="IMG-PRODUCT" style="height:220px">
							</a><br>
							
							<a href="modul_view.php?rk=<?php echo $baris9['uuidmodul'];?>&hd=<?php echo $_GET['hd'];?>&hs=<?php echo $_GET['hs'];?>&js=<?php echo $_GET['js'];?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<?php echo $baris9['nama_modul']; ?>
							</a>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">💰 <?php echo $baris9['harga'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📘 <?php echo $baris9['nama_perangkat_ajar']. ' | '. $baris9['nama_jenis'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏫 <?php echo $baris9['nama_jenjang']." Kelas ".$baris9['kelas'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📚 <?php echo $baris['nama_mapel'];?></span>
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
						WHERE au.uuidmodul = '$uuidmodul'";
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
											u.email,
											au.uuidulasan
									 FROM ulasan_user au
									 LEFT JOIN user_pengguna u ON u.uuiduser = au.uuiduserulas
									 WHERE au.uuidmodul = '$uuidmodul' order by createdate desc;
									 ";
											$hasil7 = $db->query($sql7);
											while ($baris7 = $hasil7->fetch(PDO::FETCH_ASSOC)) {
												$uuidulasan = $baris7['uuidulasan'];
										?>
										<?php
											$editing = isset($_POST['edit_uuidulasan']) && $_POST['edit_uuidulasan'] == $uuidulasan;
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
		<p class="stext-102 cl6"><?php echo $baris7['ulasan']; ?></p>

		<?php 
			$sql13 = "SELECT uuidbalasan, uuidulasan, balasan, TO_CHAR(createdate, 'DD-MON-YYYY') AS createdate from balasan_ulasan where uuidulasan = '$uuidulasan'";
			$hasil13 = $db->query($sql13);
			$baris13 = $hasil13->fetch(PDO::FETCH_ASSOC);

			if (isset($baris13['uuidulasan'])):
		?>

		<!-- Tampilkan balasan -->
		<div class="bg-light p-3 rounded mt-3" style="border-left: 4px solid #888;">
			<p class="mtext-106 cl2" style="margin-bottom: 5px; font-size: 15px;">
				Balasan dari pemilik kos:
			</p>
			<p style='font-size:12px'><?php echo $baris13['createdate']; ?></p>
			<p class="stext-102 cl6" style="color: #444;"><?php echo $baris13['balasan']; ?></p>

			<!-- Jika yang login adalah pemilik kos terkait, tampilkan tombol edit -->
			<?php if ($baris12['uuiduser'] == $uuiduser): ?>
				<form method="POST" style="display:inline">
					<input type="hidden" name="edit_uuidulasan" value="<?php echo $uuidulasan; ?>">
					<button type="submit" class="btn btn-sm btn-warning mt-2">Edit Balasan</button>
				</form>
			<?php endif; ?>
		</div>

		<!-- Jika sedang dalam mode edit, tampilkan textarea -->
		<?php if ($editing): ?>
			<form method="POST" action="balasan_ulasan_edit.php" class="mt-3">
				<input type="hidden" name="uuidbalasan" value="<?php echo $baris13['uuidbalasan']; ?>">
				<input type="hidden" name="uuidmodul" value="<?php echo $uuidmodul; ?>">
				<input type="hidden" name="uuiduserbalas" value="<?php echo $uuiduser; ?>">
				<label class="stext-102 cl6">Edit balasan Anda:</label>
				<textarea name="balasan" rows="3" class="form-control" required><?php echo $baris13['balasan']; ?></textarea>
				<button type="submit" name="edit_balas_ulasan" class="btn btn-sm btn-primary mt-2">Edit Balasan</button>
			</form>
		<?php endif; ?>

		<?php else: 
			if ($baris12['uuiduser'] == $uuiduser):
		?>
			<!-- Belum ada balasan, tampilkan form balasan -->
			<form method="POST" action="balasan_ulasan_insert.php" class="mt-3">
				<input type="hidden" name="uuidmodul" value="<?php echo $uuidmodul; ?>">
				<input type="hidden" name="uuidulasan" value="<?php echo $uuidulasan; ?>">
				<input type="hidden" name="uuiduserbalas" value="<?php echo $uuiduser; ?>">
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
				let uuidmodul = button.dataset.ruangan;
				let isAdding = button.classList.contains('inactive');

				let response = await fetch('wishlist_handler.php', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({ uuiduserfav, uuidmodul, action: isAdding ? 'add' : 'remove' })
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
						isAdding ? "Perangkat Ajar ini telah masuk wishlist Anda." : "Perangkat Ajar ini telah dihapus dari wishlist.",
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
  const pdfInput = document.getElementById("pdfInput");
  const preview = document.getElementById("preview");

  function renderPDF(url) {
    fetch(url)
      .then(res => res.arrayBuffer())
      .then(data => {
        const typedarray = new Uint8Array(data);

        pdfjsLib.getDocument(typedarray).promise.then(pdf => {
          preview.innerHTML = ""; 
          const totalPages = pdf.numPages;
          const limit = Math.ceil(totalPages * 0.2); // 20% halaman terlihat jelas

          for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
            pdf.getPage(pageNum).then(page => {
              const scale = 1.2;
              const viewport = page.getViewport({ scale });

              // container per halaman
              const pageWrapper = document.createElement("div");
              pageWrapper.classList.add("pdf-page");

              const canvas = document.createElement("canvas");
              const context = canvas.getContext("2d");

              canvas.style.width = "100%"; 
              canvas.height = viewport.height;
              canvas.width = viewport.width;

              pageWrapper.appendChild(canvas);
              preview.appendChild(pageWrapper);

              const renderContext = {
                canvasContext: context,
                viewport: viewport
              };
              page.render(renderContext);

              // kalau halaman di luar 20%, kasih blur + overlay
              if (pageNum > limit) {
                canvas.style.filter = "blur(5px)";
                canvas.style.opacity = "0.5"; 

                const overlay = document.createElement("div");
                overlay.classList.add("pdf-overlay");
                overlay.innerText = "Beli perangkat ajar ini supaya dapat melihat semua halaman";
                pageWrapper.appendChild(overlay);
              }
            });
          }
        });
      });
  }

  pdfInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file && file.type === "application/pdf") {
      const fileReader = new FileReader();
      fileReader.onload = function() {
        renderPDF(fileReader.result);
      };
      fileReader.readAsArrayBuffer(file);
    } else {
      preview.innerHTML = "<p class='text-red-500'>File bukan PDF!</p>";
    }
  });

  // load default file
  renderPDF("<?php echo 'uploads/modul/'. $baris['filename'];?>");
</script>
<script>
  const fileUrl = "<?php echo 'uploads/modul/'. $baris['filename'];?>";

  pdfjsLib.getDocument(fileUrl).promise.then(pdf => {
    const totalPages = pdf.numPages;

    // simpan ke atribut data-pages
    const link = document.getElementById("jml_halaman");
    link.dataset.pages = totalPages;

    // opsional: tampilkan juga di teks link
    link.textContent = totalPages;
  });
</script>


</body>
</html>