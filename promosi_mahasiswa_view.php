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
		header('location:login.php');
	}
	
	$id_promosi = $_GET['md'];
	$id_kat_promosi = $_GET['fk'];

	if (!isset($_GET['rt'])) {
		$rating_form = 1;
	}
	else {
		echo "<script>alert('Silakan isi rating terlebih dahulu dalam ulasan');</script>";
	}
	

?>
<html lang="en">
<head>
	<title>Detail Usaha</title>
	<style>
        #nav_promosi_mahasiswa {color:#717fe0}
		.harga-box {
        background-color: #DCCEF9; /* Warna ungu kalem */
        border-radius: 8px; /* Sudut membulat */
        padding: 8px 12px; /* Ruang di dalam box */
        display: inline-block; /* Agar elemen hanya selebar isinya */
        font-size: 16px; /* Ukuran font */
        font-weight: bold; /* Teks tebal */
        color: #4B0082; /* Warna teks ungu lebih gelap */
		margin-bottom:2%
    }
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
	.wishlist-icon {position: relative; display: flex;align-items: center;}
    .wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
	.notif-ulasan-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
    .notif-wishlist-count {position: absolute;top: -5px;right: -5px;background: red;color: white;font-size: 12px;font-weight: bold;padding: 3px 7px;border-radius: 50%;}
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
	.radio-group {
	display: flex; flex-wrap: wrap; gap: 1rem; /* Awalnya 2rem, sekarang lebih rapat */
	background: #fff; padding: 1rem 1.5rem; /* Diperkecil juga */
	border-radius: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); justify-content: start;
	}

	.radio-option {
	display: flex; flex-direction: column; align-items: center; cursor: pointer; transition: all 0.2s ease;
	width: 60px; /* Atur lebar agar tetap sejajar dan rapi */
	}

	.radio-option input[type="radio"] {
	appearance: none; width: 1rem; height: 1rem; border: 2px solid #717fe0; border-radius: 50%;
	outline: none; margin-bottom: 0.3rem; /* sedikit lebih rapat ke teks */
	transition: 0.2s ease;
	}

	.radio-option input[type="radio"]:checked {
	background-color: #717fe0; box-shadow: 0 0 0 3px rgba(113, 127, 224, 0.3);
	}

	.radio-option span {
	font-size: 10px; color: #333; text-align: center;
	}

	.pdf-page {position: relative; margin-bottom: 20px;}
 	.pdf-overlay {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); /* lapisan putih semi transparan */
    display: flex; justify-content: center; align-items: center; text-align: center; font-size: 1.2rem; font-weight: bold; color: #b91c1c; /* merah */ padding: 10px;
	}

	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js"></script>
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

	<!-- breadcrumb -->
	<div class="container">
		<br>
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href='promosi_mahasiswa.php?md=<?php echo $id_promosi;?>&fk=<?php echo $id_kat_promosi;?>'>
				<button class="btn btn-primary ms-auto"><i class="fa-solid fa-arrow-left"></i> Kembali</button></a>
		</div>
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-20 p-lr-0-lg">
			<a href="index.php?md=<?php echo $id_promosi;?>&fk=<?php echo $id_kat_promosi;?>" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a class="stext-109 cl8 hov-cl1 trans-04">
				View Usaha
			</a>
		</div>
	</div>

	<div style="display: flex; justify-content: center; padding: 0.4rem;">
		<form class="radio-group" method="GET" action="ruangan_kosan_view.php">
			<input type="hidden" name="rk" value="<?php echo htmlspecialchars($id_promosi); ?>">
		</form>
	</div>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-5 p-b-60" style="margin-top:-1%">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<?php
							if (isset($_POST["klik_$id_promosi"]) AND isset($uuiduser)) {
								$sql9 = "SELECT count(1) jml_visitor FROM f_klik_pengunjung_promosi_log
								WHERE createdate::date =CURRENT_DATE AND userklik = '$uuiduser' AND id_promosi = '$id_promosi'";
								$hasil9 = $db->query($sql9);
								$baris9 = $hasil9->fetch(PDO::FETCH_ASSOC);

								if ($baris9['jml_visitor'] == 0) {
									$sql3 = "INSERT INTO f_klik_pengunjung_promosi_log(id_promosi, ip_address, userklik, inc_klik) VALUES (:id_promosi, :ip_address, :uuiduser, 1)";
									$stmt3 = $db->prepare($sql3);
									$stmt3->execute(['id_promosi' => $id_promosi, 'ip_address' => $ip_address, 'uuiduser' => $uuiduser]);

									$sql4 = "SELECT sum(inc_klik) jml_klik from f_klik_pengunjung_promosi_log where id_promosi = $id_promosi";
									$hasil4 = $db->query($sql4);
									$baris4 = $hasil4->fetch(PDO::FETCH_ASSOC);

									$jml_klik = $baris4['jml_klik'];
									
									$sql5 = "UPDATE d_promosi_mahasiswa set jml_klik = $jml_klik where id_promosi = :id_promosi";
									$stmt5 = $db->prepare($sql5);
									$stmt5->execute(['id_promosi' => $id_promosi]);
								}
							}

							$sql = "SELECT u.angkatan, m.nama_promosi, m.keterangan, m.id_promosi, substring(u.fname FROM '\S+$') fname, m.filename,
							m.jml_klik, j.nama_kategori_promosi, v.nama_univ, f.nama_fakultas, p.nama_prodi, u.kode_fakultas, u.gender, link
							from d_promosi_mahasiswa m 
							left join user_pengguna u on u.uuiduser = m.uuiduser
							left join d_univ v on v.kode_univ = u.kode_univ
							left join d_fakultas f on f.kode_fakultas = u.kode_fakultas
							left join d_prodi p on p.kode_prodi = u.kode_prodi
							left join d_kategori_promosi j on j.id_kat_promosi = m.id_kat_promosi
							where m.id_promosi = $id_promosi
							";
							//$hasil = mysqli_query($koneksi, $sql);
							//$baris = mysqli_fetch_array($hasil);
							$hasil = $db->query($sql);
							$baris = $hasil->fetch(PDO::FETCH_ASSOC);

                            if ($baris['link'] == NULL) {
                                $capt_link = '';
                            }
                            else {
                                $capt_link = 'Kunjungi : ';
                            }
						?>
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="<?php echo 'uploads/promosi/'. $baris['filename'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="uploads/promosi/<?php echo $baris['filename'];?>" alt="IMG-PRODUCT" style="height:270px">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="uploads/promosi/<?php echo $baris['filename'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					
				<?php
					switch ($baris['gender']) {
						case 'L':
							$caption_gender = "👨 Oleh : Mr. ". $baris['fname'];
							break;
						case 'P':
							$caption_gender = "👧 Oleh : Mrs. ". $baris['fname'];
							break;
					}
				?>
				<div class="col-md-6 col-lg-5 p-b-30">
					<?php
						$sql2 = "SELECT uuiduser FROM d_promosi_mahasiswa WHERE id_promosi = $id_promosi";
						$hasil2 = $db->query($sql2);
						$baris2 = $hasil2->fetch(PDO::FETCH_ASSOC);

						if ($baris2['uuiduser'] == $uuiduser) {
					?>
					<div class="size-204 flex-w flex-m respon6-next">
						<form action='promosi_mahasiswa_edit.php?rk=<?php echo $id_promosi;?>&st=N' method='POST' style="margin-right: 3%;">
							<input type='hidden' name='to_detail' value='<?php echo $id_promosi;?>'/>
							<button name="edit" class="btn btn-success ms-auto"><i class="fa-solid fa-pencil"></i> Update</button>								
						</form>
						<form action='promosi_mahasiswa_hapus.php?md=<?php echo $id_promosi;?>' 
							method='POST' 
							style="margin-right: 3%;"
							onsubmit="return confirm('Apakah Anda yakin ingin menghapus promosi usaha ini?Pengunjung lain tidak akan lagi bisa melihat usaha ini');">
							<button name="hapus" class="btn btn-danger ms-auto">
								<i class="fa-solid fa-trash"></i> Hapus
							</button>
						</form>
					</div>
					<?php
						}
					?>
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $baris['nama_promosi'];?>
						</h4>
						<span class="harga-box" style="font-size:12">
                            <?php echo $caption_gender; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            📒 <?php echo $baris['nama_kategori_promosi']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            🏛️ <?php echo $baris['nama_univ']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            🏫 <?php echo $baris['kode_fakultas']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            📚 <?php echo $baris['nama_prodi']; ?>
                        </span>
						<span class="harga-box" style="font-size:12">
                            🎓 Angkatan : <?php echo $baris['angkatan']; ?>
                        </span>
                        <hr style='background:black; margin-top:3%' ></hr>
						<p class="stext-102 cl3 whitespace-pre-line">
						  <?= htmlspecialchars($baris['keterangan']) ?>
						</p>
						<p class="stext-102 cl3 p-t-23">
                            <?php echo $capt_link;?><a style='color:blue; text-decoration:underline' target='_blank' href='<?php echo $baris['link'];?>'><?php echo $baris['link'];?></a>
                        </p><br>
					</div>
				</div>
			</div><br><br>

			<div class="p-b-7" style='margin-top:-7px'>
				<h3 class="ltext-103 cl5" style="font-size:20px">
					<?php
						$sql12 = "SELECT*FROM d_promosi_mahasiswa where id_promosi = $id_promosi";
						$hasil12 = $db->query($sql12);
						$baris12 = $hasil12->fetch(PDO::FETCH_ASSOC);
						$user_pemilik_modul = $baris12['uuiduser'];
					?>
				</h3><br>
			</div><br>
			<h3 class="ltext-103 cl5" style="font-size:20px; margin-top:-3%">
				<?php
					$uuiduser_pemilik = $baris12['uuiduser'];
					$sql9 = "SELECT m.nama_promosi, m.keterangan, m.id_promosi, substring(u.fname FROM '\S+$') fname, m.filename,
					m.jml_klik, j.nama_kategori_promosi, v.nama_univ, f.nama_fakultas, p.nama_prodi, u.kode_fakultas, u.gender
					from d_promosi_mahasiswa m 
					left join user_pengguna u on u.uuiduser = m.uuiduser
					left join d_univ v on v.kode_univ = u.kode_univ
					left join d_fakultas f on f.kode_fakultas = u.kode_fakultas
					left join d_prodi p on p.kode_prodi = u.kode_prodi
					left join d_kategori_promosi j on j.id_kat_promosi = m.id_kat_promosi
					where u.st_active = 'Y' AND m.uuiduser = '$uuiduser_pemilik' AND m.id_promosi <> $id_promosi";
					$hasil9 = $db->query($sql9);

					$hasil9b = $db->query($sql9);
					$baris9b = $hasil9b->fetch(PDO::FETCH_ASSOC);
					if (!isset($baris9b['id_promosi'])) {
						$judul = '';
					}
					else {
						$judul = 'Usaha Menarik Lainnya';
					}
					echo $judul;
				?>
				
			</h3><br>
			<div class="carousel-container">
				<button class="nav-btn nav-left" onclick="moveSlide(-1)">‹</button>
				<div class="carousel-wrapper">
					<div class="flex overflow-x-auto no-scrollbar gap-4" id="track">
						<?php
							while ($baris9 = $hasil9->fetch(PDO::FETCH_ASSOC)) {
								$uuidportos_other = $baris9['id_promosi'];
						?>
						<div class="card">
							<a href="promosi_mahasiswa_view.php?md=<?php echo $baris9['id_promosi'];?>&fk=">
							<img src="uploads/promosi/<?php echo $baris9['filename'];?>" alt="IMG-PRODUCT" style="height:220px">
							</a><br>
							
							
							<a href="promosi_mahasiswa_view.php?md=<?php echo $baris9['id_promosi'];?>&fk=" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<?php echo $baris9['nama_promosi']; ?>
							</a>
								<div class="flex flex-wrap gap-2 mt-3 text-sm">
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">👥 By : <?php echo $baris['fname'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">🏫 <?php echo $baris['kode_fakultas'];?></span>
									<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">📚 <?php echo $baris['nama_prodi'];?></span>
								</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>

				<button class="nav-btn nav-right" onclick="moveSlide(1)">›</button>
			</div>
							</div>
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
                    showSwalMessage(isAdding ? "Berhasil Ditambahkan!" : "Berhasil Dihapus!", isAdding ? "Portofolio ini telah masuk wishlist Anda." : "Portofolio telah dihapus dari wishlist.", "success");

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
                // canvas.style.filter = "blur(5px)";
                // canvas.style.opacity = "0.5"; 

                // const overlay = document.createElement("div");
                // overlay.classList.add("pdf-overlay");
                // overlay.innerText = "Beli perangkat ajar ini supaya dapat melihat semua halaman";
                // pageWrapper.appendChild(overlay);
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