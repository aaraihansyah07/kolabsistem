<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Register Pencari Modul</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body style="background:#1f1c1c">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-3">
						<img src="./images/logo_modulpedia.png" alt="logo" width="78%">
					</div>
					<div class="card shadow-lg" style="margin-top:-2%">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4" style="text-align:center">Register Pencari Modul</h1>
							<form method="POST" class="needs-validation" novalidate="" action="#">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Email</label>
									<input id="uname" type="email" class="form-control" name="uname" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

                                <div class="mb-3">
									<label class="mb-2 text-muted" for="email">Nama Lengkap</label>
									<input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" required autofocus>
									<div class="invalid-feedback">
										Nama lengkap is invalid
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Jenis Kelamin</label>
									<select class="form-control" name="gender" required autofocus>
										<option value="">--Pilih--</option>
										<option value="L">Laki-laki</option>
										<option value="P">Perempuan</option>
									</select>
									<div class="invalid-feedback">
								    	Jenis Kelamin harus diisi
							    	</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Saya adalah seorang...</label>
									<select class="form-control" name="role_id" required autofocus>
										<option value="">--Pilih--</option>
										<?php
											include('koneksi.php');
											$sql5 = "SELECT id, nama from user_pengguna_role";
											$hasil5 = $db->query($sql5);
											while ($baris5 = $hasil5->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$baris5['id']."'>".$baris5['nama']."</option>";
											}
										?>
									</select>
									<div class="invalid-feedback">
								    	Role harus diisi
							    	</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
										<!-- <a href="forgot.html" class="float-end">
											Forgot Password?
										</a> -->
									</div>
									<input id="password" type="password" class="form-control" name="pwd" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="d-flex align-items-center">
                                <center><button name="daftar" type="submit" class="btn btn-primary ms-auto" style="text-align:center">
										Daftar
									</button>
								</div></center>
							</form>
						</div>
                        <?php
							use PHPMailer\PHPMailer\PHPMailer;
							use PHPMailer\PHPMailer\Exception;
							require 'vendor/vendor/autoload.php'; // pastikan sudah install via composer
							$mail = new PHPMailer(true);
							
							if (isset($_POST['daftar'])) {
								$uname         = $_POST['uname'];
								$pwd           = $_POST['pwd'];
								$nama_lengkap  = $_POST['nama_lengkap'];
								$gender        = $_POST['gender'];
								$role_id 	   = $_POST['role_id'];

								$salt = base64_encode(random_bytes(16));
        						$hashed_pw = crypt($pwd, '$2y$10$' . substr(strtr($salt, '+', '.'), 0, 22)); // $2y$10$ = bcrypt cost 10

								try {
									$sql5 = "SELECT COUNT(1) cek_dobel from user_pengguna where email = '$uname'";
									$hasil5 = $db->query($sql5);
									$baris5 = $hasil5->fetch(PDO::FETCH_ASSOC);

									if ($baris5['cek_dobel'] > 0) {
										echo "<script>alert('Akun dengan email ini sudah ada'); window.history.back();</script>";
										exit;
									}
									else {
										//echo "$uname, $hashed_pw, $gender, $nama_lengkap, $role_id";
										function generate_token($length = 12) {
											$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
											$token = '';
											for ($i = 0; $i < $length; $i++) {
												$token .= $chars[random_int(0, strlen($chars) - 1)];
											}
											return $token;
										}
										$token = generate_token();

										$sql = "INSERT INTO user_pengguna(gender, email, pword, fname, role_id, token) 
												VALUES (:gender, :uname, :pwd, :nama_lengkap, :role_id, :token)";

										$stmt = $db->prepare($sql);
										$stmt->execute([
											':gender'        => $gender,
											':uname'         => $uname,
											':pwd'           => $hashed_pw,
											':nama_lengkap'  => $nama_lengkap,
											':role_id'  => $role_id,
											':token'  => $token
										]);

										try {
											// Server settings
											$mail->isSMTP();
											$mail->Host       = 'smtp.gmail.com';
											$mail->SMTPAuth   = true;
											$mail->Username   = 'aaraihansyah@upi.edu'; // email kamu
											$mail->Password   = 'sjyienjmtumwgokp';  // pakai app password tadi
											$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
											$mail->Port       = 587;

											// Recipients
											$mail->setFrom('aaraihansyah@upi.edu', 'Modulpedia');
											$mail->addAddress($uname); // email tujuan (user yang daftar)

											// Content
											$mail->isHTML(true);
											$mail->Subject = 'Verifikasi Email - Modulpedia';
											$mail->Body    = 'Halo, klik link berikut untuk verifikasi akun kamu: 
															<a href="localhost/marketplace_modul/konfirmasi_akun.php?token='.$token.'">Verifikasi</a>';

											$mail->send();
										} catch (Exception $e) {
											echo "Gagal kirim email. Error: {$mail->ErrorInfo}";
										}
										
										echo "<div class='card-footer py-3 border-0'>";
										echo "<div class='text-center' style='color:green'>Akun berhasil dibuat, mohon lakukan verifikasi email terlebih dahulu sebelum login</div>";
										echo "</div>";
									}

								} catch (PDOException $e) {
									$error = $e->getMessage();

									// Tangkap error karena constraint unique pada uname
									if (strpos($error, 'users_uname_key') !== false || strpos($error, 'duplicate key value') !== false) {
										echo "<div class='card-footer py-3 border-0'>";
										echo "<div class='text-center' style='color:red'>Email sudah digunakan, silakan pilih email lain.</div>";
										echo "</div>";
									} else {
										// Pesan fallback umum
										echo "<div class='card-footer py-3 border-0'>";
										echo "<div class='text-center' style='color:red'>Terjadi kesalahan saat membuat akun. Coba lagi nanti.</div>";
										echo "</div>";
									}
								}
							}

                             
                        ?>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								<a href="login" class="text-dark">Ke halaman login</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/login.js"></script>
</body>
</html>
