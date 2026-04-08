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
    // if ((!isset($_SESSION['uname'])) or (isset($_SESSION['uname']) AND $role_id != 2)) {
	// 	header('location:index_pencari_kos.php');
	// }
?>
<html lang="en">
<head>
	<title>Katalog Partner</title>
	<style>
	.harga-box {background-color: #DCCEF9; /* Warna ungu kalem */border-radius: 8px; /* Sudut membulat */padding: 6px 8px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */font-size: 65%; /* Ukuran font */font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
	}
	.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	#nav_katalog_partner {color:#717fe0}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
					KATALOG PRODUK SHOFICRAFT
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
		<div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
			<a href='daftar_invoice'><button style="top: 10px; right: 10px; background-color: #717fe0; color: white;
            border: none; padding: 5px 10px; border-radius: 10px; cursor: pointer; font-size: 14px;">Daftar Invoice Saya</button></a>
		</div>
		<div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
			<a href="index_pencari_kos.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
            <a class="stext-109 cl8 hov-cl1 trans-04">
				Katalog Produk Shoficraft
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
		</div>
	</div>
		

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					KATALOG PRODUK SHOFICRAFT
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
						Cari produk berdasarkan nama
					</div>
				</div>
				
				<?php
				$nama_produk_cari = "";
				// $jenis_sewa_filter  = "";
				// $harga_dari = 0;
				// $harga_sampai = 100000000;
				$id_kategori_filter = null;
				
				if (isset($_POST['cari_produk'])) {
					$nama_produk_cari = "";
					$id_kategori_filter  = "";
					$harga_dari = 0;
					$harga_sampai = 100000000;
					$nama_produk_cari = $_POST['nama_produk'];
				}

				if (isset($_POST['cari_kosan_filter'])) {
					// $harga_dari = $_POST['harga_dari'];
					// $harga_sampai = $_POST['harga_sampai'];
					$id_kategori_filter = $_POST['id_kategori'];
					$nama_produk_cari = "";
					// if ($harga_dari == null) {
					// 	$harga_dari = 0;
					// }
					// if ($harga_sampai == null) {
					// 	$harga_sampai = 100000000;
					// }
				}
				?>
				<!-- Berdasarkan Nama -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<form method="post" action="#">
					<div class="bor8 dis-flex p-l-15">
							<input class="mtext-107 cl2 size-114 plh2 p-r-15" value="<?php echo $nama_produk_cari;?>" type="text" name="nama_produk" placeholder="Search">
							<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" name="cari_produk">
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
						<div style="display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 20px;">
							<!-- tujuan -->
							<div style="flex: 1; margin-right: 10px; margin-bottom: 10px;">
								<label for="jenis-sewa" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">Kategori:</label>
								<select name="id_kategori" id="jenis-sewa" style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									<option value="">All</option>
									<?php
										$sql2 = "SELECT*FROM kategori_produk_shoficraft";
										$hasil2 = $db->query($sql2);
										while ($baris2 = $hasil2->fetch(PDO::FETCH_ASSOC)) {
											$id_kategori = $baris2['id_kategori'];
											$nama_kategori = $baris2['nama_kategori'];
									?>	
										<option value=<?php echo $id_kategori;?> <?= ($id_kategori == $id_kategori_filter) ? 'selected' : '' ?>><?php echo $nama_kategori;?></option>
									<?php
										}
									?>
								</select>
							</div>

							<!-- Harga -->
							<!-- <div style="flex: 1; margin-right: 10px; margin-bottom: 10px;">
								<label for="harga-dari" style="font-size: 16px; color: #333; display: block; margin-bottom: 5px;">Harga:</label>
								<div style="display: flex; justify-content: space-between;">
									<input name="harga_dari" id="harga-dari" value="<?php echo $harga_dari;?>" type="number" placeholder="100000" style="width: 48%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
									<span style="align-self: center;">-</span>
									<input name="harga_sampai" id="harga-sampai" value="<?php echo $harga_sampai;?>" type="number" placeholder="500000" style="width: 48%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
								</div>
							</div> -->
						</div>

						<!-- Tombol Pencarian -->
						<button name="cari_kosan_filter" type="submit" style="width: 100%; padding: 10px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Cari Produk</button>
					</form>
				</div>
			</div>
            <div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
				<?php
				if ($id_kategori_filter == null) {
					$sql = "SELECT kat.nama_kategori, r.uuidproduk, r.jumlah_stok, r.nama_produk, r.deskripsi, r.id_kategori, r.bahan, TO_CHAR(r.harga, 'L999G999G999') harga
							FROM produk_shoficraft r
							LEFT JOIN kategori_produk_shoficraft kat on kat.id_kategori = r.id_kategori
							where upper(r.nama_produk) like upper('%$nama_produk_cari%') ORDER BY harga asc";
				} else {
					$sql = "SELECT kat.nama_kategori, r.uuidproduk, r.jumlah_stok, r.nama_produk, r.deskripsi, r.id_kategori, r.bahan, TO_CHAR(r.harga, 'L999G999G999') harga
							FROM produk_shoficraft r
							LEFT JOIN kategori_produk_shoficraft kat on kat.id_kategori = r.id_kategori
							WHERE r.id_kategori = $id_kategori_filter
							AND upper(r.nama_produk) like upper('%$nama_produk_cari%') ORDER BY harga asc";
				}
                $hasil = $db->query($sql);

                while ($baris = $hasil->fetch(PDO::FETCH_ASSOC)) {
					$nama_produk = $baris['nama_produk'];
					$uuidproduk = $baris['uuidproduk'];

					$sql6 = "SELECT uuidprodukgambar, filename, berkas
					FROM public.produk_shoficraft_gambar where uuidproduk = '$uuidproduk' order by berkas desc limit 1";
					$hasil6 = $db->query($sql6);
					$baris6 = $hasil6->fetch(PDO::FETCH_ASSOC);
                ?>
				<form action="katalog_partner_detail.php?upr=<?php echo $uuidproduk;?>&iv=N" method="POST" class="card">
					<input type="hidden" name="kosan_id" value="1" />
					<button type="submit" value="<?php echo $uuidproduk; ?>" name="klik_<?php echo $uuidproduk; ?>">
						<div class="rounded-xl overflow-hidden shadow-md border bg-white hover:shadow-lg transition">
							<img src="<?php echo $baris6['berkas'];?>" class="w-full h-48 object-cover" alt="" />
							<div class="p-4">
								<h2 class="text-lg font-semibold text-gray-800" style="text-align:justify"><?php echo $nama_produk;?></h2>
								<p style='text-align:justify'><?php echo $baris['deskripsi'];?></p>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">💰 <?php echo $baris['harga'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📅 Kategori : <?php echo $baris['nama_kategori'];?></span>
									<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">🧶 <?php echo $baris['jumlah_stok'];?> stok tersisa</span>
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