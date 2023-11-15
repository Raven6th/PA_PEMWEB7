<?php
require '../koneksi.php';

if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== 'admin') {
    header('Location: ../index.php');
}

if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== 'admin') {
    header('Location: ../index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['ubah'])) {
    $nama_produk = $_POST["nama_produk"];
    $harga_produk = $_POST["harga_produk"];
    $deskripsi_produk = $_POST["deskripsi_produk"];

    if ($_FILES["foto_produk"]["error"] == 0) {
        if (file_exists($produk['foto_produk'])) {
            unlink($produk['foto_produk']);
        }

        $foto_produk_name = $_FILES["foto_produk"]["name"];
        $temp_name = $_FILES["foto_produk"]['tmp_name'];
        $file_ext = pathinfo($foto_produk_name, PATHINFO_EXTENSION);

        $current_date = date('Y-m-d');

        $new_file_name = $current_date . "-" . basename($foto_produk_name, "." . $file_ext) . "." . $file_ext;
        $path = "../foto_produk/" . $new_file_name;

        if (!move_uploaded_file($temp_name, $path)) {
            echo "<script>
                    alert('Gagal mengunggah gambar.');
                  </script>";
            return;
        }
    } else {
        $path = $produk['foto_produk'];
    }

    $stmt = $koneksi->prepare("UPDATE produk SET nama_produk = ?, deskripsi_produk = ?, foto_produk = ?, harga_produk = ? WHERE id_produk = ?");
    $stmt->bind_param("sssii", $nama_produk, $deskripsi_produk, $path, $harga_produk, $id);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Data Berhasil Diubah');
                document.location.href = 'tampilan.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Gagal Diubah');
              </script>";
    }

    $stmt->close();
}

?>


<!DOCTYPE html>
<head>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .sidebar {
            float: left;
            width: 20%;
            background-color: #555;
            border: none;
            padding-top: 10px;
            height: 100vh;
            padding-top: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: width 0.3s;
        }

        .logo {
            width: 100%;
            text-align: center;
            padding-bottom: 20px;
            border: none;
        }

        .logo img {
            max-width: 80%;
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

        form {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 50px;
        }

        form h2 {
            font-size: 1.8rem;
            color: var(--main-color);
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        form input[type="text"], form input[type="number"] {
            width: 100%;
            padding: 10px;
            background-color: #555;
            border: 1px solid #777;
            color: white;
            border-radius: 5px;
        }

        form button {
            display: block;
            width: 100%;
            padding: 10px 15px;
            margin-top: 20px;
            background-color: #555;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: 0.3s;
            transform : 0.3s;
        }

        form button:hover {
            background-color: #d65d1a;
            transform: scale(1) translateY(10px);
            transition: .4s;
            transform: scale(1.05);
        }

        form select, form input[type="file"] {
            width: 100%;
            padding: 10px;
            background-color: #555;
            border: 1px solid #777;
            color: white;
            border-radius: 5px;
            appearance: none;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }

        form input[type="file"]::-webkit-file-upload-button {
            background-color: #d65d1a;
            border: none;
            border-radius: 5px;
            color: white;
            padding: 5px 10px;
            margin-top: 2px;
            cursor: pointer;
        }

        form input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #d65d1a;
        }

        
        .logo{
            color: #d65d1a;
            font-weight: 600;
            font-size: 2.4rem;
            padding-top: 50px;
            padding-bottom: 50px;
        }

    </style>
</head>
<div class="sidebar">    
    <div>
        <h2 href="#" class="logo">Chocolate</h2>
    </div>
        <a href="tampilan.php">Data Menu Coklat</a>
        <a href="../index.php">Lihat Menu</a>
    </div>

<form action="" method="post" enctype="multipart/form-data">
<label for="nama_produk">Nama Produk : </label>
    <input type="text" name="nama_produk">

    <label for="harga_produk">Harga Produk :</label>
    <input type="number" name="harga_produk">

    <label for="foto_produk">Foto Produk :</label>
    <input type="file" name="foto_produk">

    <label for="deskripsi_produk">Deskripsi :</label>
    <textarea name="deskripsi_produk" rows="10"></textarea>

    <button type="submit" name="ubah">Ubah</button>
</form>
<script>
        // Tambahkan script untuk menangani perubahan pada input file
        const fileInput = document.querySelector('input[type="file"]');
        fileInput.addEventListener('change', function () {
            const fileName = this.files[0].name;
            const label = this.nextElementSibling;
            label.innerHTML = fileName;
        });
</script>
</body>
</html>
