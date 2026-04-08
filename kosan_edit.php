<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		$user = "Login";
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
    $uuiduser = $_GET['us'];
    $st = $_GET['st'];

    if ($st == 'Y') {
        echo "<script>window.alert('Data berhasil diedit')</script>";
    }
	
	if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
        header('location:index_pencari_kos.php');
    }
?>
<html lang="en">
<head>
	<title>Edit Ruangan Kosan</title>
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
<!--===============================================================================================-->
<style>
	.notif-ulasan-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
    .notif-wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
</style>
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


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<a href='kosan_saya.php'><button style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Kembali</button></a>
            <br><br><h3 class="ltext-106 cl5 txt-center">
				Edit Kosan
			</h3>
			<?php
                $sql = "SELECT u.nama_lengkap, k.uuidkosan, k.nama_kosan, k.alamat_kosan_lengkap, k.deskripsi, u.no_hp, u.email, k.tipe_kosan 
                FROM d_kosan k left join users u on u.uuiduser = k.uuiduser
                WHERE k.uuiduser = '$uuiduser'";
                $hasil = $db->query($sql);
				$baris = $hasil->fetch(PDO::FETCH_ASSOC);

                $uuidkosan = $baris['uuidkosan'];
			?>
            <form id="formEditKosan" class="w-full" method="post" action="kosan_edit_proses.php" style="margin-top:-5%">
                <div class="flex-w flex-m p-t-50 p-b-23">
                </div>
				<input type="hidden" name="edit" value="1">
				<input type="hidden" name="jarak_data" id="jarakData">
                <input name="uuiduser" value="<?php echo $uuiduser;?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="uuiduser" type="text" hidden>
				<div class="row p-b-25">
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Nama Kosan</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['nama_kosan'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="nama_kosan" type="text" name="nama_kosan" required>
						</div>
					</div>

					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Alamat Kosan Lengkap</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['alamat_kosan_lengkap'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="alamat_kosan" type="text" name="alamat_kosan_lengkap" required>
						</div>
					</div>
				</div>

				<div class="row p-b-25" style="margin-top:-2%">
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Email</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['email'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20"
 id="email_kosan" type="email" name="email">
						</div>
					</div>

					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">No. HP</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['no_hp'];?>" placeholder="Kosongkan jika tidak ada" class="size-111 bor8 stext-102 cl2 p-lr-20" id="no_hp" type="number" name="no_hp" required>
						</div>
					</div>
				</div>
				<div class="row p-b-25" style="margin-top:-2%">   
                    <div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Pemilik</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['nama_lengkap'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="nama_lengkap" type="text" name="nama_lengkap">
						</div>
					</div>              
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Tipe Kosan</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
						<select class="js-select2" name="tipe_kosan" required>
							<option value=''>Pilih...</option>
							<option value='Putra' <?php echo ($baris['tipe_kosan'] == 'Putra') ? 'selected' : ''; ?>>Putra</option>
							<option value='Putri' <?php echo ($baris['tipe_kosan'] == 'Putri') ? 'selected' : ''; ?>>Putri</option>
							<option value='Putra/Putri' <?php echo ($baris['tipe_kosan'] == 'Putra/Putri') ? 'selected' : ''; ?>>Putra/Putri</option>
						</select>
						<div class="dropDownSelect2"></div>
						</div>
					</div>    
					<div class="col-12 p-b-5">
						<label class="stext-102 cl3" for="review">Deskripsi Kosan</label>
						<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="deskripsi" name="deskripsi"><?php echo $baris['deskripsi'];?></textarea>
					</div>
				</div>
				<button style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;" type="button" id="btnUpdate" onclick="hitungJarakDanKirim()">✏️ Update</button>
				<!-- <button type="submit" name="edit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                    UPDATE
                </button> -->
            </form>
		</div>

		<!-- Loading Popup -->
		<div id="loadingPopup" style="display: none; position: fixed; top: 0; left: 0; 
			width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); 
			z-index: 9999; align-items: center; justify-content: center;">
		<div style="background: white; padding: 20px 30px; border-radius: 10px; font-size: 16px; box-shadow: 0 0 15px rgba(0,0,0,0.3);">
			⏳ Sedang memproses... Mohon tunggu...
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

    <script>
        document.getElementById('successModal')
    </script>
    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Data berhasil diedit.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
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
	async function hitungJarakDanKirim() {
	const alamatKosan = document.getElementById("alamat_kosan").value;
	const popup = document.getElementById("loadingPopup");

	if (!alamatKosan || alamatKosan.trim() === "") {
		alert("Alamat kosan tidak boleh kosong.");
		return;
	}

	// Tampilkan popup
	popup.style.display = "flex";

	const encodedAlamat = encodeURIComponent(alamatKosan);
	const fakultasList = [
		{ kode: 'fpmipa', alamat: 'Faculty of Mathematics and Natural Sciences Education, Jl. Dr. Setiabudi No.229, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fpok', alamat: 'Faculty of Sports and Health Education, 4HQQ+JXH, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fip', alamat: 'Faculty of Education, Jl. Dr. Setiabudi No.229, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fpbs', alamat: 'FPBS UPI, 4HQV+JCW, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fpsd', alamat: 'Faculty of Art and Design Education, Gd. A FPSD UPI, Jl. Dr. Setiabudi No.229, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fpeb', alamat: 'Faculty of Economics and Business Education, 4HQR+XXC, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fptk', alamat: 'Faculty of Technology And Vocational Education, Jl. Dr. Setiabudi No.207, Isola, Sukasari, Bandung City, West Java 40154' },
		{ kode: 'fpips', alamat: 'Faculty of Social Sciences Education, Isola, Sukasari, Bandung City, West Java 40154' },
	];

	const apiKey = "6jYNp0DhaMZXfhbuw7zrk1Q1DtnYxMgLIgXWCRVI97rXZw5yzNBsyoVivi4S4Yoq";
	const jarakData = {};

	for (const f of fakultasList) {
		const url = `https://api.distancematrix.ai/maps/api/distancematrix/json?origins=${encodedAlamat}&destinations=${encodeURIComponent(f.alamat)}&key=${apiKey}&mode=walking`;

		try {
		const response = await fetch(url);
		const data = await response.json();

		if (data.status === "OK" && data.rows[0].elements[0].status === "OK") {
			jarakData["jarak_" + f.kode] = data.rows[0].elements[0].distance.value;
		} else {
			jarakData["jarak_" + f.kode] = null;
		}
		} catch (err) {
		console.error("Gagal fetch jarak untuk " + f.kode, err);
		jarakData["jarak_" + f.kode] = null;
		}

		await new Promise(resolve => setTimeout(resolve, 1000)); // delay
	}

	document.getElementById("jarakData").value = JSON.stringify(jarakData);
	document.getElementById("formEditKosan").submit();
	}
	</script>

</body>
</html>