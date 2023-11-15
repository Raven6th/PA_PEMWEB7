<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION["akses"])){
    $_SESSION["akses"] = "none";
}
if ($_SESSION["akses"] !== "user") {
    echo '<script>alert("Anda perlu login untuk melihat keranjang belanja")window.location.href="../index.php";</script>';
}
// if (isset($_POST['bayar'])) {
//     echo '<script>alert("Pembayaran berhasil, anda akan di arahkan ke menu utama")</script>';
//     unset($_SESSION['keranjang']);
//     header("Location: ../index.php");
//     exit;
// }
if (empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
    echo '<script>alert("Keranjang kosong, mohon belanja terlebih dahulu sebelum checkout"); window.location.href="../index.php";</script>';
    exit;
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
        }
        .home-text {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
            background-color: #333;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a.button:hover {
            background-color: #555;
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
            <li <?php if($_SESSION["akses"] === "none"){ echo 'style="display: none;"';}?>><a href="../logout.php">Logout</a></li>
            <li><a href="../index.php#menu">Menu</a></li>
            <li><a href="../index.php#services">Service</a></li>
            <li><a href="../index.php#contact">Contact</a></li>
        </ul> 
    </header>

    <section class="home" id="home">
        <div class="home-textt">
            <h1>Keranjang</h1>
            <hr>
            
                <!-- pembuat tabel -->
                <table class="table table-bordered">
                <!-- kepala tabel -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                <!-- isi tabel -->
                    <tbody>
                    <?php
                    $nomor = 1;
                    $totalsemua = 0;
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

                        <?php $nomor++;
                        $totalsemua += $total ?>
                
                <?php
                    endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Keranjang</th>
                                <th>$<?php echo number_format($totalsemua) ?></th>
                            </tr>
                        </tfoot>
                    </table>

                <form method="post">
                    <input type="text" readonly value="<?php echo $_SESSION["username"]?>">
                    <select name="id_ongkir" id="">
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php 
                            $fetch = $koneksi->query("SELECT * FROM ongkir");
                            while ($opsi = $fetch->fetch_assoc()){ ?>
                                <option value="<?php echo $opsi['id_ongkir']; ?>">
                                    <?php echo $opsi['nama_kota']; ?> - 
                                    $<?php echo number_format($opsi['tarif']); ?>
                                </option>
                            <?php 
                            } 
                            ?>
                    </select>
                    <input type="submit" name="checkout" value="checkout">
                    
                </form>
                <?php 
                    if (isset($_POST['checkout'])) {
                        echo '<script>alert("Terima kasih telah melakukan checkout"); window.location.href="../index.php";</script>';
                        unset($_SESSION['keranjang']);
                        exit;
                    // $id_user = $_SESSION['id_user'];
                    // $id_ongkir = $_POST['id_ongkir'];
                    // $tgl = date('Y-m-d');
                    // $ongkir = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                    // if ($ongkir->num_rows > 0) {
                    //     $ong = $ongkir->fetch_assoc();
                    //     $tarif = $ong['tarif'];
                    //     $totalbayar = $totalsemua + $tarif;
                    //     $koneksi->query("INSERT INTO struk (id_user, tanggal_bayar, total_bayar, id_ongkir) VALUES('$id_user', '$tgl', '$totalbayar', '$id_ongkir')");
                    //     $recentid = $koneksi->insert_id;
                    //     foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
                    //         // $koneksi->query("INSERT INTO")   
                    //     }
                    }
                    else {
                        echo '<script>alert("Mohon pilih ongkos kirim yang benar")</script>';
                    } 
                    // } 
                    ?>
        </div>
    </section>
</body>
</html>
