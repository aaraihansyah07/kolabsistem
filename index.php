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

	// if (!isset($_SESSION['uname'])) {
	// 	header('location:index.php');
	// }

	// $sqlz = "SELECT
	// CURRENT_DATE AS hari_ini,tgl_jatuh_tempo_bayar::date AS target_tanggal,
	// tgl_jatuh_tempo_bayar::date - CURRENT_DATE AS selisih_hari,
	// TO_CHAR(tgl_jatuh_tempo_bayar, 'DD FMMonth YYYY') || ' pukul ' || 
  	// TO_CHAR(tgl_jatuh_tempo_bayar, 'HH24:MI') AS tampil_tanggal_jatuh_tempo
	// FROM user_pengguna where uuiduser = '$uuiduser'";
	// $hasilz = $db->query($sqlz);
	// $barisz = $hasilz->fetch(PDO::FETCH_ASSOC);
	// $selisih_hari = $barisz['selisih_hari'];
	// $tampil_tanggal_jatuh_tempo = $barisz['tampil_tanggal_jatuh_tempo'];

	// if ($selisih_hari == 1 or $selisih_hari == 2 or $selisih_hari == 3) {
	// 	$popupScript = "<script>window.onload = function() {
	// 		showPopupReminder();
	// 	}
	// 	</script>";

	// 	echo $popupScript;
	// }


