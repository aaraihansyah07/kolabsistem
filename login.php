<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>KolabSistem</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body style="background:#f4f0f0">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-3">
						<img src="./images/logo_kolabsistem.png" alt="logo" width="80%">
					</div>
					<div class="card shadow-lg" style="margin-top:-2%">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4" style="text-align:center">Login</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="#">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Email</label>
									<input id="uname" type="text" class="form-control" name="uname" value="" required autofocus>
									<div class="invalid-feedback">
										Username is invalid
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
										<!-- <a href="forgot.html" class="float-end">
											Forgot Password?
										</a> -->
									</div>
									<div class="form-group" style="position:relative">
										<input id="password" type="password" class="form-control" name="pwd" required>
										<span onclick="togglePassword()" 
											style="position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer;">
											👁️
										</span>
										<div class="invalid-feedback">
											Password is required
										</div>
									</div>
								</div>

								<div class="d-flex align-items-center">
									<!-- <div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Remember Me</label>
									</div> -->
									<button name="login" type="submit" class="btn btn-primary ms-auto">
										Login
									</button>
								</div>
							</form>
						</div>
						<?php
							include('koneksi.php');
							if (isset($_POST['login'])) {
								$uname = $_POST['uname'];
								$pwd = $_POST['pwd'];

								// Ambil data user berdasarkan uname
								$sql = "SELECT st_penjual, email, uuiduser, fname, role_id, pword FROM user_pengguna WHERE lower(email) = lower(:uname) AND st_active = 'Y' LIMIT 1";
								$stmt = $db->prepare($sql);
								$stmt->bindParam(':uname', $uname);
								$stmt->execute();
								$user = $stmt->fetch(PDO::FETCH_ASSOC);

								// Verifikasi password
								if ($user && crypt($pwd, $user['pword']) === $user['pword']) {
									session_start();
									$_SESSION['uname'] = $user['email'];
									$_SESSION['uuiduser'] = $user['uuiduser'];
									$_SESSION['nama_lengkap'] = $user['fname'];
									$_SESSION['role_id'] = $user['role_id'];
									$_SESSION['st_penjual'] = $user['st_penjual'];

									// Redirect sesuai role
									// if ($user['st_penjual'] == 'Y') {
									// 	header('Location: index');
									// } else {
									// 	header('Location: index_pencari_modul');
									// }
									header('Location: index');
									exit;
								} else {
									echo "<div class='text-center text-danger mt-3'>Email atau password salah</div>";
								}
							}
						?>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Belum punya akun?<br><br>
								<a href="register"><button class="btn btn-primary ms-auto">
									Daftar Gratis Di sini
								</button></a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/login.js"></script>
	<script>
        function togglePassword() {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
