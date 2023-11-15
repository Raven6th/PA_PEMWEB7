<?php
    session_start();
    require 'koneksi.php';
    if (!isset($_SESSION["akses"])){
        $_SESSION["akses"] = "none";
    }
    if ($_SESSION["akses"] === "user") {
        $id_produk = $_GET['id'];
        if (isset($_SESSION['keranjang'][$id_produk])) {
            $_SESSION['keranjang'][$id_produk]+=1;
            echo "<script>alert('Barang di tambahkan ke dalam keranjang')</script>";
            echo "<script>location='index.php#menu'</script>";
            exit;
        }
        else {
            // ['keranjang'] merupakan array, sehingga setiap 
            // $id_produk akan disimpan dengan nilai yang berbeda
            $_SESSION['keranjang'][$id_produk] = 1;
            echo "<script>alert('Barang di tambahkan ke dalam keranjang')</script>";
            echo "<script>location='index.php#menu'</script>";
            exit;
        }
    }
    else if ($_SESSION["akses"] === "admin") {
        echo "<script>alert('Admin tidak dapat menambah item ke keranjang')</script>";
        echo "<script>location='index.php#menu'</script>";
        exit;
    }
    else {
        echo "<script>alert('Anda belum login! mohon login terlebih dahulu sebelum belanja')</script>";
        echo "<script>location='index.php#menu'</script>";
        exit;
    }

?>
