<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body style="background:#f4f0f0">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-3">
						<img src="./images/logo_kolabsistem.png" alt="logo" width="78%">
					</div>
					<div class="card shadow-lg" style="margin-top:-2%">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4" style="text-align:center">Register</h1>
							<form method="POST" action="" id="formProfil" class="needs-validation" novalidate="">
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
									<label class="mb-2 text-muted" for="email">No. Telepon (Awali dengan 62)</label>
									<input id="no_hp" type="number" class="form-control" name="no_hp" required autofocus>
									<div class="invalid-feedback">
										No. Telepon is invalid
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
									<label class="mb-2 text-muted" for="email">Role</label>
									<select class="form-control" name="role_id" id="role_id" required autofocus>
										<option value="">--Pilih--</option>
										<option value=1>Mahasiswa/Alumni</option>
										<option value=2>Dosen</option>
										<option value=3>Perusahaan/Pencari Talent</option>
									</select>
									<div class="invalid-feedback">
								    	Role harus diisi
							    	</div>
								</div>

								<div class="mb-3" id="div_angkatan">
									<label class="mb-2 text-muted" for="email">Angkatan</label>
									<select class="form-control" name="angkatan" id="angkatan" autofocus>
										<option value="">--Pilih--</option>
										<?php
											$sql5b = "SELECT id_angkatan, tahun_angkatan from d_angkatan";
											$hasil5b = $db->query($sql5b);
											while ($baris5b = $hasil5b->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$baris5b['id_angkatan']."'>".$baris5b['tahun_angkatan']."</option>";
											}
										?>
									</select>
								</div>

								<div class="mb-3" id="div_nama_perusahaan">
									<label class="mb-2 text-muted" for="email">Nama Perusahaan</label>
									<input id="nama_perusahaan" type="text" class="form-control" name="nama_perusahaan" autofocus>
									<div class="invalid-feedback">
										Nama Perusahaan is invalid
									</div>
								</div>

								<div class="mb-3" id="div_univ">
									<label class="mb-2 text-muted" for="email">Asal Universitas</label>
									<select class="form-control" name="kode_univ" id="kode_univ" onchange="loadFakultas()">
										<option value="">--Pilih--</option>
										<?php
											$sql5 = "SELECT kode_univ, nama_univ from d_univ";
											$hasil5 = $db->query($sql5);
											while ($baris5 = $hasil5->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$baris5['kode_univ']."'>".$baris5['nama_univ']."</option>";
											}
										?>
									</select>
									<div class="invalid-feedback">
								    	Asal Universitas harus diisi
							    	</div>
								</div>

								<div class="mb-3" id="div_fakultas">
									<label class="mb-2 text-muted" for="email">Asal Fakultas</label>
									<select 							
										onchange="loadProdi()" 
										class="form-control"
										name="kode_fakultas" 
										id="kode_fakultas" 
										style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
										<option value="">--Fakultas--</option>
									</select>
								</div>

								<div class="mb-3" id="div_prodi">
									<label class="mb-2 text-muted" for="email">Asal Prodi</label>
									<select 							
										class="form-control"
										name="kode_prodi" 
										id="kode_prodi" 
										data-selected="<?php echo $baris['kode_prodi']; ?>" 
										style="width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
										<option value="">--Prodi--</option>
									</select>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
										<!-- <a href="forgot.html" class="float-end">
											Forgot Password?
										</a> -->
									</div>
									<div class="form-group" style="position:relative">
										<input 
											id="password" 
											type="password" 
											class="form-control" 
											name="pwd" 
											required
											minlength="8"
											pattern="^\S{8,}$"
											oninput="validatePassword()"
										>
										
										<span onclick="togglePassword()" 
											style="position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer;">
											👁️
										</span>

										<div class="invalid-feedback" id="passwordError">
											Password minimal 8 karakter dan tidak boleh mengandung spasi
										</div>
									</div>
								</div>

								<div class="d-flex align-items-center">
                                <center><button name="daftar" id="btnUpdate" type="submit" class="btn btn-primary ms-auto">
										<span id="btnText">Daftar</span>
										<span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status"></span>
									</button>
								</div></center>
							</form>
						</div>
                        <?php
							use PHPMailer\PHPMailer\PHPMailer;
							use PHPMailer\PHPMailer\Exception;
							require 'vendor/vendor/autoload.php'; // pastikan sudah install via composer
							$mail = new PHPMailer(true);
							
							if ($_SERVER['REQUEST_METHOD'] === 'POST') {
								$uname         = trim($_POST['uname'] ?? '');
								$pwd           = $_POST['pwd'] ?? '';
								$nama_lengkap  = trim($_POST['nama_lengkap'] ?? '');
								$gender        = $_POST['gender'] ?? '';
								$kode_univ     = trim($_POST['kode_univ'] ?? '');
								$kode_fakultas = trim($_POST['kode_fakultas'] ?? '');
								$kode_prodi    = trim($_POST['kode_prodi'] ?? '');
								$no_hp         = trim($_POST['no_hp'] ?? '');
								$role_id       = intval($_POST['role_id'] ?? 0);
								$nama_perusahaan    = trim($_POST['nama_perusahaan'] ?? '');
								$angkatan    = trim($_POST['angkatan'] ?? '');

								// server-side validation berdasarkan role
								if ($role_id === 1) { // Mahasiswa
									$nama_perusahaan = '';
									if ($kode_univ === '' || $kode_fakultas === '' || $kode_prodi === '' || $angkatan === '') {
										echo "<script>alert('Harap isi tahun angkatan, universitas, fakultas, dan prodi'); window.history.back();</script>";
										exit;
									}
								} elseif ($role_id === 2) { // Dosen
									$kode_fakultas = '';
									$kode_prodi = '';
									$nama_perusahaan = '';
									$angkatan = '';
									if ($kode_univ === '') {
										echo "<script>alert('Harap isi universitas'); window.history.back();</script>";
										exit;
									}
								}
								elseif ($role_id === 3) { // Perusahaan
									$kode_fakultas = '';
									$kode_prodi = '';
									$kode_univ = '';
									$angkatan = '';
									if ($nama_perusahaan === '') {
										echo "<script>alert('Harap isi nama perusahaan'); window.history.back();</script>";
										exit;
									}
								}

								// normalize: jika kosong ubah jadi null agar DB menerima NULL, bukan empty string
								$angkatan     = $angkatan === '' ? null : $angkatan;
								$kode_univ     = $kode_univ === '' ? null : $kode_univ;
								$kode_fakultas = $kode_fakultas === '' ? null : $kode_fakultas;
								$kode_prodi    = $kode_prodi === '' ? null : $kode_prodi;
								$no_hp         = $no_hp === '' ? null : $no_hp;
								$nama_perusahaan = $nama_perusahaan === '' ? null : $nama_perusahaan;

								$salt = base64_encode(random_bytes(16));
								$hashed_pw = crypt($pwd, '$2y$10$' . substr(strtr($salt, '+', '.'), 0, 22)); // bcrypt

								try {
									// cek duplikasi
									$sql5 = "SELECT COUNT(1) cek_dobel from user_pengguna where email = :email";
									$sth5 = $db->prepare($sql5);
									$sth5->execute([':email' => $uname]);
									$baris5 = $sth5->fetch(PDO::FETCH_ASSOC);

									if ($baris5['cek_dobel'] > 0) {
										echo "<script>alert('Akun dengan email ini sudah ada'); window.history.back();</script>";
										exit;
									}

									// generate token
									function generate_token($length = 12) {
										$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
										$token = '';
										for ($i = 0; $i < $length; $i++) {
											$token .= $chars[random_int(0, strlen($chars) - 1)];
										}
										return $token;
									}
									$token = generate_token();

									// prepare insert
									$sql = "INSERT INTO user_pengguna
										(gender, email, pword, fname, token, kode_univ, kode_fakultas, kode_prodi, no_hp, role_id, nama_perusahaan, angkatan)
										VALUES
										(:gender, :uname, :pwd, :nama_lengkap, :token, :kode_univ, :kode_fakultas, :kode_prodi, :no_hp, :role_id, :nama_perusahaan, :angkatan)";
									$stmt = $db->prepare($sql);

									// bind dengan tipe, gunakan PDO::PARAM_NULL kalau null
									$stmt->bindValue(':gender', $gender);
									$stmt->bindValue(':uname', $uname);
									$stmt->bindValue(':pwd', $hashed_pw);
									$stmt->bindValue(':nama_lengkap', $nama_lengkap);
									$stmt->bindValue(':token', $token);
									if (is_null($kode_univ)) {
										$stmt->bindValue(':kode_univ', null, PDO::PARAM_NULL);
									} else {
										$stmt->bindValue(':kode_univ', $kode_univ);
									}
									if (is_null($kode_fakultas)) {
										$stmt->bindValue(':kode_fakultas', null, PDO::PARAM_NULL);
									} else {
										$stmt->bindValue(':kode_fakultas', $kode_fakultas);
									}
									if (is_null($kode_prodi)) {
										$stmt->bindValue(':kode_prodi', null, PDO::PARAM_NULL);
									} else {
										$stmt->bindValue(':kode_prodi', $kode_prodi);
									}
									if (is_null($no_hp)) {
										$stmt->bindValue(':no_hp', null, PDO::PARAM_NULL);
									} else {
										$stmt->bindValue(':no_hp', $no_hp);
									}
									if (is_null($nama_perusahaan)) {
										$stmt->bindValue(':nama_perusahaan', null, PDO::PARAM_NULL);
									} else {
										$stmt->bindValue(':nama_perusahaan', $nama_perusahaan);
									}
									if (is_null($angkatan)) {
										$stmt->bindValue(':angkatan', null, PDO::PARAM_NULL);
									} else {
										$stmt->bindValue(':angkatan', $angkatan);
									}
									$stmt->bindValue(':role_id', $role_id, PDO::PARAM_INT);

									$stmt->execute();

									// Server settings
									$mail->isSMTP();
									$mail->Host       = 'smtp.gmail.com';
									$mail->SMTPAuth   = true;
									$mail->Username   = 'ZZZZZZ@gmail.com';       // email pengirim
									$mail->Password   = 'ZZZZZZZZZZZZZZ';
									//$mail->Password   = 'sjyienjmtumwgokp'; //aaraihansyah upi edu
									$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
									$mail->Port       = 587;

									// Recipients
									$mail->setFrom('ZZZZZZZZZZZZZ@gmail.com', 'KolabSistem');
									$mail->addAddress($uname); // email tujuan

									// Content
									$mail->isHTML(true);
									$mail->Subject = 'Verifikasi Email - KolabSistem';
									$mail->Body    = '
										Halo, sahabat KolabSistem<br><br>
										Silakan klik link berikut untuk verifikasi akun :<br>
										<a href="./konfirmasi_akun.php?token=' . $token . '">
											Verifikasi Akun
										</a><br><br>
										Terima kasih.
									';
									$mail->send();
									
									echo "<div class='card-footer py-3 border-0'>";
									echo "<div class='text-center' style='color:green'>Akun berhasil dibuat, mohon lakukan verifikasi email terlebih dahulu sebelum login</div>";
									echo "</div>";

								} catch (PDOException $e) {
									echo "ERROR: " . $e->getMessage();
									exit;
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
	<script>
        function loadFakultas() {
            const kode_univ = document.getElementById('kode_univ').value;
            const fakultasSelect = document.getElementById('kode_fakultas');
            const selectedId = fakultasSelect.getAttribute('data-selected'); // ambil value sebelumnya kalau ada
            fakultasSelect.innerHTML = '<option value="">Memuat...</option>';

            if (kode_univ !== "") {
            fetch('get_fakultas.php?kode_univ=' + kode_univ)
                .then(res => res.json())
                .then(data => {
                fakultasSelect.innerHTML = '<option value="">--Fakultas--</option>';
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.kode_fakultas;
                    opt.textContent = item.nama_fakultas;
                    if (selectedId && selectedId == item.kode_fakultas) {
                    opt.selected = true;
                    }
                    fakultasSelect.appendChild(opt);
                });
                })
                .catch(err => {
                fakultasSelect.innerHTML = '<option value="">Gagal memuat</option>';
                });
            } else {
            fakultasSelect.innerHTML = '<option value="">--Fakultas--</option>';
            }
        }

        // Auto-load subkelas saat halaman pertama kali dibuka
        document.addEventListener('DOMContentLoaded', function () {
            loadFakultas();
        });
	</script>
	<script>
        function loadProdi() {
            const kode_fakultas = document.getElementById('kode_fakultas').value;
            const prodiSelect = document.getElementById('kode_prodi');
            const selectedId = prodiSelect.getAttribute('data-selected'); // ambil value sebelumnya kalau ada
            prodiSelect.innerHTML = '<option value="">Memuat...</option>';

            if (kode_fakultas !== "") {
            fetch('get_prodi.php?kode_fakultas=' + kode_fakultas)
                .then(res => res.json())
                .then(data => {
                prodiSelect.innerHTML = '<option value="">--Prodi--</option>';
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.kode_prodi;
                    opt.textContent = item.nama_prodi;
                    if (selectedId && selectedId == item.kode_prodi) {
                    opt.selected = true;
                    }
                    prodiSelect.appendChild(opt);
                });
                })
                .catch(err => {
                prodiSelect.innerHTML = '<option value="">Gagal memuat</option>';
                });
            } else {
            prodiSelect.innerHTML = '<option value="">--Prodi--</option>';
            }
        }

        // Auto-load subkelas saat halaman pertama kali dibuka
        document.addEventListener('DOMContentLoaded', function () {
            loadProdi();
        });
	</script>

	<script>
		// Hide all at page load
		document.getElementById('div_angkatan').style.display = 'none';
		document.getElementById('div_univ').style.display = 'none';
		document.getElementById('div_fakultas').style.display = 'none';
		document.getElementById('div_prodi').style.display = 'none';
		document.getElementById('div_nama_perusahaan').style.display = 'none';

		document.getElementById('role_id').addEventListener('change', function () {
			const role = this.value;
			
			const divAngkatan = document.getElementById('div_angkatan');
			const divUniv = document.getElementById('div_univ');
			const divFak = document.getElementById('div_fakultas');
			const divProdi = document.getElementById('div_prodi');
			const divPerusahaan = document.getElementById('div_nama_perusahaan');

			// Hide all first
			divAngkatan.style.display = 'none';
			divUniv.style.display = 'none';
			divFak.style.display = 'none';
			divProdi.style.display = 'none';
			divPerusahaan.style.display = 'none';

			if (role == "1") {
				// Mahasiswa
				divAngkatan.style.display = 'block';
				divUniv.style.display = 'block';
				divFak.style.display = 'block';
				divProdi.style.display = 'block';
			}
			else if (role == "2") {
				// Dosen
				divUniv.style.display = 'block';
			}
			else if (role == "3") {
				// Perusahaan
				divPerusahaan.style.display = 'block';
			}
		});
	</script>
	<script>
        function togglePassword() {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
	
	<script>
	document.getElementById('formProfil').addEventListener('submit', function(e) {
		const form = this;

		// 🔥 NONAKTIFKAN REQUIRED PADA FIELD YANG DIHIDE
		document.querySelectorAll('#div_angkatan select, #div_univ select, #div_fakultas select, #div_prodi select, #div_nama_perusahaan input')
			.forEach(el => {
				if (el.closest('div').style.display === 'none') {
					el.removeAttribute('required');
				} else {
					el.setAttribute('required', true);
				}
			});

		// cek validasi
		if (!form.checkValidity()) {
			e.preventDefault();
			e.stopPropagation();
			form.classList.add('was-validated');
			return;
		}

		const btn = document.getElementById('btnUpdate');
		const text = document.getElementById('btnText');
		const loading = document.getElementById('btnLoading');

		btn.disabled = true;
		text.innerText = "Memproses...";
		loading.classList.remove('d-none');
	});
	</script>

	<script>
	window.addEventListener('pageshow', function () {
		const btn = document.getElementById('btnUpdate');
		const text = document.getElementById('btnText');
		const loading = document.getElementById('btnLoading');

		btn.disabled = false;
		text.innerText = "Daftar";
		loading.classList.add('d-none');
	});
	</script>

	<script>
	function validatePassword() {
		const input = document.getElementById("password");
		const error = document.getElementById("passwordError");

		const value = input.value;

		if (value.length < 8 || /\s/.test(value)) {
			input.classList.add("is-invalid");
			input.classList.remove("is-valid");
		} else {
			input.classList.remove("is-invalid");
			input.classList.add("is-valid");
		}
	}
</script>
</body>
</html>