<?php
if (isset($_POST['jarak'])) {
    $jarak = floatval($_POST['jarak']);

    // Contoh logika: batas 100 meter
    if ($jarak <= 4600) {
        echo "✅ Jarak ($jarak meter) dalam radius sekolah. Absensi diterima.";
    } else {
        //echo "❌ Jarak ($jarak meter) di luar radius. Absensi ditolak.";
        echo $jarak;

    }
} else {
    echo "❌ Data jarak tidak dikirim.";
}
?>
