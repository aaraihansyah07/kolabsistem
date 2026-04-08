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

    if (!isset($_SESSION['uname'])) {
		header('location:index.php');
	}
?>
<html lang="en">
<head>
	<title>Portofolio Saya</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!--===============================================================================================-->
	<style>
	#porto_saya_mobile {background:#4052cb}
	.harga-box {background-color: #DCCEF9; /* Warna ungu kalem */border-radius: 8px; /* Sudut membulat */padding: 6px 8px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */font-size: 65%; /* Ukuran font */font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
	}
		#nav_kosan_saya {color:#717fe0}
		@media (max-width: 768px) {
    .menu-desktop {
        display: none !important;
    }

    .mobile-header {
        display: flex !important;
    }

    #mobile-menu a {
        border-bottom: 1px solid #eee;
        text-decoration: none;
        color: #333;
    }

    #mobile-menu a:hover {
        color: #007bff;
    }
}
	.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	.notif-ulasan-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
    .notif-wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	</style>
</head>
<script>
document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('d-none');
});
</script>
<body>
	
	<!-- Header -->
	<?php
		include('nav_top_pemilik_kos.php');
	?>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
	</div>
	<?php
		$sql2 = "SELECT u.email, u.fname, u.st_active, v.nama_univ, f.nama_fakultas, p.nama_prodi, u.no_hp
		from user_pengguna u
		left join d_univ v on u.kode_univ = v.kode_univ
		left join d_fakultas f on f.kode_fakultas = u.kode_fakultas
		left join d_prodi p on p.kode_prodi = u.kode_prodi
		where u.uuiduser = '$uuiduser'";
		$hasil2 = $db->query($sql2);
		$baris2 = $hasil2->fetch(PDO::FETCH_ASSOC);

		if ($baris2['st_active'] == 'Y') {
			$st_active = 'Aktif';
		}
		else {
			$st_active = 'Belum Aktif (Harap cek email Anda untuk mengaktifkan akun)';
		}


		//KEBUTUHAN PAKET
		// if ($baris2['st_bayar'] == 'Y' AND isset($baris2['uuidpaket'])) {
		// 	$st_bayar = $baris2['nama_paket']. ' / Sudah Bayar';
		// 	$caption = '';
		// 	if ($baris2['nama_paket'] == 'Medium' or $baris2['nama_paket'] == 'Mini') {
		// 		$caption2 = "<a href='#'><button style='
		// 			background-color: #e2d9d8; color: black; border: none;
		// 			padding: 5px 12px;border-radius: 10px;cursor: pointer;font-size: 14px;transition: 0.3s; float:right
		// 		'>🚀 Upgrade Paket</button></a>";
		// 	}
		// 	else {
		// 		$caption2 = '';
		// 	}
		// }
		// else if ($baris2['st_bayar'] !== 'Y' AND isset($baris2['uuidpaket'])) {
		// 	$st_bayar = $baris2['nama_paket']. ' / Belum Diperpanjang';
		// 	$caption = "<p style='margin: 5px 0; font-size: 14px; color: white;'>◉ Saat ini Anda belum berlangganan/perpanjang paket, harap lakukan pembelian/perpanjangan paket langganan terlebih dahulu supaya perangkat ajar dapat dilihat pencari</p>";
		// 	$caption2 = "<a href='#'><button style='
		// 		background-color: #e2d9d8; color: black; border: none;
		// 		padding: 5px 12px;border-radius: 10px;cursor: pointer;font-size: 14px;transition: 0.3s; float:right
		// 	'>💳 Beli / Perpanjang Paket</button></a>";
		// }
		// else if ($baris2['st_bayar'] !== 'Y' AND !isset($baris2['uuidpaket'])) {
		// 	$st_bayar = '- / Belum Berlangganan';
		// 	$caption = "<p style='margin: 5px 0; font-size: 14px; color: white;'>◉  Saat ini Anda belum berlangganan/perpanjang paket, harap lakukan pembelian/perpanjangan paket langganan terlebih dahulu supaya perangkat ajar dapat dilihat pencari</p>";
		// 	$caption2 = "<a href='#'><button style='
		// 		background-color: #e2d9d8; color: black; border: none;
		// 		padding: 5px 12px;border-radius: 10px;cursor: pointer;font-size: 14px;transition: 0.3s; float:right
		// 	'>💳 Beli / Perpanjang Paket</button></a>";
		// }
	?>
	<div style="
        position: relative;width: 100%; padding: 20px; border: 1px solid #ddd; border-radius: 2px; box-shadow: 3px 3px 15px rgba(0,0,0,0.1);
        text-align: center; background-color: #419ad0;
    ">
		<!-- <h3 class="ltext-106 cl5 txt-center" style="color:white"><?php echo $baris2['nama_kosan'];?></h3> -->
        <div style="margin-top: 10px; text-align: left; padding: 10px; background: #2672a2; border-radius: 8px;">
			<!-- Tombol Edit -->
			<a href='profil.php'><button style="
				background-color: #e2d9d8; color: black; border: none;
				padding: 5px 12px;border-radius: 10px;cursor: pointer;font-size: 14px;transition: 0.3s; float:right; margin-right:0.5%
			">✏️ Edit</button></a><br>
			<p style="margin: 5px 0; font-size: 14px; color: white;"><strong>🙍🏻‍♂️ Nama Lengkap&nbsp:</strong>&nbsp<?php echo $baris2['fname'];?></p>
		 	<p style="margin: 5px 0; font-size: 14px; color: white;"><strong>📧 Email&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>&nbsp<?php echo $baris2['email'];?></p>
			<p style="margin: 5px 0; font-size: 14px; color: white;"><strong>📞 No. Telepon&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>&nbsp<?php echo $baris2['no_hp'];?></p>
			<p style="margin: 5px 0; font-size: 14px; color: white;"><strong>🏛️ Universitas &nbsp&nbsp&nbsp&nbsp&nbsp:</strong>&nbsp<?php echo $baris2['nama_univ'];?></p>
			<p style="margin: 5px 0; font-size: 14px; color: white;"><strong>🏫 Fakultas &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>&nbsp<?php echo $baris2['nama_fakultas'];?></p>
			<p style="margin: 5px 0; font-size: 14px; color: white;"><strong>📚 Prodi &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>&nbsp<?php echo $baris2['nama_prodi'];?></p>
		</div>

        <!-- <p style="margin: 10px 0; font-size: 14px; color: white;"><?php echo $baris2['deskripsi'];?></p> -->
    </div>

    <section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<?php
				// $sql3 = "select count(1) cek_jml from d_portofolio
				// where uuiduser = '$uuiduser'";
				// $hasil3 = $db->query($sql3);
				// $baris3 = $hasil3->fetch(PDO::FETCH_ASSOC);

				// if ($baris3['cek_jml'] < 1) {
				// 	$tombol_upload = "<a href='modul_tambah.php'><button style='top: 10px; right: 10px; background-color: #717fe0; color: white;
          	    // 	 border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;'>[+] Upload Portofolio</button></a>";
				// }
				// else {
				// 	$tombol_upload = '';
				// }

				$tombol_upload = "<a href='modul_tambah.php'>
				<button class='btn btn-primary ms-auto'>
				<i class='fa-solid fa-upload'></i> Upload Portofolio
				</button>
				</a>";
			?>
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Portofolio Saya
				</h3><br>
				<?php echo $tombol_upload;?>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
					<?php
						$sql = "SELECT m.nama_porto, m.keterangan, m.uuidporto, substring(u.fname FROM '\S+$') fname, m.thumbnail_filename,
						m.jml_klik, j.nama_kategori_porto, f.nama_fakultas, p.nama_prodi, u.kode_fakultas, m.jml_klik
						from d_portofolio m 
						left join user_pengguna u on u.uuiduser = m.uuiduser
						left join d_univ v on v.kode_univ = u.kode_univ
						left join d_fakultas f on f.kode_fakultas = u.kode_fakultas
						left join d_prodi p on p.kode_prodi = u.kode_prodi
						left join d_kategori_portofolio j on j.id_kat_porto = m.id_kat_porto
						where m.uuiduser = '$uuiduser'";
						$hasil = $db->query($sql);

						while ($baris = $hasil->fetch(PDO::FETCH_ASSOC)) {
						$nama_porto = $baris['nama_porto'];
						$uuidporto = $baris['uuidporto'];
						$keterangan = $baris['keterangan'];

						if ($baris['jml_klik'] == null) {
							$baris['jml_klik'] = 0;
						}
					?>
					<form action="modul_edit.php" method="POST" class="card">
						<input type="hidden" name="kosan_id" value="1" />
						<button type="submit" value="<?php echo $uuidporto; ?>" name="to_detail">
						<div class="rounded-xl overflow-hidden shadow-md border bg-white hover:shadow-lg transition">
							<img src="<?php echo 'uploads/thumbnail/'. $baris['thumbnail_filename'];?>" class="w-full h-48 object-cover" alt="" />
							<div class="p-4">
								<p class="text-sm text-red-600 font-semibold mb-1" style="text-align:left">🏷️ <?php echo $baris['nama_kategori_porto']. ' ('. $baris['jml_klik']. ' kali dikunjungi)';?></p>
								<h2 class="text-lg font-semibold text-gray-800" style="text-align:justify"><?php echo $nama_porto;?></h2>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">👥 By : <?php echo $baris['fname'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏫 <?php echo $baris['kode_fakultas'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📚 <?php echo $baris['nama_prodi'];?></span>
								</div>
							</div>
						</div>
					</button>
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
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
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

            /*document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', () => toggleWishlist(button));
            });*/

            updateWishlistCount();
        });
    </script>
</body>
</html>