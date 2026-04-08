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

	if ($st_penjual == 'Y') {
		header('location:index_pencari_modul.php');
	}
	// if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 1)) {
	// 	header('location:index_pencari_kos.php');
	// }
?>
<html lang="en">
<head>
	<title>Tutorial Daftar Pemilik Kos</title>
	<style>
    #nav_video_reg_pemilik_kos {color:#717fe0}
	.harga-box {background-color: #DCCEF9; /* Warna ungu kalem */border-radius: 8px; /* Sudut membulat */padding: 8px 12px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */font-size: 16px; /* Ukuran font */font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
    }
	.wishlist-icon {position: relative; display: flex;align-items: center;}
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
<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="index_pencari_kos.php" class="logo">
						<img src="images/logo_ngekos2.svg" width="150px">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a id="nav_home" href="index_pencari_kos">Home</a>
								<!-- <ul class="sub-menu">
									<li><a href="index.html">Homepage 1</a></li>
									<li><a href="home-02.html">Homepage 2</a></li>
									<li><a href="home-03.html">Homepage 3</a></li>
								</ul> -->
							</li>

							<?php
								if ($user != 'Login') {
									echo "<li>";
									echo "<a id='nav_reward_diskon' href='reward_diskon'>Reward Diskon</a>";
									echo "</li>";
								}
							?>

                            <?php
                                if ($user != 'Login') {
                                    echo "<li class='label1' data-label1='Eksklusif'>";
                                        echo "<a id='nav_katalog_partner' href='katalog_partner'>Katalog Produk Partner</a>";
                                    echo "</li>";
                                }
								if ($user == 'admin_shoficraft') {
                                    echo "<li>";
                                        echo "<a id='nav_tambah_produk_partner' href='tambah_produk_shoficraft.php'>Tambah produk</a>";
                                    echo "</li>";
									 echo "<li>";
                                        echo "<a id='nav_cek_invoice' href='cek_invoice.php'>Cek Invoice</a>";
                                    echo "</li>";
                                }
                            ?>
							<li>
								<a id="nav_video_reg_pemilik_kos" href="video_registrasi_pemilik_kos.php">Video Tutorial Registrasi Pemilik kos</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<!-- <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a> -->

                        <?php
							if ($user == 'Login') {
								echo "<a class='btn btn-icon btn-transparent-dark dropdown-toggle' id='navbarDropdownUserImage' href='login' role='button' aria-expanded='false'>👥 ".$user."</a>";
							}
							else {
								echo "<a class='btn btn-icon btn-transparent-dark dropdown-toggle' id='navbarDropdownUserImage' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>👥 ".$user."</a>";

							}
						?>
                   		<div id="nav_login" class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
							<h6 class="dropdown-header d-flex align-items-center">
								<div class="dropdown-user-details">
									<div class="dropdown-user-details-name"><?php echo $user;?></div>
									<div class="dropdown-user-details-email"><?php echo $nama_lengkap;?></div>
								</div>
							</h6>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="profil_pencari_kos.php?st=N"
								><div class="dropdown-item-icon"><i data-feather="settings"></i></div>
								Profil Akun Saya</a>
							<a class="dropdown-item" href="logout"
								><div class="dropdown-item-icon"></div>
								Logout</a>
                    	</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index_pencari_kos.php"><img src="images/logo_ngekos2.svg" width="150px"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <?php
					if ($user == 'Login') {
						echo "<a class='btn btn-icon btn-transparent-dark dropdown-toggle' id='navbarDropdownUserImage' href='login' role='button' aria-expanded='false'>👥 ".$user."</a>";
					}
					else {
						echo "<a class='btn btn-icon btn-transparent-dark dropdown-toggle' 
								id='navbarDropdownUserImage' 
								href='javascript:void(0);' 
								role='button' 
								data-toggle='dropdown' 
								aria-haspopup='true' 
								aria-expanded='false' 
								style='max-width: 120px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: inline-block; font-size: 13px;'
								title='".$user."'>
								👥 ".$user."
							</a>";
					}
				?>
				<div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
					<h6 class="dropdown-header d-flex align-items-center">
						<div class="dropdown-user-details">
							<div class="dropdown-user-details-name"><?php echo $user;?></div>
							<div class="dropdown-user-details-email"><?php echo $nama_lengkap;?></div>
						</div>
					</h6>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="profil_pencari_kos.php?st=N"
						><div class="dropdown-item-icon"><i data-feather="settings"></i></div>
						Profil Akun Saya</a>
					<a class="dropdown-item" href="logout"
						><div class="dropdown-item-icon"></div>
						Logout</a>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="index_pencari_kos.php">Home</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="index.html">Homepage 1</a></li>
						<li><a href="home-02.html">Homepage 2</a></li>
						<li><a href="home-03.html">Homepage 3</a></li>
					</ul> -->
					<!-- <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>
				<li>
					<a href="video_registrasi_pemilik_kos.php">Video Tutorial Registrasi Pemilik kos</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<!-- <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div> -->
	</header>
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
		</div>
	</div>

    <!-- breadcrumb -->
	<!-- <div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="#" class="stext-109 cl8 hov-cl1 trans-04">
				Riwayat Ulasan
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
		</div>
	</div> -->

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h5 style="text-align:center; font-size:130%; font-weight:bold">
					Video Tutorial Registrasi Pemilik Kos
				</h5>
			</div><br>

            <div class="space-y-4">
                <div style="
                position: relative; 
                width: 100%; 
                max-width: 800px; 
                margin: auto; 
                aspect-ratio: 16 / 9;
                max-height: 450px; 
                ">
                <iframe 
                    src="https://www.youtube.com/embed/uhtgim7y7oY?autoplay=1&mute=0&rel=0" 
                    style="width: 100%; height: 100%; border: 0;" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen>
                </iframe>
                </div>
            </div>
        </div>
	</section><br><br><br><br><br><br><br><br>


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
                document.getElementById('wishlist-count').textContent = result.count || 0;
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