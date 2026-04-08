<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div style="color:#f9c17d; font-size:13px">
						Ingin dibantu dibuatkan sistem untuk tugas akhir/penelitian? Klik <a style='color:white' href='https://forms.gle/i6S7ruSrUjZHKUty9' target='blank'> di sini</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="index.php" class="logo" style="flex-shrink: 0;">
						<img src="images/logo_kolabsistem.png" style="width: 135px; height: auto; display: block;">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a id="nav_home" href="index.php">Home</a>
								<!-- <ul class="sub-menu">
									<li><a href="index.html">Homepage 1</a></li>
									<li><a href="home-02.html">Homepage 2</a></li>
									<li><a href="home-03.html">Homepage 3</a></li>
								</ul> -->
							</li>
							<?php
                              if ($user != 'Login' AND $role_id == 1) {
                                    echo "<li><a id='nav_kosan_saya' href='modul_saya.php'>Portofolio Saya</a></li>";
							  }
							  if ($user != 'Login') {
							  		echo "<li><a id='undangan_kolab_saya' href='undangan_kolab_saya.php'>Undangan Kolab Saya</a></li>";
							  }	
									echo "<li class='label1' data-label1='Gratis'>";
                                        echo "<a id='nav_promosi_mahasiswa' href='promosi_mahasiswa.php'>Promosi Mahasiswa</a>";
                                    echo "</li>";
                              if ($user != 'Login' AND $role_id == 1) {
									echo "<li class='label1' data-label1='Cek'>";
                                    echo "<a id='nav_rekap_bulanan' href='rekap_pengunjung.php'>Rekap Bulanan</a>";
                                    echo "</li>";
                                    echo "<li class='label1' data-label1='Cek'>";
                                        echo "<a id='nav_rekap_harian' href='rekap_pengunjung_harian.php'>Rekap Harian</a>";
                                    echo "</li>";
									/*echo "<li class='label1' data-label1='Hot'>";
                                        echo "<a id='nav_shoficraft' href='#'>Produk Keren Shoficraft</a>";
                                    echo "</li>";
									echo "<li><a id='nav_donasi' href='donasi.php' class='harga-box' style='font-size:12; padding:7px 6px; background:#ffb777' href='#'>";
										echo "❤️ Beri Donasi";
									echo "</a></li>";*/
                                }
								// echo "<li>";
								// 	echo "<a id='nav_jasa_buat_sistem' target='_blank' href='https://forms.gle/i6S7ruSrUjZHKUty9'>Jasa Buat Sistem Custom</a>";
								// echo "</li>";
							?>

							<!-- <li>
								<a id="nav_video_reg_pemilik_kos" href="video_registrasi_pemilik_kos.php">Video Tutorial Registrasi Penjual Modul</a>
							</li> -->
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
							if ($user != 'Login') {
						?>
						<a href="riwayat_add_fav.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-notifications-active"></i>
							<span id="notif-wishlist-count" class="notif-wishlist-count">0</span>
						</a>
						<!-- <a href="riwayat_add_ulasan.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-comment"></i>
							<span id="notif-ulasan-count" class="notif-ulasan-count">0</span>
						</a> -->
						<a href="fav_pencari_modul.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-favorite-outline"></i>
							<span id="wishlist-count" class="wishlist-count">0</span>
						</a>
						<?php
							}
						?>
                        <?php
							if ($user == 'Login') {
								echo "<a class='btn btn-icon btn-transparent-dark dropdown-toggle' id='navbarDropdownUserImage' href='login' role='button' aria-expanded='false'>👥 ".$user."</a>";
							}
							else {
								echo "<a class='btn btn-icon btn-transparent-dark dropdown-toggle' id='navbarDropdownUserImage'
									href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'
									style='max-width: 120px; display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;'
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
							<a class="dropdown-item" href="profil.php?st=N"
								><div class="dropdown-item-icon"><i data-feather="settings"></i></div>
								Profil Akun Saya</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#ganti_password_modal"
								><div class="dropdown-item-icon"><i data-feather="settings"></i></div>
								Ganti Password</a>
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
			<div class="logo-mobile" style="flex-shrink: 0; display: flex; align-items: center;">
				<a href="index.php" class="logo" style="display: inline-flex; align-items: center;">
					<img src="images/logo_kolabsistem.png" alt="Logo" style="width: 170px; height: auto; display: block;">
				</a>			
			</div>
			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
					<?php
						if ($user != 'Login') {
					?>
					<a href="riwayat_add_fav.php" class="flex items-center relative text-gray-700 hover:text-#717fe0-600 transition-all px-3 sm:px-5 text-[20px] sm:text-[22px]">
						<i class="zmdi zmdi-notifications-active"></i>
						<span id="notif-wishlist-count" class="notif-wishlist-count">0</span>					
					</a>

					<!-- <a href="riwayat_add_ulasan.php" class="flex items-center relative text-gray-700 hover:text-#717fe0-600 transition-all px-3 sm:px-5 text-[20px] sm:text-[22px]">
						<i class="zmdi zmdi-comment"></i>
						<span id="notif-ulasan-count" class="notif-ulasan-count">0</span>					
					</a> -->
					<a href="fav_pencari_modul.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
						<i class="zmdi zmdi-favorite-outline"></i>
						<span id="wishlist-count" class="wishlist-count">0</span>
					</a>

					<?php
					}
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
								style='max-width: 80px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: inline-block; font-size: 13px;'
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
					<a class="dropdown-item" href="profil.php?st=N"
						><div class="dropdown-item-icon"><i data-feather="settings"></i></div>
						Profil</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#ganti_password_modal">
						<div class="dropdown-item-icon"><i data-feather="settings"></i></div>
						Ganti Password</a>
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
				<li id="home_mobile">
					<a href="index.php">Home</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="index.html">Homepage 1</a></li>
						<li><a href="home-02.html">Homepage 2</a></li>
						<li><a href="home-03.html">Homepage 3</a></li>
					</ul> -->
					<!-- <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>

				<?php
					if ($user != 'Login' AND $role_id == 1) {
						echo "<li id='porto_saya_mobile'><a href='modul_saya.php'>Portofolio Saya</a></li>";
					}
					if ($user != 'Login') {
						echo "<li id='undangan_kolab_saya_mobile'><a href='undangan_kolab_saya.php'>Undangan Kolab Saya</a></li>";
					}
						echo "<li id='promosi_mahasiswa_mobile'>";
							echo "<a href='promosi_mahasiswa.php' class='label1 rs1' data-label1='Gratis'>Promosi Mahasiswa &nbsp</a>";
						echo "</li>";
					if ($user != 'Login' AND $role_id == 1) {
						echo "<li id='rekap_pengunjung_mobile'>";
							echo "<a href='rekap_pengunjung.php' class='label1 rs1' data-label1='Cek'>Rekap Bulanan &nbsp</a>";
						echo "</li>";
						echo "<li id='rekap_pengunjung_harian_mobile'>";
							echo "<a href='rekap_pengunjung_harian.php' class='label1 rs1' data-label1='Cek'>Rekap Harian &nbsp</a>";
						echo "</li>";
						/*echo "<li>";
							echo "<a href='#' class='label1 rs1' data-label1='HOT'>Produk keren Shoficraft&nbsp</a>";
						echo "</li>";
						echo "<li><a href='donasi.php'>❤️ Beri Donasi</a></li>";*/
					}
					echo "<li id='jasa_buat_sistem'>";
						echo "<a href='https://forms.gle/i6S7ruSrUjZHKUty9' target='_blank'>Jasa Pembuatan Sistem Custom</a>";
					echo "</li>";
				?>
				<!-- <li>
					<a id="nav_video_reg_pemilik_kos" href="video_registrasi_pemilik_kos.php">Video Tutorial Registrasi Pemilik kos</a>
				</li> -->
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
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
		</div>
	</header>

	<!--GANTI PASSWORD MODAL -->
	<div style="margin-top:10%" class="modal fade" id="ganti_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" action="ganti_password_proses.php" method="post" style="padding:1% 3% 0 3%" id="form_tambah">
                    <div style="flex: 1; margin-right: 10px; margin-bottom: 10px;">
                        <p><b>Password Baru</b></p>
                        <div class="form-group" style="position:relative">
                            <input required name="password_baru" type="password" class="form-control" id="inputPassword" placeholder="Masukkan Password">
                            <!-- Tombol mata -->
                            <span onclick="togglePassword()" 
                                style="position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer;">
                                👁️
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="ganti_password" id="btn_tambah">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<script>
		let lastWishlistCount = 0;
		let lastUlasanCount = 0;

		function checkWishlistNotif() {
			fetch('wishlist_count_penjual_modul.php')
				.then(response => response.json())
				.then(data => {
					if (data.status === 'success') {
						const currentCount = parseInt(data.count);

						if (currentCount !== lastWishlistCount) {
							// Update semua elemen dengan class .wishlist-count
							document.querySelectorAll('.notif-wishlist-count').forEach(el => {
								el.textContent = currentCount || 0;
							});

							// Tambahkan efek jika bertambah
							if (currentCount > lastWishlistCount) {
								console.log("Ada wishlist baru!");
								// Efek tambahan: mainkan suara, ubah ikon, dsb.
							}

							lastWishlistCount = currentCount;
						}
					}
				})
				.catch(err => {
					console.error("Gagal cek notifikasi wishlist:", err);
				});
		}

		function checkUlasanNotif() {
			fetch('ulasan_count.php')
				.then(response => response.json())
				.then(data => {
					if (data.status === 'success') {
						const currentCount = parseInt(data.count);

						if (currentCount !== lastUlasanCount) { // ✅ FIX
							document.querySelectorAll('.notif-ulasan-count').forEach(el => {
								el.textContent = currentCount || 0;
							});

							if (currentCount > lastUlasanCount) {
								console.log("Ada ulasan baru!");
							}

							lastUlasanCount = currentCount; // ✅ FIX
						}
					}
				})
		}

		// Jalankan pertama kali
		checkWishlistNotif();
		checkUlasanNotif();

		// Jalankan setiap 5 detik
		setInterval(checkWishlistNotif, 5000);
		setInterval(checkUlasanNotif, 5000);
	</script>
	<script>
        function togglePassword() {
            const input = document.getElementById("inputPassword");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>