<?php
include "config.php";
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM produk WHERE id=$id";
      $result = $conn->query($sql);
      echo json_encode($result->fetch_assoc());
    } else {
      $sql = "SELECT * FROM produk";
      $result = $conn->query($sql);
      $data = [];
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      echo json_encode($data);
    }
    break;

  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);
    $nama_produk = $data['nama_produk'];
    $merk = $data['merk'];
    $kategori = $data['kategori'];
    $harga = $data['harga'];
    
    $sql = "INSERT INTO produk (nama_produk, merk, kategori, harga, created_at, updated_at)
            VALUES ('$nama_produk', '$merk', '$kategori', $harga, NOW(), NOW())";
    echo json_encode(["success" => $conn->query($sql)]);
    break;

  case 'PUT':
    $id = $_GET['id'];
    $data = json_decode(file_get_contents("php://input"), true);
    $nama_produk = $data['nama_produk'];
    $merk = $data['merk'];
    $kategori = $data['kategori'];
    $harga = $data['harga'];

    $sql = "UPDATE produk SET 
              nama_produk='$nama_produk', 
              merk='$merk', 
              kategori='$kategori', 
              harga=$harga, 
              updated_at=NOW() 
            WHERE id=$id";
    echo json_encode(["success" => $conn->query($sql)]);
    break;

  case 'DELETE':
    $id = $_GET['id'];
    $sql = "DELETE FROM produk WHERE id=$id";
    echo json_encode(["success" => $conn->query($sql)]);
    break;

  default:
    echo json_encode(["message" => "Metode tidak dikenali"]);
    break;
}
?>
