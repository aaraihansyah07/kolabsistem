<?php
$filename = $_POST['filename'];
$file = 'uploads/modul/'. $filename;

if (file_exists($file)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File tidak ditemukan.";
}
?>
