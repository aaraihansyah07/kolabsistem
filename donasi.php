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
	// 	header('location:index_pencari_kos');
	// }
?>
<html lang="en">
<head>
	<title>Donasi</title>
	<style>
    #nav_donasi  {color:#717fe0}
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
		include('nav_top_pemilik_kos.php');
	 ?>
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Donasi
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
	
	</div>
		

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					❤️ Beri Donasi
				</h3>
			</div>
            <div style="text-align: justify; padding: 10px; background: #eebb57; border-radius: 4px;">
                <!-- <h3 style='font-weight:bold'>📌 Promosi Usaha Mahasiswa - 100% Gratis</h3><br> -->
                <p>
                    Halaman ini merupakan halaman khusus untuk memberikan donasi kepada KolabSistem supaya tetap terus memberikan dampak positif kepada
                    seluruh civitas di universitas dalam meningkatkan kolaborasi antar mahasiswa, dosen, dan pencari talent serta interaksi antar mahasiswa
                    pada fakultas dan jurusan yang berbeda dalam setiap tujuan yang positif seperti pembentukan tim untuk perlombaan, kolaborasi penelitian,
                    kolaborasi freelance, kolaborasi bisnis, serta fitur promosi gratis usaha/bisnis mahasiswa. Bantuan donasi ini sangat berarti untuk kami dalam mempertahankan maintenance sistem dan server
                    serta dalam hal mewujudkan suatu ide cemerlang lain yang sangat berguna sebagai fitur tambahan dari sistem KolabSistem.
                </p>
                <br>
                <p>
                    Berikut adalah nomor rekening untuk donasi :
                </p>
                <p><b>No. Rek BCA a/n AHMAD AHYA RAIHANSYAH : 2820697653</b></p><br>
                <p>
                    Kami sangat berterimakasih kepada seluruh pihak yang telah memberikan donasinya kepada kami berapapun jumlah donasinya, semoga setiap donasi yang diberikan
                    dapat bermanfaat untuk kemajuan pendidikan di Indonesia khususnya di tingkat universitas dalam membantu mahasiswa Indonesia menjadi lebih siap menghadapi
                    tantangan di era global ini🙏.
                </p><br>
                <p>
                    Setelah Anda mengirimkan donasi, alangkah baiknya Anda menghubungi via chat Admin KolabSistem di nomor <a style='font-weight:bold; color:#03a9f4; text-decoration:none' href='https:wa.me/6287753472949' target='_blank'>6287753472949</a>
                    untuk mengkonfirmasi pengiriman donasi supaya kami dapat
                    menampilkan credit nama Anda sebagai pihak yang telah membantu dalam memberikan donasi kepada KolabSistem
                </p><br>
                <p>*Donasi ini bersikap sukarela dan tidak ada unsur pemaksaan</p>
                <p>*Hati-hati terhadap penipuan yang mengatasnamakan KolabSistem. Kontak resmi hanya melalui: </p>
                <p>Whatsapp  : <a style='font-weight:bold; color:#03a9f4; text-decoration:none' href='https:wa.me/6287753472949' target='_blank'>6287753472949</a></p>
                <p>Instagram : <a style='font-weight:bold; color:#03a9f4; text-decoration:none' href='https:instagram.com/kolabsistem' target='_blank'>@KolabSistem</a></p>
                <br>
            </div><br>
            <div style="text-align: justify; padding: 10px; background: #54a8ff; border-radius: 4px;">
                <h3 style='font-weight:bold; color:white'>🔥 Top Donator : </h3><br>
                <p><a target='_blank' style='color:gold; font-weight:bold' href='http://instagram.com/shoficraft'>Shoficraft - Original Rajut 100% Handmade</a></p>
            </div>
		</div>
	</section><br><br><br>

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
	<!-- <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
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
							</p> -->
							
							<!--  -->
							<!-- <div class="p-t-33">
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
							</div> -->

							<!--  -->
							<!-- <div class="flex-w flex-m p-l-100 p-t-40 respon7">
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
		</div> -->
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