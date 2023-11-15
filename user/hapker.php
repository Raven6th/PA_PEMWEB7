<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION["akses"]) || $_SESSION["akses"] !== "user" || $_SESSION["akses"] === "admin"){
    header("Location: ../index.php");
}
$id_produk = $_GET['id'];
unset($_SESSION['keranjang'][$id_produk]);
echo '<script>alert("Produk dihapus dari keranjang")</script>';
header('Location: keranjang.php');
?>
