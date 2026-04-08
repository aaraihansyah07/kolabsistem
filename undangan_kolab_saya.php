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
		//$st_penjual = $_SESSION['st_penjual'];
	}
	include('koneksi.php');

    if (!isset($_SESSION['uname'])) {
		header('location:index.php');
	}

	// if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
	// 	header('location:index_pencari_kos.php');
	// }
?>
<html lang="en">
<head>
	<title>Undangan Kolab Saya</title>
	<style>
	#undangan_kolab_saya_mobile {background:#4052cb}
    #undangan_kolab_saya {color:#717fe0}
	.harga-box {background-color: #DCCEF9; /* Warna ungu kalem */border-radius: 8px; /* Sudut membulat */padding: 8px 12px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */font-size: 16px; /* Ukuran font */font-weight: bold; /* Teks tebal */
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
					Wishlist Perangkat Ajar
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

    <!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="#" class="stext-109 cl8 hov-cl1 trans-04">
				Undangan Kolab Saya
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
		</div>
	</div>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Undangan Kolab Saya
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-c-m m-tb-10">
					<!-- <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Pencarian
					</div> -->
				</div>
				
				<?php
				
				// if (!isset($_GET['js'])) {
				// 	$jenis_notif_filter = '';
				// }
				// else {
				// 	$jenis_notif_filter = $_GET['js'];
				// }
				
				// if (!isset($_GET['fk'])) {
				// 	$jenjang_filter = 1;
				// }
				// else {
				// 	$jenjang_filter = $_GET['fk'];
				// }
				// $nama_porto_cari = "";
				// $jenis_notif_filter = "";

				// $jenis_sewa_filter  = "";
				// $harga_dari = 0;
				// $harga_sampai = 100000000;
				// $kode_fakultas_filter = 'FPMIPA';
				
				// if (isset($_POST['cari_porto'])) {
				// 	$nama_porto_cari = "";
				// 	$jenis_notif_filter  = "";
				// 	$nama_porto_cari = $_POST['nama_porto'];
				// }

				// if (isset($_POST['cari_porto_filter'])) {
				// 	$harga_dari = $_POST['harga_dari'];
				// 	$harga_sampai = $_POST['harga_sampai'];
				// 	$jenis_notif_filter = $_POST['jenis_notif_filter'];
				// 	$nama_porto_cari = "";
				// }
				?>
				<!-- Berdasarkan Nama -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<form method="post" action="#">
					<div class="bor8 dis-flex p-l-15">
							<input class="mtext-107 cl2 size-114 plh2 p-r-15" value="<?php echo $nama_porto_cari;?>" type="text" name="nama_porto" placeholder="Cari...">
							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" name="cari_porto">
								<i class="zmdi zmdi-search"></i>
							</button>
					</div>	
					</form>
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-5">
					<form method="POST" action="#" style="width: 100%; margin: 0 auto; background-color: #f0f0f0; padding: 20px; border-radius: 8px;">
						<!-- Baris 1: Jarak, Harga, dan Jenis Sewa -->
						<div style="display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 7px;">
							<!-- tujuan -->
							<div style="flex: 1; margin-right: 10px; margin-bottom: 10px;">
								<label for="jenis-sewa" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">Jenis Notifikasi</label>
								<select name="jenis_notif_filter" id="jenis-sewa" style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									<option value="" <?= ($jenis_notif_filter == '') ? 'selected' : '' ?>>All</option>  
									<option value="FAV" <?= ($jenis_notif_filter == 'FAV') ? 'selected' : '' ?>>Penambahan ke Favourite</option>  
									<option value="UDG" <?= ($jenis_notif_filter == 'UDG') ? 'selected' : '' ?>>Undangan Berkolaborasi</option>  
									<option value="KON" <?= ($jenis_notif_filter == 'KON') ? 'selected' : '' ?>>Konfirmasi Kolaborasi</option>  
								</select>
							</div>
						</div>

						<!-- Tombol Pencarian -->
						<button name="cari_porto_filter" type="submit" style="width: 100%; padding: 10px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Refresh</button>
					</form>
				</div>
			</div>

            <div class="space-y-4" style="margin-top:-2%">
				<?php
					// Update status view
					$sql4 = "UPDATE f_favourite_pencari_porto 
							SET st_view = 'Y' 
							WHERE st_view IS NULL 
							AND uuiduserpemilik = :uuiduserpemilik";
					$stmt4 = $db->prepare($sql4);
					$stmt4->execute(['uuiduserpemilik' => $uuiduser]);

					$sql5 = "UPDATE log_favourite_pencari_porto 
							SET st_view = 'Y' 
							WHERE st_view IS NULL 
							AND uuiduserpemilik = :uuiduserpemilik";
					$stmt5 = $db->prepare($sql5);
					$stmt5->execute(['uuiduserpemilik' => $uuiduser]);

					// Ambil data notifikasi
					$sql = "
						SELECT 
							uk.keterangan ket_kolab,
							jk.keterangan ket_kerjasama,
							nama_perusahaan,
							uk.id_undangan,
							role_id,
							kode_univ,
							substring(fname, '\S+$') nama_awal,
							u.kode_fakultas||' '||u.kode_univ kode_fakultas,
							uk.uuiduserpengundang,
							uk.uuiduserdiundang,
							r.nama_porto,
							to_char(uk.createdate, 'DD MONTH YYYY HH24:MI') createdate,
							st_konfirmasi,
							uk.uuidporto
						FROM f_undangan_kerjasama uk
						LEFT JOIN user_pengguna u ON u.uuiduser = uk.uuiduserdiundang
						LEFT JOIN d_portofolio r ON r.uuidporto = uk.uuidporto
						LEFT JOIN d_jenis_kerjasama jk ON jk.id_jenis_kerjasama = uk.id_jenis_kerjasama
						WHERE uk.uuiduserpengundang = :uuiduser
						ORDER BY uk.createdate DESC
					";

					$stmt = $db->prepare($sql);
					$stmt->execute([
						'uuiduser' => $uuiduser
					]);

					while ($baris = $stmt->fetch(PDO::FETCH_ASSOC)) {

						// Caption builder
						$caption  = '';
						$caption2 = '';

						if ($baris['role_id'] == 1) { // MAHASISWA
								$caption = "<span class='text-gray-600'>Anda mengundang</span>
											<span class='font-semibold text-red-600'>{$baris['nama_awal']} dari {$baris['kode_fakultas']}</span>
											<span class='text-gray-600'>dalam berkolaborasi untuk</span>
											<span class='font-semibold text-green-600'>{$baris['ket_kerjasama']}</span>";
	
						}
				?>

				<!-- CARD -->
				<!-- <div class="flex items-start bg-gray-50 p-4 rounded-lg shadow-sm" id="cards-container"> -->
				<div class="card-item flex items-start ...">

					<!-- ICON -->
					<div class="flex-shrink-0">
						<div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
							<i class="zmdi zmdi-file text-xl text-orange-600"></i>
						</div>
					</div>

					<!-- CONTENT -->
					<div class="ml-4 flex justify-between w-full">

						<!-- LEFT TEXT -->
						<div>
							<p class="text-gray-700 text-sm sm:text-base">
								<?php echo $caption; ?>
							</p>

							<?php if ($caption2 != '') { ?>
								<p class="text-xs text-gray-600 mt-1"><?php echo $caption2; ?></p>
							<?php } ?>

							<p class="text-xs text-gray-400 mt-1"><?php echo $baris['createdate']; ?></p>
						</div>

						<!-- RIGHT BUTTON -->
						<div class="flex items-start">
							<form method="post" action="undang_kolaborasi_view.php">
								<input type="hidden" name="id_undangan" value="<?php echo $baris['id_undangan']; ?>">
								<input type="hidden" name="md" value="<?php echo $baris['uuidporto']; ?>">
								<button
									name="view"
									type="submit"
									class="text-xs px-3 py-1 rounded-md bg-green-600 text-white hover:bg-green-700 transition">
									Lihat Detail
								</button>
							</form>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			
			<!-- Pagination Controls -->
			<div class="flex justify-center items-center mt-6 gap-4">
				<button id="prevBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 disabled:opacity-50" disabled>Prev</button>
					<span id="pageIndicator" class="font-semibold text-gray-700">Page 1</span>
				<button id="nextBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Next</button>
			</div>
        </div>
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

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
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
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
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

            /*async function updateWishlistCount() {
                let response = await fetch('wishlist_count.php?uuiduserfav=' + uuiduserfav);
                let result = await response.json();
                document.getElementById('wishlist-count').textContent = result.count || 0;
            }*/
		   	
			async function updateWishlistCount() {
				let response = await fetch('wishlist_count.php?uuiduserfav=' + uuiduserfav);
				let result = await response.json();

				document.querySelectorAll('.wishlist-count').forEach(el => {
					el.textContent = result.count || 0;
				});
			}

            async function toggleWishlist(button) {
                let uuidporto = button.dataset.ruangan;
                let isAdding = button.classList.contains('inactive');

                let response = await fetch('wishlist_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ uuiduserfav, uuidporto, action: isAdding ? 'add' : 'remove' })
                });

                let result = await response.json();
                if (result.status === 'success') {
                    button.classList.toggle('active', isAdding);
                    button.classList.toggle('inactive', !isAdding);
					button.innerHTML = isAdding ? '<i class="fa-solid fa-heart" style="color: red;"></i>' : '<i class="fa-solid fa-heart" style="color: lightgray;"></i>';
                    showSwalMessage(isAdding ? "Berhasil Ditambahkan!" : "Berhasil Dihapus!", isAdding ? "Perangkat Ajar telah masuk wishlist Anda." : "Perangkat Ajar telah dihapus dari wishlist.", "success");

                    updateWishlistCount();
                } else {
                    showSwalMessage("Terjadi Kesalahan!", result.message, "error");
                }
            }

            /*document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', () => toggleWishlist(button));
            });*/

            updateWishlistCount();
        });
    </script>

	<script>
    const cardsPerPage = 30;
    // const cards = document.querySelectorAll("#cards-container");
	const cards = document.querySelectorAll(".card-item");
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
        cards[i].style.display = "";
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
</body>
</html>