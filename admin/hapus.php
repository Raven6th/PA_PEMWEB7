<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($koneksi, "SELECT foto_produk FROM produk WHERE id_produk = $id");
    $row = mysqli_fetch_assoc($result);
    $file_path = $row['foto_produk'];

    $stmt = $koneksi->prepare("DELETE FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'tampilan.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus');</script>";
    }

    $stmt->close();
}

?>
