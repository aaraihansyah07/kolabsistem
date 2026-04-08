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
					<a href="index_pencari_modul.php" class="logo">
						<img src="images/logo_modulpedia2.png" width="150px">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a id="nav_home" href="index_pencari_modul">Home</a>
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

                        <a href="fav_pencari_modul.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-favorite-outline"></i>
							<span id="wishlist-count" class="wishlist-count">0</span>
						</a>

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
							<a class="dropdown-item" href="profil_pencari_modul.php?st=N"
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
				<a href="index_pencari_modul.php"><img src="images/logo_ngekos2.svg" width="150px"></a>
			</div>
            <a href="fav_pencari_modul.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                <i class="zmdi zmdi-favorite-outline"></i>
                <span id="wishlist-count" class="wishlist-count">0</span>
            </a>

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
					<a href="index_pencari_modul.php">Home</a>
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
					if ($user != 'Login') {
						echo "<li>";
						echo "<a href='reward_diskon.php'>Reward Diskon</a>";
						echo "</li>";
					}
				?>

				<?php
					if ($user != 'Login') {
						echo "<li>";
							echo "<a href='katalog_partner.php' class='label1 rs1' data-label1='Ekslusif'>Katalog Produk Partner &nbsp</a>";
						echo "</li>";
					}
					if ($user == 'admin_shoficraft') {
						echo "<li>";
							echo "<a href='tambah_produk_shoficraft.php'>Tambah produk</a>";
						echo "</li>";
						echo "<li>";
							echo "<a href='cek_invoice.php'>Cek Invoice</a>";
						echo "</li>";
					}
				?>

				<li>
					<a id="nav_video_reg_pemilik_kos" href="video_registrasi_pemilik_kos.php">Video Tutorial Registrasi Pemilik kos</a>
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