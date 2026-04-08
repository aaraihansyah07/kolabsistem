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
	if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
		header('location:index_pencari_kos.php');
	}
    
	$uuidruangankosan = $_GET['rk'];
    $st = $_GET['st'];

    if ($st == 'Y') {
        echo "<script>window.alert('Data berhasil diedit')</script>";
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
<!--===============================================================================================-->
<style>
	.notif-ulasan-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
    .notif-wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
</style>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
	
	<!-- Header -->
	 <?php
		include('nav_top_pemilik_kos.php');
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


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<a href='ruangan_kosan_view.php?rk=<?php echo $uuidruangankosan;?>&fk=FPMIPA&hd=0&hs=1000000000&js='><button style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Kembali</button></a>								
            <h3 class="ltext-106 cl5 txt-center">
				Edit Ruangan Kosan
			</h3>
			<?php
                $sql = "SELECT rk.harga harga_sys, rk.biaya_listrik biaya_listrik_dsp, rk.biaya_wifi biaya_wifi_dsp, rk.uuidruangankosan, rk.uuidkosan, rk.uuiduser, rk.nama_ruangan, 
				rk.deskripsi, trim(to_char(rk.harga, 'FM999G999G999')) harga, rk.jml_klik, rk.jml_tersisa, rk.ukuran_ruangan,
				trim(to_char(rk.biaya_listrik, 'FM999G999G999')) biaya_listrik, trim(to_char(rk.biaya_wifi, 'FM999G999G999')) biaya_wifi, trim(to_char(rk.biaya_kebersihan, '999G999G999')) biaya_kebersihan, rk.jenis_sewa, rk.letak_kamar_mandi, rk.tipe_kloset
				FROM d_ruangan_kosan rk where rk.uuidruangankosan = '$uuidruangankosan'";
                $hasil = $db->query($sql);
				$baris = $hasil->fetch(PDO::FETCH_ASSOC);

                $uuidkosan = $baris['uuidkosan'];


			?>
            <form class="w-full" method="post" action="ruangan_kosan_edit_proses.php" enctype="multipart/form-data">
                <div class="flex-w flex-m p-t-50 p-b-23">
                </div>

                <input name="uuidruangankosan" value="<?php echo $uuidruangankosan;?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" hidden>
                <input name="uuidkosan" value="<?php echo $baris['uuidkosan'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" hidden>

				<div class="row p-b-25">
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Nama Ruangan</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['nama_ruangan'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="nama_ruangan" required>
						</div>
					</div>

					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Jenis Sewa</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
						<select class="js-select2" name="jenis_sewa" required>
                            <option value=''>Pilih jenis sewa...</option>
                            <option value='1' <?php echo ($baris['jenis_sewa'] == 1) ? 'selected' : ''; ?>>Tahunan</option>
                            <option value='2' <?php echo ($baris['jenis_sewa'] == 2) ? 'selected' : ''; ?>>Bulanan</option>
                            <option value='3' <?php echo ($baris['jenis_sewa'] == 3) ? 'selected' : ''; ?>>Mingguan</option>
                            <option value='4' <?php echo ($baris['jenis_sewa'] == 4) ? 'selected' : ''; ?>>Harian</option>
						</select>
						<div class="dropDownSelect2"></div>
						</div>
					</div>
				</div>

				<div class="row p-b-25" style="margin-top:-2%">
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Harga Ruangan</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input 
								value="<?php echo htmlspecialchars($baris['harga'] ?? '', ENT_QUOTES); ?>" 
								class="size-111 bor8 stext-102 cl2 p-lr-20" 
								id="harga" 
								type="text" 
								name="harga" 
								data-raw-value="<?php echo htmlspecialchars($baris['harga_dsp'] ?? '', ENT_QUOTES); ?>" 
								required
							>
						</div>
					</div>


					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Biaya Listrik</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['biaya_listrik'];?>" placeholder="Kosongkan jika tidak ada" class="size-111 bor8 stext-102 cl2 p-lr-20" id="listrik" type="text" name="biaya_listrik" data-raw-value="<?php echo $baris['biaya_listrik_dsp'];?>">
						</div>
					</div>
				</div>

				<div class="row p-b-25" style="margin-top:-2%">
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Biaya WIFI</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['biaya_wifi'];?>" placeholder="Kosongkan jika tidak ada" class="size-111 bor8 stext-102 cl2 p-lr-20" id="wifi" type="text" name="biaya_wifi" data-raw-value="<?php echo $baris['biaya_wifi_dsp'];?>">
						</div>
					</div>

					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Biaya Kebersihan</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['biaya_kebersihan'];?>" placeholder="Kosongkan jika tidak ada" class="size-111 bor8 stext-102 cl2 p-lr-20" id="kebersihan" type="text" name="biaya_kebersihan" data-raw-value="<?php echo $baris['biaya_kebersihan'];?>">
						</div>
					</div>
				</div>

				<div class="row p-b-25" style="margin-top:-2%">
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Ukuran Ruangan</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['ukuran_ruangan'];?>" placeholder="Contoh : 3x3" class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="ukuran_ruangan" required>
						</div>
					</div>

					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Jumlah ruangan tersisa</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
							<input value="<?php echo $baris['jml_tersisa'];?>" class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="number" name="jml_tersisa" required>
						</div>
					</div>
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Letak Kamar Mandi</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
						<select class="js-select2" name="letak_kamar_mandi" required>
							<option value=''>Pilih...</option>
							<option value='Dalam' <?php echo ($baris['letak_kamar_mandi'] == 'Dalam') ? 'selected' : ''; ?>>Di dalam</option>
							<option value='Luar' <?php echo ($baris['letak_kamar_mandi'] == 'Luar') ? 'selected' : ''; ?>>Di Luar</option>
						</select>
						<div class="dropDownSelect2"></div>
						</div>
					</div>
					<div class="col-sm-6 p-b-5">
						<label class="stext-102 cl3" for="review">Tipe Kloset</label>
						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
						<select class="js-select2" name="tipe_kloset" required>
							<option value=''>Pilih...</option>
							<option value='Duduk' <?php echo ($baris['tipe_kloset'] == 'Duduk') ? 'selected' : ''; ?>>Duduk</option>
							<option value='Jongkok' <?php echo ($baris['tipe_kloset'] == 'Jongkok') ? 'selected' : ''; ?>>Jongkok</option>
						</select>
						<div class="dropDownSelect2"></div>
						</div>
					</div>
                    
					<div class="col-12 p-b-5">
						<label class="stext-102 cl3" for="review">Deskripsi</label>
						<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" placeholder="Isi dengan fasilitas/deskripsi ruangan kos" id="deskripsi" name="deskripsi"><?php echo $baris['deskripsi'];?></textarea>
					</div>
				</div>
				<div class="max-w-9xl mx-auto bg-white p-6 rounded-lg shadow-md">
					<div id="fileContainer" class="flex flex-wrap justify-center gap-4">
						<?php
							$sql2 = "SELECT*FROM d_ruangan_kosan_gambar where uuidruangankosan = '$uuidruangankosan'";
							$hasil2 = $db->query($sql2);

							while ($baris2 = $hasil2->fetch(PDO::FETCH_ASSOC)) {							
						?>
						<div class="file-group flex flex-col items-center bg-gray-200 p-4 rounded-lg shadow-md relative" style="width:400px;">
							<label class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md text-sm">
								Upload Gambar Ulang
								<input type="file" name="gambar_ruangan[]" accept="image/*" class="file hidden" onchange="previewImage(event, this)">
							</label><br>
							
							<input type="hidden" name="id_gambar[]" value="<?php echo $baris2['id_gambar']; ?>"/>

							<div class="preview w-full mt-2 bg-white flex items-center justify-center border border-gray-300 rounded-md" style="height:200px;">
								<img src="uploads/<?php echo $baris2['filename']; ?>" style="width: 100%; height: 100%; object-fit: contain; object-position: center;;" alt="Preview">
							</div>

							<button value="<?php echo $baris2['id_gambar']; ?>" type="submit" class="remove-btn absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center shadow-md" name="hapus_gambar">✖</button>
						</div>

						<?php
							}
						?>
					</div>

					<!-- Tombol Tambah Input File -->
					<div class="text-center mt-4">
						<button type="button" onclick="addFileInput()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah Gambar</button>
					</div>
				</div><br>

				<!-- <button type="submit" name="edit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                    UPDATE
                </button> -->
				<button type="submit" name="edit" style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">✏️ Update</button>						
            </form>
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
        function addFileInput() {
            let container = document.getElementById("fileContainer");

            let newDiv = document.createElement("div");
            newDiv.classList.add("file-group", "flex", "flex-col", "items-center", "bg-gray-200", "p-4", "rounded-lg", "shadow-md", "w-[400px]", "relative");

            newDiv.innerHTML = `
                <label class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md text-sm">
                    Upload Gambar
                    <input type="file" name="gambar_ruangan[]" accept="image/*" class="file hidden" onchange="previewImage(event, this)">
                </label>
                <div class="preview w-full mt-2 bg-white flex items-center justify-center border border-gray-300 rounded-md" style="height:200px">
                    <span class="text-gray-500 text-xs">PREVIEW</span>
                </div>
                <button type="button" class="remove-btn absolute -top-3 -right-3 bg-red-500 text-white w-7 h-7 rounded-full flex items-center justify-center shadow-md" onclick="removeInput(this)">✖</button>
            `;

            container.appendChild(newDiv);
        }

        function removeInput(button) {
            button.parentElement.remove();
        }

        function previewImage(event, input) {
            let file = input.files[0];
            let reader = new FileReader();

            reader.onload = function (e) {
                let previewBox = input.closest(".file-group").querySelector(".preview");
                previewBox.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-md">`;
            };

            reader.readAsDataURL(file);

            // Tampilkan tombol hapus setelah file dipilih
            input.closest(".file-group").querySelector(".remove-btn").classList.remove("hidden");
        }
		// Fungsi untuk memformat angka dengan pemisah ribuan
		function formatNumberInput(input) {
			input.addEventListener('input', function (e) {
				let value = e.target.value.replace(/\D/g, ''); // hanya angka
				if (value === '') {
					e.target.value = '';
					e.target.dataset.rawValue = '';
					return;
				}
				let formatted = new Intl.NumberFormat('id-ID').format(value);
				e.target.value = formatted;
				e.target.dataset.rawValue = value; // simpan versi mentah
			});

			// Saat blur juga simpan rawValue
			input.addEventListener('blur', function (e) {
				e.target.dataset.rawValue = e.target.value.replace(/\D/g, '');
			});
		}


		// Ambil semua input yang membutuhkan format angka
		const numberInputs = document.querySelectorAll('#harga, #kebersihan, #wifi, #listrik');

		// Terapkan fungsi formatNumberInput ke setiap input
		numberInputs.forEach(input => formatNumberInput(input));
    </script>
</body>
</html>