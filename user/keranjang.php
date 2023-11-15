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
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            background-color: #333;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .navbar li {
            margin-right: 20px;
        }
        .navbar a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        .navbar a:hover {
            color: #FF702a;
        }

        .home {
            margin-top: 80px;
            text-align: center;
            display: block;
        }
        .home-text {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #E5E5E5;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button {
            padding: 10px 20px;
            background-color: #FF702a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            transform: scale(1) translateY(8px);
            transition: .4s;
        }

        
        @media screen and (max-width: 768px) {
            .navbar {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #333;
                padding: 10px 0;
            }

            .navbar.show-menu {
                display: flex;
            }
            
            .navbar li {
                margin-right: 10px;
                text-align: center;
                margin-bottom: 10px;
            }

            .home-text {
                padding: 10px;
                margin-top: 10px;
            }

            table {
                margin-top: 10px;
            }

            a.button, button {
                display: block;
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <header>
        <a href="../index.php" class="logo">Chocolate</a>
        <div class="fas fa-bars" id="menu-icon"></div>

        <ul class="navbar">
            <body class="light-mode">
            <li <?php if($_SESSION["akses"] === "user" || $_SESSION["akses"] === "none"){ echo 'style="display: none;"';}?>><a href="admin/tambah.php">Tambah</a></li>
            <li><a href="../index.php#home">Home</a></li>
            <li <?php if($_SESSION["akses"] === "user" || $_SESSION["akses"] === "admin"){ echo 'style="display: none;"';}?>><a href="login.php">Login</a></li>
            <li <?php if($_SESSION["akses"] === "none"){ echo 'style="display: none;"';}?>><a href="logout.php">Logout</a></li>
        </ul> 

    </header>

    <section class="home" id="home">
        <div class="home-textt">
            <h1>Keranjang</h1>
            <hr>
            <?php if (empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
                echo '
                
                <h2>Keranjang Kosong</h2>
                ';
            }
            else {
                echo '
                <!-- pembuat tabel --!>
                <table class="table table-bordered">
                <!-- kepala tabel --!>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                <!-- isi tabel --!>
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
                            <!-- Hapus produk dari keranjang -->
                            <td><a href="hapker.php?id=<?php echo $id_produk ?>"><button class="button">Hapus</button></a></td> 
                            
                        </tr>
                        <?php $nomor++; ?>
                <?php
                    endforeach;
                    echo '
                        </tbody>
                    </table>';
                } ?>
                <a href="../index.php" class="button"><button>Kembali Belanja</button></a>
                <a href="checkout.php" class="button"><button>Checkout</button></a>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuIcon = document.getElementById("menu-icon");
            const navbar = document.querySelector(".navbar");

            menuIcon.addEventListener("click", function () {
                navbar.classList.toggle("show-menu");
            });
        });
    </script>
</body>
</html>
