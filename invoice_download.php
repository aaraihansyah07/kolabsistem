<?php
session_start();
if (!isset($_SESSION['uname'])) {
    $user = "Login";
}
else {
    $user = $_SESSION['uname'];
    $nama_lengkap = $_SESSION['nama_lengkap'];
    $uuiduser = $_SESSION['uuiduser'];
    $no_hp = $_SESSION['no_hp'];
    $alamat_kosan_lengkap = $_SESSION['alamat_kosan_lengkap'];
    $email = $_SESSION['email'];
    $role_id = $_SESSION['role_id'];
}
include('koneksi.php');

if ((!isset($_SESSION['uname'])) or ($user != 'login' AND $role_id != 2)) {
    header('location:index_pencari_kos.php');
}
require('fpdf/fpdf.php');
// === Data Dummy ===
$no_invoice = $_POST['no_invoice'] ?? '';
$sql2 = "select p.kode_produk, p.nama_produk, h.uuidinvoice, h.no_invoice, h.nama_pemesan, to_char(h.tgl_pesanan, 'DD fmMONTH YYYY HH24:MI') tgl_pesanan, 
h.alamat, h.no_hp_pemesan, d.netto, d.uuidproduk, d.qty, d.price, d.disc_amount
from f_invoice_shoficraft_hdr h 
left join f_invoice_shoficraft_dtl d on d.uuidinvoice = h.uuidinvoice
left join produk_shoficraft p on p.uuidproduk = d.uuidproduk
where h.no_invoice = '$no_invoice'";
$hasil2 = $db->query($sql2);
$baris2 = $hasil2->fetch(PDO::FETCH_ASSOC);

$tanggal = $baris2['tgl_pesanan'];
$nama = $baris2['nama_pemesan'] ?? '';
$hp = $baris2['no_hp_pemesan'] ?? '';
$alamat = $baris2['alamat'] ?? '';
$produk = $baris2['nama_produk'] ?? '';
$kode_produk = $baris2['kode_produk'] ?? '';
$qty = $baris2['qty'] ?? 0;
$harga = $baris2['price'] ?? 0;
$diskon = $baris2['disc_amount'] ?? 0;
$netto = $baris2['netto'] ?? 0;

// === PDF Setup ===
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);

// === Title ===
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Invoice Pemesanan', 0, 1, 'C');
$pdf->Ln(2);

// === Logo Centered ===
$pdf->Image('logoshoficraft.png', 90, $pdf->GetY(), 30);
$pdf->Ln(35); // Spasi setelah logo

// === Header Layout ===
$pdf->SetFont('Arial', '', 8);
$leftX = 20;
$rightX = 110;
$labelWidth = 25;
$colonWidth = 5;
$maxRightWidth = 65; // supaya alamat tidak nabrak margin

// Fungsi 1 baris
function addFieldRow($pdf, $x, $label, $value, $y = null) {
    if ($y !== null) $pdf->SetY($y);
    $pdf->SetX($x);
    $pdf->Cell(25, 6, $label, 0, 0);
    $pdf->Cell(5, 6, ':', 0, 0);
    $pdf->Cell(60, 6, $value, 0, 1);
}

// === Baris 1 ===
$yStart = $pdf->GetY();
addFieldRow($pdf, $leftX, 'No. Invoice', $no_invoice, $yStart);
addFieldRow($pdf, $rightX, 'Nama / No.HP', $nama . ' / ' . $hp, $yStart);

// === Baris 2 ===
$y2 = $pdf->GetY();
addFieldRow($pdf, $leftX, 'Tanggal Pesanan', $tanggal, $y2);

// === Alamat Multiline ===
$pdf->SetY($y2);
$pdf->SetX($rightX);
$pdf->Cell($labelWidth, 6, 'Alamat', 0, 0);
$pdf->Cell($colonWidth, 6, ':', 0, 0);
$pdf->SetX($rightX + $labelWidth + $colonWidth);
$pdf->MultiCell($maxRightWidth, 6, $alamat, 0, 'L');
$afterAlamatY = $pdf->GetY();

// === Spasi Sebelum Tabel ===
$pdf->SetY($afterAlamatY + 5);

// === Header Tabel ===
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(128, 0, 0); // Maroon
$pdf->SetTextColor(255);

$wKode = 30;
$wProduk = 60;
$wQty = 10;
$wHarga = 20;
$wDiskon = 20;
$wNetto = 30;

$pdf->Cell($wKode, 7, 'Kode Produk', 1, 0, 'C', true);
$pdf->Cell($wProduk, 7, 'Nama Produk', 1, 0, 'C', true);
$pdf->Cell($wQty, 7, 'Qty', 1, 0, 'C', true);
$pdf->Cell($wHarga, 7, 'Harga', 1, 0, 'C', true);
$pdf->Cell($wDiskon, 7, 'Diskon', 1, 0, 'C', true);
$pdf->Cell($wNetto, 7, 'Total', 1, 1, 'C', true);

// === Isi Tabel ===
$pdf->SetFont('Arial', '', 8);
$pdf->SetTextColor(0);

$startX = $pdf->GetX();
$startY = $pdf->GetY();
$cellHeight = 5;

// Hitung tinggi MultiCell Nama Produk
$produkLineCount = ceil($pdf->GetStringWidth($produk) / ($wProduk - 2));
$usedHeight = max(1, $produkLineCount) * $cellHeight;

// 1. Kode Produk
$pdf->SetXY($startX, $startY);
$pdf->Cell($wKode, $usedHeight, $kode_produk, 1, 0, 'C');

// 2. Nama Produk (MultiCell)
$pdf->SetXY($startX + $wKode, $startY);
$pdf->MultiCell($wProduk, $cellHeight, $produk, 1, 'L');

// 3. Kolom kanan sejajarkan
$pdf->SetXY($startX + $wKode + $wProduk, $startY);
$pdf->Cell($wQty, $usedHeight, $qty, 1, 0, 'C');
$pdf->Cell($wHarga, $usedHeight, 'Rp ' . number_format($harga, 0, ',', '.'), 1, 0, 'R');
$pdf->Cell($wDiskon, $usedHeight, 'Rp ' . number_format($diskon, 0, ',', '.'), 1, 0, 'R');
$pdf->Cell($wNetto, $usedHeight, 'Rp ' . number_format($netto, 0, ',', '.'), 1, 1, 'R');

// === Footer ===
$pdf->Ln(15);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Kirim invoice ini ke nomor Whatsapp Admin Shoficraft pada link yang tertera di box caption note pemesanan', 0, 1, 'C');

// === Footer ===
$pdf->Ln(1);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Terimakasih sudah memesan produk di Shoficraft!', 0, 1, 'C');

// === Output ===
$pdf->Output('I', 'invoice_' . $no_invoice.'_'.$baris2['nama_produk'].'.pdf');
