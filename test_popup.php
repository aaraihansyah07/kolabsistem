<?php
$st = 'Y';
$popupScript = '';
if ($st == 'Y') {
    // Simpan JS sebagai string agar dipanggil di akhir
    $popupScript = "<script>window.onload = function() {
        showPopup('Berhasil dapat diskon 50%');
    };</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Diskon</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<!-- Tombol hanya untuk uji manual -->
<button onclick="showPopup('Diskon manual 30%!')" 
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
  Klik Manual
</button>

<!-- Pop-up -->
<div id="popup" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-lg text-center animate-fade-in">
    <h2 id="popup-message" class="text-lg font-semibold mb-4 text-gray-800">Pesan Diskon</h2>
    <button onclick="closePopup()" 
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
      Tutup
    </button>
  </div>
</div>

<!-- Style + Script -->
<style>
@keyframes fade-in {
  from {opacity: 0; transform: scale(0.95);}
  to {opacity: 1; transform: scale(1);}
}
.animate-fade-in {
  animation: fade-in 0.3s ease-out;
}
</style>

<script>
function showPopup(message) {
  document.getElementById("popup-message").textContent = message;
  document.getElementById("popup").classList.remove("hidden");
}
function closePopup() {
  document.getElementById("popup").classList.add("hidden");
}
</script>

<!-- Tampilkan script popup jika kondisi PHP terpenuhi -->
<?= $popupScript ?>
</body>
</html>
