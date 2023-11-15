<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION["akses"])){
    $_SESSION["akses"] = "none";
}
if ($_SESSION["akses"] !== "user") {
    echo "<script>alert('Anda perlu login untuk melihat keranjang belanja')</script>";
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <header>
        <a href="../index.php" class="logo">Chocolate</a>
        <div class="fas fa-bars" id="menu-icon"></div>

        <ul class="navbar">
            <body class="light-mode">
            <li <?php if($_SESSION["akses"] === "user" || $_SESSION["akses"] === "none"){ echo 'style="display: none;"';}?>><a href="admin/tambah.php">Tambah</a></li>
        <?php
        if ($_SESSION["akses"] === "user" || $_SESSION["akses"] === "admin"){
        echo 
        '
            <li><a id="toggle-mode">Mode Tema</a></li>
        ';
        }
        ?>
            <li><a href="#home">Home</a></li>
            <li <?php if($_SESSION["akses"] === "user" || $_SESSION["akses"] === "admin"){ echo 'style="display: none;"';}?>><a href="login.php">Login</a></li>
            <li <?php if($_SESSION["akses"] === "none"){ echo 'style="display: none;"';}?>><a href="logout.php">Logout</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#services">Service</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul> 
    </header>

    <section class="home" id="home">
        <div class="home-textt">
            <h1>Keranjang</h1>
            <hr>
            <?php if (empty($_SESSION['keranjang'])) {
                echo '
                
                <h2>Keranjang Kosong</h2>
                ';
            }
            else {
                echo '
                // pembuat tabel
                <table class="table table-bordered">
                // kepala tabel
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                // isi tabel
                    <tbody>';
                    $nomor = 1;
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                    <?php 
                    $fetch = $koneksi->query("SELECT * FROM produk WHERE id_produk ='$id_produk'");
                    $ranjang = $fetch->fetch_assoc();
                    $total = $ranjang["harga_produk"]*$jumlah;
                    ?>
                        <tr>

                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $ranjang["nama_produk"];?></td>
                            <td>$<?php echo number_format($ranjang["harga_produk"]);?></td>
                            <td><?php echo $jumlah?></td>
                            <td>$<?php echo number_format($total);?></td>
                            
                        </tr>
                        <?php $nomor++; ?>
                <?php
                    endforeach;
                    echo '
                        </tbody>
                    </table>';
                } ?>
        </div>
    </section>
</body>
</html>
