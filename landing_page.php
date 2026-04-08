<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KolabSistem – Kolaborasi Mahasiswa Indonesia</title>
  <meta name="description" content="Platform gratis kolaborasi mahasiswa, dosen, dan UMKM untuk portofolio, promosi usaha, lomba, dan penelitian." />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --primary: #002a5c;
      --accent: #f9c17d;
    }
    footer a:hover {color:#f9c17d; text-decoration:underline}
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- HERO -->
  <section class="bg-[var(--primary)] text-white">
    <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
          Satu Platform,<br />
          <span class="text-[var(--accent)]">Berbagai Macam Kolaborasi Kampus</span>
        </h1>
        <p class="mt-6 text-lg text-white/90">
          KolabSistem adalah platform gratis untuk mahasiswa/alumni menampilkan portofolio,
          mempromosikan usaha sampingan, dan membangun kolaborasi lintas jurusan dan fakultas sehingga mendukung terjadinya kolaborasi oleh mahasiswa/dosen/pencari talent untuk bergabung dalam kegiatan perlombaan, penelitian, bisnis, dan freelance.
        </p>
        <div class="mt-8 flex gap-4 flex-wrap">
          <a href="index.php" class="bg-[var(--accent)] text-[var(--primary)] font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition">Mulai Gratis</a>
          <a href="#fitur" class="border border-white/40 px-6 py-3 rounded-xl hover:bg-white/10 transition">Lihat Fitur</a>
        </div>
      </div>
      <div class="hidden md:block">
        <img src="ilus_kolab.jpg" alt="Kolaborasi Mahasiswa" style="width:80%; border-radius:2%"/>
      </div>
    </div>
  </section>

  <!-- FITUR -->
  <section id="fitur" class="py-20">
    <div class="max-w-6xl mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-[var(--primary)]">Kenapa KolabSistem?</h2>
      <p class="text-center text-gray-600 mt-3">Dibangun khusus untuk kebutuhan nyata mahasiswa/alumni</p>

      <div class="grid md:grid-cols-3 gap-8 mt-12">
        <div class="p-6 rounded-2xl border hover:shadow-lg transition">
          <div class="text-[var(--accent)] text-3xl mb-4" style="text-align:center">📁</div>
          <h3 class="font-semibold text-lg">Show off Portofolio</h3>
          <p class="text-gray-600 mt-2">Upload lebih dari satu portofolio PDF untuk dipamerkan dan dilihat oleh mahasiswa/alumni, dosen, dan pencari talent.</p>
        </div>
        <div class="p-6 rounded-2xl border hover:shadow-lg transition">
          <div class="text-[var(--accent)] text-3xl mb-4" style="text-align:center">📢</div>
          <h3 class="font-semibold text-lg">Gratis Promosi Usaha Mahasiswa/Alumni</h3>
          <p class="text-gray-600 mt-2">Tampilkan usaha sampinganmu supaya dapat dilihat oleh banyak orang di menu promosi mahasiswa KolabSistem.</p>
        </div>
        <div class="p-6 rounded-2xl border hover:shadow-lg transition">
          <div class="text-[var(--accent)] text-3xl mb-4" style="text-align:center">🤝</div>
          <h3 class="font-semibold text-lg">Kolaborasi Nyata</h3>
          <p class="text-gray-600 mt-2">Berpeluang untuk diundang/mengundang untuk berkolaborasi dengan mahasiswa lintas fakultas dan jurusan, dosen, atau pencari talent dalam perlombaan, penelitian, bisnis, dan freelance.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TARGET USER -->
  <section class="bg-gray-50 py-20">
    <div class="max-w-6xl mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-[var(--primary)]">Untuk Siapa?</h2>
      <div class="grid md:grid-cols-3 gap-8 mt-12 text-center">
        <div class="p-6 bg-white rounded-2xl shadow">
          <div class="text-[var(--accent)] text-3xl mb-4">🎓</div>
          <h3 class="font-semibold text-lg">Mahasiswa/Alumni</h3>
          <p class="mt-2 text-gray-600">Bangun portofolio, undang kolaborasi mahasiswa lain, dan gratis promosi usaha.</p>
        </div>
        <div class="p-6 bg-white rounded-2xl shadow">
          <div class="text-[var(--accent)] text-3xl mb-4">🤵🏻</div>
          <h3 class="font-semibold text-lg">Dosen</h3>
          <p class="mt-2 text-gray-600">Temukan mahasiswa potensial untuk riset/penelitian dan partisipasi perlombaan.</p>
        </div>
        <div class="p-6 bg-white rounded-2xl shadow">
          <div class="text-[var(--accent)] text-3xl mb-4">🏬</div>
          <h3 class="font-semibold text-lg">Pencari Talent</h3>
          <p class="mt-2 text-gray-600">Akses calon talenta kampus yang siap berkontribusi bagi perusahaan pencari talent.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section id="daftar" class="bg-[var(--primary)] py-20 text-center text-white">
    <h2 class="text-3xl md:text-4xl font-bold">Bangun Kolaborasi Kampus Hari Ini</h2>
    <p class="mt-4 text-white/90">Gratis. Tanpa biaya. Untuk mahasiswa Indonesia.</p>
    <a href="register.php" class="inline-block mt-8 bg-[var(--accent)] text-[var(--primary)] px-8 py-4 rounded-2xl font-semibold hover:opacity-90 transition">Daftar Sekarang</a>
  </section>

  <!-- FOOTER -->
  <footer class="bg-gray-900 text-gray-300 py-10">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between gap-6">
      <div>
        <h3 class="font-bold text-white">KolabSistem</h3>
        <p class="mt-2 text-sm">Platform kolaborasi gratis untuk mahasiswa Indonesia.</p>
      </div>
      <div class="text-sm">
        <p>Instagram : <a class="text-[var(--accent)]" target="_blank" href="https://instagram.com/KolabSistem">@KolabSistem</a></p>
        <p>WhatsApp Admin : <a class="text-[var(--accent)]" target="_blank" href="https://wa.me/6287753472949">6287753472949</a></p>
        <p>Partner : <a class="text-[var(--accent)]" target="_blank" href="https://instagram.com/shoficraft">@Shoficraft</a></p>
    </div>
    </div>
  </footer>

</body>
</html>
