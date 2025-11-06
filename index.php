<?php
header("Content-Type: application/json");
echo json_encode([
  "status" => true,
  "message" => "Selamat datang di API CRUD Kosmetik!",
  "author" => "Silvi Puspitasari",
  "endpoints" => [
    "GET /produk.php" => "Ambil semua data produk",
    "GET /produk.php?id={id}" => "Ambil data produk berdasarkan ID",
    "POST /produk.php" => "Tambah data produk",
    "PUT /produk.php?id={id}" => "Ubah data produk",
    "DELETE /produk.php?id={id}" => "Hapus data produk"
  ]
], JSON_PRETTY_PRINT);
?>
