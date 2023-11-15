<?php
session_start();
// if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== 'admin') {
//     header('Location: login.php');
//     exit;
// }

require '../koneksi.php';
$hasil = mysqli_query($koneksi, "SELECT * FROM produk");

$produk = [];

while ($row = mysqli_fetch_assoc($hasil)) {
    $produk [] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
        :root {
            --sidebar-color: #333;
            --hover-color: #444;
            --input-bg: #555;
            --input-border: #777;
            --btn-color: orangered;
            --btn-hover: #d65d1a;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
        }

        .ser button {
            background-color: var(--sidebar-color);
            color: white;
            transition: 0.3s;
            border-radius: 5px;
        }

        .ser button:hover {
            background-color: var(--hover-color);
        }

        .sidebar {
            width: 20%;
            background-color: var(--sidebar-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 160vh;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 100%;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            max-width: 80%;
        }

        .sidebar a {
            display: block;
            color: white;
            text-align: center;
            padding: 10px 20px;
            width: 100%;
            text-decoration: none;
        }
        
        .sidebar a:last-child {
            border-bottom: none;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar a:hover {
            background-color: var(--hover-color);
            width: 60%;
            border-radius: 5px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 0 10px 10px 0;
            box-shadow: -2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .main-content h2 {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: var(--sidebar-color);
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        table thead {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #E5E5E5;
        }

        .delete-btn, .edit-btn , .checkout-btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
            margin: 0 5px;
        }

        .delete-btn {
            background-color: #E21C3D;
            color: white;
        }

        .checkout-btn {
            background-color: #555;
            color: white;
        }

        .edit-btn {
            background-color: #FFC107;
            color: white;
        }

        .delete-btn:hover, .edit-btn:hover , .checkout-btn{
            opacity: 0.9;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .datetime {
            background-color: var(--sidebar-color);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
            margin: 0 5px;
        }

        .status-btn:hover {
            opacity: 0.9;
        }

        .statt-btn {
            background-color: #555;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
            margin: 0 5px;
        }

        .statt-btn:hover {
            opacity: 0.9;
        }


    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="../chocolate (4) (1).png" alt="Logo">
    </div>
    <a href="../index.php?#menu">Lihat Menu</a>
    <a href="tambah.php">Tambah Menu</a>
</div>

<div class="main-content">
    
    <div class="search-container">
        <form action="../search.php" method="post" class="ser">
            <input type="text" name="search_query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        <div class="datetime">
        <?php
            date_default_timezone_set('Asia/Makassar');
            echo date('l, d F Y, H:i:s T');
        ?>
    </div>
    </div>
    <a href="../logout.php" class="statt-btn">Logout</a>
    <h2>Data Checkout</h2>

    <table border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Coklat</th>
                <th>Harga</th>
                <th>Foto Produk</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produk as $prd) : ?>
                <tr>
                    <td><?=$prd["id_produk"]?></td>
                    <td><?=$prd["nama_produk"]?></td>
                    <td><?=$prd["harga_produk"]?></td>
                    <td>
                        <img src="../foto_produk/<?=$prd["foto_produk"]?>" width="200">
                    </td>
                    <td><?=$prd["deskripsi_produk"]?></td>
                    <td>
                        <a href="hapus.php?id=<?= $prd["id_produk"]; ?>" class="delete-btn">hapus</a>
                        <a href="ubah.php?id=<?= $prd["id_produk"]; ?>" class="edit-btn">ubah</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
