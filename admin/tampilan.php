<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_query = $_POST['search_query'];
    $search_query = mysqli_real_escape_string($koneksi, $search_query);
    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$search_query%'";
    $result = mysqli_query($koneksi, $query);
    $produk = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $produk[] = $row;
    }
} else {

    $hasil = mysqli_query($koneksi, "SELECT * FROM produk");

    $produk = [];

    while ($row = mysqli_fetch_assoc($hasil)) {
        $produk [] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
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

        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            margin: 0;
            min-height: 100vh;
        }
        
        .ser button {
            background-color: var(--sidebar-color);
            color: white;
            transition: 0.3s;
            border-radius: 5px;
        }
        
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 0 10px 10px 0;
            box-shadow: -2px 0px 5px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .main-content h2 {
            text-align: center;
            margin-bottom: 5px;
            padding: 10px;
            width: 80%;
            margin: 10px auto;
            background-color: var(--sidebar-color);
            color: white;
            
        }
        
        .logo {
            width: 100%;
            text-align: center;
            margin: 20px 0; 
            color: #FF702a;
            font-weight: 600;
            font-size: 2.4rem;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .sidebar {
            width: 20%;
            background-color: var(--sidebar-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 2000px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
            text-decoration: none;
            border: none;
        }
        .sidebar a:last-child {
            border-bottom: none;
        }

        .sidebar a:hover {
            background-color: #444;
            border-radius: 5px;
            width: 60%;
            color: white;
        }

        table {
            width: 80%;
            margin: 10px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center; 
        }

        tr:hover {
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
            margin-left: 120px;
        }

        .datetime {
            background-color: var(--sidebar-color);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 120px;
        }

        .statt-btn {
            background-color: #555;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
            margin: 10px ; 
            margin-left: 120px;
        }

        .statt-btn:hover {
            opacity: 0.9;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
            }

            table {
                width: 100%;
                overflow-x: auto;
            }

            table, th, td {
                font-size: 14px;
            }

            table thead {
                display: none;
            }

            table tr {
                display: block;
                border-bottom: 1px solid #ddd;
                margin-bottom: 8px;
            }

            table td {
                display: block;
                text-align: left;
            }

            table td:last-child {
                border-bottom: none;
            }

            .datetime {
                font-size: 14px;
                padding: 5px 10px;
                text-align: center;
                width: 100%;
            }

            .search-container {
                flex-direction: column;
                align-items: center;
                padding: 20px 0;
                display: block;
            }

            .search-container form {
                margin-top: 10px;
            }

            .search-container input {
                margin-bottom: 10px;
            }
        }

    </style>
</head>
<body>

<div class="sidebar">
    <div>
        <h2 href="#" class="logo">Chocolate</h2>
    </div>
    <a href="../index.php?#menu">Lihat Menu</a>
    <a href="tambah.php">Tambah Menu</a>
</div>

<div class="main-content">
    
    <div class="search-container">
        <form action="tampilan.php" method="post" class="ser">
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
    <h2>Data Menu Coklat</h2>

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