?>
<html lang="en">
<head>
	<title>Home</title>
	<style>
	#home_mobile {background:#4052cb}
	#nav_home {color:#717fe0}
	.harga-box {background-color: #DCCEF9; /* Warna ungu kalem */border-radius: 8px; /* Sudut membulat */padding: 6px 8px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */font-size: 65%; /* Ukuran font */font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
	}
	.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	.notif-ulasan-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
    .notif-wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
		include('nav_top_pemilik_kos.php');
	 ?>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Wishlist Modul
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php
					
					?>
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
							Check Outssss
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Wishlist Modul
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
				<?php
					$sql7 = "SELECT DISTINCT(fav.uuidporto), filename, nama_porto
				FROM f_favourite_pencari_porto fav 
				LEFT JOIN d_portofolio m on m.uuidporto = fav.uuidporto
				LEFT JOIN user_pengguna u ON u.uuiduser = fav.uuiduserfav
				where fav.uuiduserfav = '$uuiduser'
				ORDER BY fav.uuidporto, m.filename DESC";
					$hasil7 = $db->query($sql7);
					while ($baris7 = $hasil7->fetch(PDO::FETCH_ASSOC)) {
					
				?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="<?php echo $baris7['filename'];?>" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?php echo $baris7['nama_porto'];?>
							</a>

							<span class="header-cart-item-info">
								<?php echo $baris7['harga'];?>
							</span>
						</div>
					</li>
				<?php
					}
				?>
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
							Check Outsss
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="section-slide">
		<br><br>
		<div class="px-4 md:px-8">
  				<div class="relative w-full max-w-[600px] aspect-[16/9] overflow-hidden shadow-lg rounded-lg mx-auto">
				<div id="slider" class="flex transition-transform duration-500 ease-in-out h-full">
					<?php
						$sql7b = "SELECT id_promosi, filename FROM d_promosi_mahasiswa";
						$hasil7b = $db->query($sql7b);
						while ($baris7b = $hasil7b->fetch(PDO::FETCH_ASSOC)) {
							echo "<div class='flex-shrink-0 w-full h-full'>
							<img src='uploads/promosi/".$baris7b['filename']."' class='w-full h-full object-cover' alt='Slide 1'>
							</div>";
						}
					?>

					<!-- <div class="flex-shrink-0 w-full h-full">
						<img src="uploads/banner_premium/promo_opening.png" class="w-full h-full object-cover" alt="Slide 1">
					</div>
					<div class="flex-shrink-0 w-full h-full">
						<img src="uploads/banner_premium/banner2.png" class="w-full h-full object-cover" alt="Slide 2">
					</div> -->
					<!-- <div class="flex-shrink-0 w-full h-full">
						<img src="https://picsum.photos/id/1016/800/450" class="w-full h-full object-cover" alt="Slide 2">
					</div> -->
				</div>

				<!-- Navigasi -->
				<div class="absolute inset-0 flex justify-between items-center px-3">
				<button onclick="prevSlide()" class="bg-black bg-opacity-40 text-white p-2 rounded-full hover:bg-opacity-60">
					&#10094;
				</button>
				<button onclick="nextSlide()" class="bg-black bg-opacity-40 text-white p-2 rounded-full hover:bg-opacity-60">
					&#10095;
				</button>
				</div>
			</div>
		</div>
	</section><br>


	<!-- Banner -->
	<!-- <div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w">
						<img src="images/banner-01.jpg" alt="IMG-BANNER">

						<a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Women
								</span>

								<span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w">
						<img src="images/banner-02.jpg" alt="IMG-BANNER">

						<a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Men
								</span>

								<span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w">
						<img src="images/banner-03.jpg" alt="IMG-BANNER">

						<a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Accessories
								</span>

								<span class="block1-info stext-102 trans-04">
									New Trend
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div> -->


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Portofolio Keren Mahasiswa
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Cari portofolio berdasarkan kata kunci
					</div>
				</div>
				
				<?php
				
				
				if (!isset($_GET['fk'])) {
					$jenis_porto_filter = '';
					$univ_filter = '';
				}
				else {
					$jenis_porto_filter = $_GET['fk'];
					$univ_filter = $_GET['uv'];
				}

				$nama_porto_cari = "";
				//$jenjang_filter = "";
				// $jenis_sewa_filter  = "";
				// $harga_dari = 0;
				// $harga_sampai = 100000000;
				// $kode_fakultas_filter = 'FPMIPA';
				
				if (isset($_POST['cari_porto'])) {
					$nama_porto_cari = "";
					$jenis_porto_filter  = "";
					$univ_filter = "";
					$nama_porto_cari = $_POST['nama_porto'];
				}

				if (isset($_POST['cari_porto_filter'])) {
					//$harga_dari = $_POST['harga_dari'];
					//$harga_sampai = $_POST['harga_sampai'];
					$jenis_porto_filter = $_POST['jenis_porto_filter'];
					$univ_filter = $_POST['univ_filter'];
					$nama_porto_cari = "";
				}
				?>
				<!-- Berdasarkan Nama -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<form method="post" action="#">
					<div class="bor8 dis-flex p-l-15">
							<input class="mtext-107 cl2 size-114 plh2 p-r-15" value="<?php echo $nama_porto_cari;?>" type="text" name="nama_porto" placeholder="Search">
							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" name="cari_porto">
								<i class="zmdi zmdi-search"></i>
							</button>
							<!-- <div class="p-t-18">
								<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Subscribe
								</button>
							</div> -->
					</div>	
					</form>
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<form method="POST" action="#" style="width: 100%; margin: 0 auto; background-color: #f0f0f0; padding: 20px; border-radius: 8px;">
						<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 7px;">
							
							<!-- Universitas -->
							<div style="flex: 1 1 250px;">
								<label for="univ_filter" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">
									Universitas
								</label>
								<select name="univ_filter" id="univ_filter"
									style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									
									<option value="" <?= ($univ_filter == '') ? 'selected' : '' ?>>All</option>  
									<?php
										$sql2x = "SELECT * FROM d_univ";
										$hasil2x = $db->query($sql2x);
										while ($baris2x = $hasil2x->fetch(PDO::FETCH_ASSOC)) {
											$kode_univ = $baris2x['kode_univ'];
											$nama_univ = $baris2x['nama_univ'];
									?>  
										<option value="<?= $kode_univ; ?>" <?= ($kode_univ == $univ_filter) ? 'selected' : '' ?>>
											<?= $nama_univ; ?>
										</option>
									<?php } ?>
								</select>
							</div>

							<!-- Kategori -->
							<div style="flex: 1 1 250px;">
								<label for="jenis_porto_filter" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">
									Kategori
								</label>
								<select name="jenis_porto_filter" id="jenis_porto_filter"
									style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									
									<option value="" <?= ($jenis_porto_filter == '') ? 'selected' : '' ?>>All</option>  
									<?php
										$sql2 = "SELECT * FROM d_kategori_portofolio";
										$hasil2 = $db->query($sql2);
										while ($baris2 = $hasil2->fetch(PDO::FETCH_ASSOC)) {
											$id_kat_porto = $baris2['id_kat_porto'];
											$nama_kategori_porto = $baris2['nama_kategori_porto'];
									?>  
										<option value="<?= $id_kat_porto; ?>" <?= ($id_kat_porto == $jenis_porto_filter) ? 'selected' : '' ?>>
											<?= $nama_kategori_porto; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>

						<!-- Tombol Pencarian -->
						<button name="cari_porto_filter" type="submit" 
						style="width: 100%; padding: 10px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
						<i class="fa-solid fa-search"></i> Cari Portofolio
						</button>
					</form>
				</div>
			</div>
                    
			<div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
				<?php
				//$jenis_modul_filter = (string) $jenis_modul_filter;
				if ($jenis_porto_filter == '') {
					$jenis_porto_filter2 = 'm.id_kat_porto is not null';
				}
				else {
					$jenis_porto_filter2 = 'm.id_kat_porto = '. $jenis_porto_filter;
				}

				// if ($perangkat_ajar_filter == '') {
				// 	$perangkat_ajar_filter = 'm.id_perangkat_ajar is not null';
				// }
				// else {
				// 	$perangkat_ajar_filter = 'm.id_perangkat_ajar = '. $perangkat_ajar_filter;
				// }

				
				$sql = "SELECT m.nama_porto, m.keterangan, m.uuidporto, substring(u.fname FROM '\S+$') fname, m.thumbnail_filename,
				m.jml_klik, j.nama_kategori_porto, f.nama_fakultas, p.nama_prodi, u.kode_fakultas, m.id_kat_porto, u.kode_univ, u.angkatan
				from d_portofolio m 
				left join user_pengguna u on u.uuiduser = m.uuiduser
				left join d_univ v on v.kode_univ = u.kode_univ
				left join d_fakultas f on f.kode_fakultas = u.kode_fakultas
				left join d_prodi p on p.kode_prodi = u.kode_prodi
				left join d_kategori_portofolio j on j.id_kat_porto = m.id_kat_porto
				where 
				($jenis_porto_filter2)
				AND (upper(m.nama_porto) like upper('%$nama_porto_cari%')) 
				AND ('$univ_filter' = '' or u.kode_univ = '$univ_filter')
				";
                $hasil = $db->query($sql);

                while ($baris = $hasil->fetch(PDO::FETCH_ASSOC)) {					
					$nama_porto = $baris['nama_porto'];
                    $uuidporto = $baris['uuidporto'];
					$keterangan = $baris['keterangan'];
                ?>
				<form action="modul_view.php?md=<?php echo $uuidporto;?>&fk=<?php echo $jenis_porto_filter;?>&uv=<?php echo $univ_filter;?>" method="POST" class="card">
					<input type="hidden" name="kosan_id" value="1" />
					<button type="submit" value="<?php echo $uuidporto; ?>" name="klik_<?php echo $uuidporto; ?>">
						<div class="rounded-xl overflow-hidden shadow-md border bg-white hover:shadow-lg transition">
							<img src="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename'];?>" class="w-full h-48 object-cover" alt="" />
							<div class="p-4">
								<p class="text-sm text-red-600 font-semibold mb-1" style="text-align:left">🏷️ <?php echo $baris['nama_kategori_porto'];?></p>
								<h2 class="text-lg font-semibold text-gray-800" style="text-align:justify"><?php echo $nama_porto;?></h2>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">👥 By : <?php echo $baris['fname'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏫 <?php echo $baris['kode_univ'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏫 <?php echo $baris['kode_univ'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📚 <?php echo $baris['nama_prodi'];?></span>
								</div>
							</div>
						</div>
					</button>
				</form>
				<?php
					}
				?>
			</div>

			<!-- Pagination Controls -->
			<div class="flex justify-center items-center mt-6 gap-4">
				<button id="prevBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 disabled:opacity-50" disabled>Prev</button>
					<span id="pageIndicator" class="font-semibold text-gray-700">Page 1</span>
				<button id="nextBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Next</button>
			</div>
		</div>
	</section>


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
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
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
    const slider = document.getElementById("slider");
    const totalSlides = slider.children.length;
    let index = 0;

    function showSlide(i) {
      index = (i + totalSlides) % totalSlides;
      slider.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
      showSlide(index + 1);
      resetAutoSlide();
    }

    function prevSlide() {
      showSlide(index - 1);
      resetAutoSlide();
    }

    // Auto slide
    let auto = setInterval(() => showSlide(index + 1), 5000);

    function resetAutoSlide() {
      clearInterval(auto);
      auto = setInterval(() => showSlide(index + 1), 5000);
    }

    // Swipe support
    let startX = 0;
    slider.addEventListener("touchstart", e => startX = e.touches[0].clientX);
    slider.addEventListener("touchend", e => {
      let endX = e.changedTouches[0].clientX;
      if (startX - endX > 50) nextSlide();
      else if (endX - startX > 50) prevSlide();
    });
  </script>
   <script>
    const cardsPerPage = 12;
    const cards = document.querySelectorAll("#cards-container .card");
    const totalCards = cards.length;
    const totalPages = Math.ceil(totalCards / cardsPerPage);
    let currentPage = 1;

    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const pageIndicator = document.getElementById("pageIndicator");

    function showPage(page) {
      // Boundary checks
      if (page < 1) page = 1;
      if (page > totalPages) page = totalPages;
      currentPage = page;

      // Hide all cards
      cards.forEach((card, idx) => {
        card.style.display = "none";
      });

      // Show cards for current page
      const start = (page - 1) * cardsPerPage;
      const end = start + cardsPerPage;
      for (let i = start; i < end && i < totalCards; i++) {
        cards[i].style.display = "block";
      }

      // Update buttons disabled state
      prevBtn.disabled = page === 1;
      nextBtn.disabled = page === totalPages;

      // Update page indicator
      pageIndicator.textContent = `Page ${page} of ${totalPages}`;
    }

    prevBtn.addEventListener("click", () => {
      showPage(currentPage - 1);
    });
    nextBtn.addEventListener("click", () => {
      showPage(currentPage + 1);
    });

    // Initialize
    showPage(1);
  </script>
  <script>
	// Fungsi untuk menampilkan popup
	function showPopupReminder() {
		document.getElementById("popupReminder").classList.remove("hidden");
	}

	// Fungsi untuk menutup popup
	function closePopup() {
		document.getElementById("popupReminder").classList.add("hidden");
	}
   </script>
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
					button.innerHTML = isAdding ? '<i class="fa-solid fa-heart" style="color: red;"></i>' : '<i class="fa-solid fa-heart" style="color: lightgray;"></i>';
                    showSwalMessage(isAdding ? "Berhasil Ditambahkan!" : "Berhasil Dihapus!", isAdding ? "Kosan telah masuk wishlist Anda." : "Kosan telah dihapus dari wishlist.", "success");

                    updateWishlistCount();
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
</body>
</html>