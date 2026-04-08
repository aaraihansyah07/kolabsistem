<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		header('location:login.php');
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
	if ((!isset($_SESSION['uname'])) or ($user != 'login' AND $role_id != 2)) {
    	header('location:index_pencari_kos.php');
	}

	// if (!isset($_GET['rt'])) {
	// 	$rating_form = 1;
	// }
	// else {
	// 	echo "<script>alert('Silakan isi rating terlebih dahulu dalam ulasan');</script>";
	// }

    $uuidproduk = $_GET['upr'];
    $st_invoice = $_GET['iv'];

	if ($st_invoice == 'Z') {
		echo "<script>window.alert('JUMLAH YANG DIPESAN TIDAK BOLEH MELEBIHI JUMLAH STOK PRODUK')</script>";
	}
	else if ($st_invoice == 'Y') {
		echo "<script>window.alert('Berhasil membuat invoice, klik tombol Daftar Invoice Saya untuk mendownload invoice')</script>";
	}
?>
<html lang="en">
<head>
	<title>Katalog Partner</title>
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
		#nav_katalog_partner {color:#717fe0}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
			<a href='katalog_partner.php'><button style="top: 10px; right: 10px; background-color: #717fe0; color: white;
            border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Kembali</button></a>
			<a style='margin-left:1%' href='daftar_invoice'><button style="top: 10px; right: 10px; background-color: #717fe0; color: white;
            border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Daftar Invoice Saya</button></a>
		</div>
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index_pencari_kos.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a href="katalog_partner.php" class="stext-109 cl8 hov-cl1 trans-04">
				Katalog Produk Shoficraft
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a class="stext-109 cl8 hov-cl1 trans-04">
				Detail Produk
			</a>
		</div>
	</div>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60" style="margin-top:-40px">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<?php
									$sql2 = "SELECT filename from produk_shoficraft_gambar where uuidproduk = '$uuidproduk'";
									$hasil2 = $db->query($sql2);
									while ($baris2 = $hasil2->fetch(PDO::FETCH_ASSOC)) {
								?>
								<div class="item-slick3" data-thumb="uploads/produk_shoficraft/<?php echo $baris2['filename'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/produk_shoficraft/<?php echo $baris2['filename'];?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/produk_shoficraft/<?php echo $baris2['filename'];?>">
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
				<div class="col-md-6 col-lg-5 p-b-22">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<?php
                            $sql = "SELECT*FROM produk_shoficraft where uuidproduk = '$uuidproduk'";
                            $hasil = $db->query($sql);
                            $baris = $hasil->fetch(PDO::FETCH_ASSOC);
							if ($_SESSION['uname'] == 'admin_shoficraft') {
						?>
						<div class="size-204 flex-w flex-m respon6-next">
							<form action='katalog_partner_hapus.php' method='POST' style="margin-right: 3%;"onsubmit="return confirm('Apakah yakin ingin menghapus produk ini?');">
								<input type='hidden' name='uuidproduk' value='<?php echo $uuidproduk;?>'/>
								<button name="hapus_produk" 
										style="top: 10px; right: 10px; background-color: #717fe0; color: white; border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">
									🗑️ Hapus
								</button>
							</form>
						</div>
						<?php
							}
						?>
						
						<h4 class="mtext-105 cl2 js-name-detail">
							<?php echo $baris['nama_produk'];?>
						</h4>
                         <span class="harga-box">
                            <?php echo '🏢 '. number_format($baris['jumlah_stok']). " stok tersisa";?>
                        </span>
                        <span class="harga-box">
                             <?php echo "💰 Rp. ". number_format($baris['harga']);?>
                        </span>
						<span class="harga-box">
							<?php echo '🚿 Bahan : '. $baris['bahan']; ?>
						</span>
						<hr style='background:black; margin-top:3%'></hr>
                        <p class="stext-102 cl3 mt-2">
							<?php echo $baris['deskripsi']; ?>
						</p><br>
                        <div class="bg6 flex-c-m flex-w size-302 p-lr-15 p-tb-15" style='font-size:13px; text-align:justify'>
                            <p style='font-weight:bold'>📌 Note Pemesanan : </p><br><br>
                            <p>1. Apabila ada yang ingin ditanyakan terlebih dahulu mengenai produk ini bisa hubungi admin Shoficraft <a href="https://wa.me/62895607521000" target="_blank" style="color:red">di sini</a></p>
                            <p>2. Pemesanan harus dilakukan dengan mengirimkan bukti invoice ke nomor Whatsapp admin Shoficraft</p>
                            <p>3. Setelah invoice dikirim maka admin Shoficraft akan melakukan konfirmasi melalui Whatsapp kepada customer</p>
                            <p>4. Pengiriman dan pembayaran produk Shoficraft 100% dilakukan secara COD dengan gratis ongkos kirim</p>
                            <p>5. Setelah deal untuk dilakukan pengiriman produk yang sudah dipesan, maka produk akan segera diantarkan ke alamat customer secara COD</p><br>
                            <p>*Untuk pengiriman invoice harap dikim ke nomor Whatsapp Admin Shoficraft <a href="https://wa.me/62895607521000" target="_blank" style="color:red">di sini</a></p>
							<p>*Gratis ongkos kirim hanya berlaku untuk Kota Cimahi, Kota Bandung, dan Kabupaten Cirebon (Sekitaran Sumber)</p>
                            <p>*Info produk rajut berkualitas dan unik Shoficraft lainnya silakan buka menu katalog produk partner atau kunjungi Instagram <a href='https://www.instagram.com/shoficraft/' target='_blank'>@shoficraft</a></p>
                        </div><br>
					</div>
				</div>
                <div class="row p-b-25" style="margin-top:0.5%">
                    <form method='POST' action='buat_invoice_shoficraft.php'>
                        <div class="row">
                            <input type='hidden' name='uname' value='<?php echo $user;?>'/>
                            <input type='hidden' name='uuidproduk' value='<?php echo $baris['uuidproduk'];?>'/>
                            <input type='hidden' name='harga' value='<?php echo $baris['harga'];?>'/>
							<input type='hidden' name='jumlah_stok' value='<?php echo $baris['jumlah_stok'];?>'/>
							<div class="col-sm-12 p-b-5">
								<label class="stext-102 cl3">Total Harga</label>
								<div class="rs1-select2 rs2-select2 bor8 bg0 mb-3 mt-2">
									<input class="form-control" id="total_harga" type="text" name="total_harga" readonly>
								</div>
							</div>
                            <div class="col-sm-6 p-b-5">
                                <label class="stext-102 cl3" for="review">Nama Pemesan</label>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="nama_pemesan" type="text" name="nama_pemesan" required>
                                </div>
                            </div>
                            <div class="col-sm-6 p-b-5">
                                <label class="stext-102 cl3" for="review">No. HP yang Bisa Dihubungi</label>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="no_hp_pemesan" type="text" name="no_hp_pemesan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
							<div class="col-sm-6 p-b-5">
								<label class="stext-102 cl3">Jumlah yang dipesan</label>
								<div class="rs1-select2 rs2-select2 bor8 bg0 mb-3">
									<select class="form-control" name="qty" id="qty" required>
										<?php for ($i = 1; $i <= $baris['jumlah_stok']; $i++) {
											echo "<option value='$i'>$i</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6 p-b-5">
								<label class="stext-102 cl3">Diskon Saya</label>
								<div class="rs1-select2 rs2-select2 bor8 bg0 mb-3">
									<select class="form-control" name="uuiddiskonrwd" id="uuiddiskonrwd">
										<option value=''>Pilih...</option>
										<?php
											$sql3 = "SELECT * FROM d_diskon_reward rw WHERE rw.uuiddiskonrwd NOT IN (
												SELECT uuiddiskonrwd 
												FROM f_invoice_shoficraft_dtl 
												WHERE uuiddiskonrwd IS NOT NULL
											)
											AND rw.uuiduser_reward = '$uuiduser'
											AND rw.tgl_jatuh_tempo >= NOW();
											";
											$hasil3 = $db->query($sql3);
											while($baris3 = $hasil3->fetch(PDO::FETCH_ASSOC)) {
												echo "<option  value='".$baris3['uuiddiskonrwd']."' data-disc='".$baris3['disc_amount']."'>".$baris3['nama_diskon'].' - Rp. '.number_format($baris3['disc_amount'])."</option>";
											}
										?>
									</select>
								</div>
                        </div>
                        <div class="col-sm-13 p-b-5" style="margin-left:0.3%">
                            <label class="stext-102 cl3" for="review">Alamat Pengiriman</label>
                            <textarea class="size-110 bor8 stext-102 p-lr-5 p-tb-5" id="deskripsi" name="alamat" required></textarea>
                        </div>
                        <div class="row mt-3" style="margin-left:0.3%">
                            <div class="col-sm-14 p-b-5">
                                <button name="buat_invoice" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                    Buat Invoice Pesanan
                                </button>
                            </div>
                        </div>
                        <!-- <div class="row mt-3">
                            <div class="col-sm-12 p-b-5">
                                <a href="#" target="_blank" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                    <i class="fab fa-whatsapp fa-lg"></i> Chat via WhatsApp
                                </a>
                            </div>
                        </div> -->
                    </form>
                </div>

				</div>
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
					button.innerHTML = isAdding ? '<i class="fa-solid fa-heart" style="color: red; font-size:160%"></i>' : '<i class="fa-solid fa-heart" style="color: lightgray; font-size:160%"></i>';
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
		document.addEventListener("DOMContentLoaded", function () {
		const harga = parseInt(document.querySelector("input[name='harga']").value);
		const qtySelect = document.getElementById("qty");
		const diskonSelect = document.getElementById("uuiddiskonrwd");
		const totalHargaInput = document.getElementById("total_harga");

		function formatRupiah(angka) {
			return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		}

		function updateTotal() {
			const qty = parseInt(qtySelect.value) || 0;

			// Ambil data-disc dari option yang dipilih
			const selectedOption = diskonSelect.options[diskonSelect.selectedIndex];
			const diskon = parseInt(selectedOption.getAttribute('data-disc')) || 0;

			const total = (harga * qty) - (diskon * qty);
			totalHargaInput.value = formatRupiah(total > 0 ? total : 0);
		}

		qtySelect.addEventListener("change", updateTotal);
		diskonSelect.addEventListener("change", updateTotal);
		updateTotal();
	});
	</script>

</body>
</html>