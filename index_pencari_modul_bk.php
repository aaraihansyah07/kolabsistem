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
?>
<html lang="en">
<head>
	<title>Home</title>
	<style>
	#nav_home {color:#717fe0}
	.harga-box {background-color: #DCCEF9; /* Warna ungu kalem */border-radius: 8px; /* Sudut membulat */padding: 6px 8px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */font-size: 65%; /* Ukuran font */font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
	}
	.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
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
		include('nav_top_pencari_kos.php');
	 ?>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Wishlist Kosan
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

	<!-- Slider -->
	<section class="section-slide">
		<br><br>
		<div class="px-4 md:px-8">
  				<div class="relative w-full max-w-[800px] aspect-[16/9] overflow-hidden shadow-lg rounded-lg mx-auto">
				<div id="slider" class="flex transition-transform duration-500 ease-in-out h-full">
					<div class="flex-shrink-0 w-full h-full">
						<img src="uploads/banner_premium/promo_opening.png" class="w-full h-full object-cover" alt="Slide 1">
					</div>
					<div class="flex-shrink-0 w-full h-full">
						<img src="uploads/banner_premium/banner2.png" class="w-full h-full object-cover" alt="Slide 2">
					</div>
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
					Kosan Dekat UPI
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
						Cari Kosan berdasarkan Nama Kosan
					</div>
				</div>
				
				<?php
				if (!isset($_GET['hd'])) {
					$harga_dari = 0;
				}
				else {
					$harga_dari = $_GET['hd'];
				}
				
				if (!isset($_GET['hs'])) {
					$harga_sampai = 100000000;
				}
				else {
					$harga_sampai = $_GET['hs'];
				}
				
				if (!isset($_GET['js'])) {
					$jenis_sewa_filter = '';
				}
				else {
					$jenis_sewa_filter = $_GET['js'];
				}
				
				if (!isset($_GET['fk'])) {
					$kode_fakultas_filter = 'FPMIPA';
				}
				else {
					$kode_fakultas_filter = $_GET['fk'];
				}
				$nama_kos_cari = "";
				// $jenis_sewa_filter  = "";
				// $harga_dari = 0;
				// $harga_sampai = 100000000;
				// $kode_fakultas_filter = 'FPMIPA';
				
				if (isset($_POST['cari_kos'])) {
					$nama_kos_cari = "";
					$jenis_sewa_filter  = "";
					$harga_dari = 0;
					$harga_sampai = 100000000;
					$nama_kos_cari = $_POST['nama_kos'];
				}

				if (isset($_POST['cari_kosan_filter'])) {
					$harga_dari = $_POST['harga_dari'];
					$harga_sampai = $_POST['harga_sampai'];
					$jenis_sewa_filter = $_POST['jenis_sewa_filter'];
					$kode_fakultas_filter = $_POST['kode_fakultas_filter'];
					$nama_kos_cari = "";
					if ($harga_dari == null) {
						$harga_dari = 0;
					}
					if ($harga_sampai == null) {
						$harga_sampai = 100000000;
					}
				}
				?>
				<!-- Berdasarkan Nama -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<form method="post" action="#">
					<div class="bor8 dis-flex p-l-15">
							<input class="mtext-107 cl2 size-114 plh2 p-r-15" value="<?php echo $nama_kos_cari;?>" type="text" name="nama_kos" placeholder="Search">
							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" name="cari_kos">
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
						<!-- Baris 1: Jarak, Harga, dan Jenis Sewa -->
						<div style="display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 7px;">
							<!-- tujuan -->
							<div style="flex: 1; margin-right: 10px; margin-bottom: 10px;">
								<label for="jenis-sewa" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">Tujuan:</label>
								<select name="kode_fakultas_filter" id="jenis-sewa" style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									<?php
										$sql2 = "SELECT*FROM d_fakultas_upi";
										$hasil2 = $db->query($sql2);
										while ($baris2 = $hasil2->fetch(PDO::FETCH_ASSOC)) {
											$kode_fakultas = $baris2['kode_fakultas'];
											$nama_fakultas = $baris2['nama_fakultas'];
									?>	
										<option value=<?php echo $kode_fakultas;?> <?= ($kode_fakultas == $kode_fakultas_filter) ? 'selected' : '' ?>><?php echo $nama_fakultas;?></option>
									<?php
										}
									?>
								</select>
							</div>

							<!-- Jenis Sewa -->
							<div style="flex: 1; margin-right: 10px;">
								<label for="jenis-sewa" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">Jenis Sewa:</label>
								<select name="jenis_sewa_filter" id="jenis-sewa" style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									<option value="" <?= ($jenis_sewa_filter == '') ? 'selected' : '' ?>>All</option>  
									<option value="1" <?= ($jenis_sewa_filter == '1') ? 'selected' : '' ?>>Tahunan</option>
									<option value="2" <?= ($jenis_sewa_filter == '2') ? 'selected' : '' ?>>Bulanan</option>
									<option value="3" <?= ($jenis_sewa_filter == '3') ? 'selected' : '' ?>>Mingguan</option>
									<option value="4" <?= ($jenis_sewa_filter == '4') ? 'selected' : '' ?>>Harian</option>
								</select>
							</div>
						</div>

						<!-- Harga -->
						<div style="flex: 1; margin-right: 10px; margin-bottom: 10px;">
							<label for="harga-dari" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">Harga:</label>
							<div style="display: flex; justify-content: space-between;">
								<input name="harga_dari" id="harga-dari" value="<?php echo $harga_dari;?>" type="number" placeholder="100000" style="width: 48%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
								<span style="align-self: center;">-</span>
								<input name="harga_sampai" id="harga-sampai" value="<?php echo $harga_sampai;?>" type="number" placeholder="500000" style="width: 48%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
							</div>
						</div>

						<!-- Tombol Pencarian -->
						<button name="cari_kosan_filter" type="submit" style="width: 100%; padding: 10px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Cari Kosan</button>
					</form>
				</div>
			</div>
			<div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
				<?php
				$sql = "SELECT r.ukuran_ruangan, r.jml_tersisa, k.tipe_kosan, k.jarak_fpok, k.jarak_fpmipa, k.jarak_fpsd, k.jarak_fpbs, k.jarak_fpips, k.jarak_fpeb, k.jarak_fptk, 
				k.jarak_fip, k.alamat_kosan_lengkap, r.jenis_sewa, TO_CHAR(r.harga, 'L999G999G999') harga, k.nama_kosan, k.uuidkosan, r.nama_ruangan, r.uuidruangankosan, r.jml_klik from d_ruangan_kosan r 
				left join d_kosan k on k.uuidkosan = r.uuidkosan
				where ('$jenis_sewa_filter' = '' or r.jenis_sewa = '$jenis_sewa_filter')
				AND (r.harga between $harga_dari AND $harga_sampai)
				AND upper(k.nama_kosan) like upper('%$nama_kos_cari%') AND k.st_active = 'Y' ORDER BY harga asc";
                $hasil = $db->query($sql);

                while ($baris = $hasil->fetch(PDO::FETCH_ASSOC)) {
					$jarak_fpmipa = $baris['jarak_fpmipa'];
					$jarak_fpok = $baris['jarak_fpok'];
					$jarak_fptk = $baris['jarak_fptk'];
					$jarak_fpsd = $baris['jarak_fpsd'];
					$jarak_fpeb = $baris['jarak_fpeb'];
					$jarak_fpbs = $baris['jarak_fpbs'];
					$jarak_fpips = $baris['jarak_fpips'];
					$jarak_fip = $baris['jarak_fip'];
					
					$nama_kosan = $baris['nama_kosan'];
                    $uuidkosan = $baris['uuidkosan'];
					$nama_ruangan = $baris['nama_ruangan'];
					$uuidruangankosan = $baris['uuidruangankosan'];

					$sql6 = "SELECT id_gambar, nama_gambar, filename, mimetype, berkas
					FROM public.d_ruangan_kosan_gambar where uuidruangankosan = '$uuidruangankosan' order by berkas desc limit 1";
					$hasil6 = $db->query($sql6);
					$baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);

					switch ($baris['jenis_sewa']) {
						case 1:
							$jenis_sewa = "Tahunan";
							break;
						case 2:
							$jenis_sewa = "Bulanan";
							break;
						case 3:
							$jenis_sewa = "Mingguan";
							break;
						case 4:
							$jenis_sewa = "Harian";
							break;
					}

					switch ($kode_fakultas_filter) {
						case 'FPMIPA':
							$jarak = $jarak_fpmipa;
							break;
						case 'FPOK':
							$jarak = $jarak_fpok;
							break;
						case 'FPTK':
							$jarak = $jarak_fptk;
							break;
						case 'FPSD':
							$jarak = $jarak_fpsd;
							break;
						case 'FPEB':
							$jarak = $jarak_fpeb;
							break;
						case 'FPBS':
							$jarak = $jarak_fpbs;
							break;
						case 'FPIPS':
							$jarak = $jarak_fpips;
							break;
						case 'FIP':
							$jarak = $jarak_fip;
							break;
					}
                ?>
				<form action="ruangan_kosan_view_pencari_kos.php?rk=<?php echo $uuidruangankosan;?>&fk=<?php echo $kode_fakultas_filter;?>&hd=<?php echo $harga_dari;?>&hs=<?php echo $harga_sampai;?>&js=<?php echo $jenis_sewa_filter;?>" method="POST" class="card">
					<input type="hidden" name="kosan_id" value="1" />
					<button type="submit" value="<?php echo $uuidruangankosan; ?>" name="klik_<?php echo $uuidruangankosan; ?>">
						<div class="rounded-xl overflow-hidden shadow-md border bg-white hover:shadow-lg transition">
							<img src="<?php echo $baris6['berkas'];?>" class="w-full h-48 object-cover" alt="" />
							<div class="p-4">
								<p class="text-sm text-red-600 font-semibold mb-1" style="text-align:left">± <?php echo $jarak;?> meter ke <?php echo $kode_fakultas_filter;?></p>
								<h2 class="text-lg font-semibold text-gray-800" style="text-align:justify"><?php echo $nama_ruangan. ' | '. $nama_kosan;?></h2>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">💰 <?php echo $baris['harga'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📅 <?php echo $jenis_sewa;?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏠 <?php echo $baris['tipe_kosan'];?></span>
									<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">🛏️ <?php echo $baris['jml_tersisa'];?> ruangan tersisa</span>
									<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">🏠 <?php echo $baris['ukuran_ruangan'];?> meter</span>
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


</body>
</html>