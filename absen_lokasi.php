<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Lokasi Siswa + Jarak ke Sekolah</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    iframe { width: 100%; height: 400px; border: none; margin-top: 10px; }
    #status { margin-top: 10px; font-weight: bold; white-space: pre-wrap; }
    button { margin-top: 20px; padding: 10px 20px; }
  </style>
</head>
<body>

<h2>📍 Deteksi Lokasi Anda</h2>
<p id="status">Mendeteksi lokasi...</p>
<iframe id="mapsIframe" allowfullscreen loading="lazy"></iframe>
<button id="kirimJarak" style="display:none;">✅ Kirim Jarak ke Server</button>

<script>
  const iframe = document.getElementById("mapsIframe");
  const status = document.getElementById("status");
  const btnKirim = document.getElementById("kirimJarak");

  //const latSekolah = -6.7625541014089166;
  //const lonSekolah = 108.44547111604145;

  //ujicoba rumah
  const latSekolah = -6.76099;
  const lonSekolah = 108.48697;

  function hitungJarak(lat1, lon1, lat2, lon2) {
    const R = 6371e3;
    const rad = x => x * Math.PI / 180;
    const dLat = rad(lat2 - lat1);
    const dLon = rad(lon2 - lon1);
    const a = Math.sin(dLat/2) ** 2 + Math.cos(rad(lat1)) * Math.cos(rad(lat2)) * Math.sin(dLon/2) ** 2;
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
  }

  let hasilJarakMeter = null;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(pos) {
      const lat = pos.coords.latitude;
      const lon = pos.coords.longitude;

      iframe.src = `https://www.google.com/maps?q=${lat},${lon}&z=17&output=embed`;

      const jarak = hitungJarak(lat, lon, latSekolah, lonSekolah);
      hasilJarakMeter = jarak.toFixed(2);

      status.innerText = `📌 Lokasi Anda: ${lat.toFixed(5)}, ${lon.toFixed(5)}
🏫 Jarak ke sekolah: ${hasilJarakMeter} meter`;

      btnKirim.style.display = 'inline-block';
    }, function(err) {
      status.innerText = "❌ Gagal mendeteksi lokasi: " + err.message;
    });
  } else {
    status.innerText = "❌ Browser tidak mendukung Geolocation.";
  }

  // Tombol kirim jarak ke PHP
  btnKirim.addEventListener("click", function() {
    fetch("absen_lokasi_proses.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `jarak=${hasilJarakMeter}`
    })
    .then(res => res.text())
    .then(data => {
      alert("Server membalas:\n" + data);
    })
    .catch(err => {
      alert("Gagal mengirim ke server: " + err);
    });
  });
</script>

</body>
</html>
