<?php
// Pastikan permintaan adalah POST dan nilai 'nama' tersedia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'])) {
    $nama = htmlspecialchars($_POST['nama']); // Hindari XSS dengan htmlspecialchars
    echo "<h2>Hasil Input</h2>";
    echo "<p>Nama: <strong>{$nama}</strong></p>";
} else {
    echo "<h2>Error</h2>";
    echo "<p>Data tidak tersedia atau metode permintaan salah.</p>";
}
?>
