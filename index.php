<?php
session_start();
require 'koneksi.php';
if (!isset($_SESSION["akses"])){
    $_SESSION["akses"] = "none";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <a href="#" class="logo">Chocolate</a>
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
        <div class="home-text">
            <h1>Full Website</h1>
            <h2>Chocolate The <br> Most Precious Things </h2>
            <a href="#menu" class="btn">Today's Menu</a>
        </div>

        <div class="home-img">
            <img src="chocolate (4) (1).png" alt="">
        </div>


    </section>
    <section class="about" id="about">
        <div class="about-img">
            <img src="choco 2 (2) (1).jpg" alt="">
        </div>
        <div class="about-text">
            <span>About Us</span>
            <h2>We speak the good <br> Chocolate language</h2>
            <p>There are many variations passages of Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                Quasi et, similique obcaecati magni vero rem animi at tempora saepe recusandae voluptatem quis accusantium, 
                <br>laudantium expedita eius eos dolor soluta labore?</p>
        <a href="#services" class="btn"> Learn More</a>
        </div>
    </section>
    <section class="menu" id="menu"> 
        <div class="heading">
            <span>Chocolate Menu</span>
            <h2>Sweetness and great price</h2>
        </div>
        <div class="menu-container">
            <?php $fetch = $koneksi->query("SELECT * FROM PRODUK")?>
            <?php while($prodrow = $fetch->fetch_assoc()){ ?>
            <div class="box">
                <div class="box-img">
                    <img src="foto_produk/<?php echo $prodrow['foto_produk']; ?>" alt="">
                </div>
                <h2><?php echo $prodrow['nama_produk']; ?></h2>
                <h3><?php echo $prodrow['deskripsi_produk']; ?></h3>
                <span>$<?php echo $prodrow['harga_produk']; ?></span>
                <a href="lempar.php?id=<?php echo $prodrow['id_produk']; ?>"><i class="fa-solid fa-cart-plus"></i></a>
            </div>
            <?php } ?>
        </div>
    </section>

    <section class="service" id="services">
        <div class="heading">
            <span>Services</span>
            <h2>We Provide best quality Chocolate</h2>
        </div>
        <div class="service-container">
            <div class="s-box">
                <img src="s1.png" alt="">
                <h3>Order</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem culpa numquam aut enim alias? 
                    Nisi iste perferendis cumque fuga repellat qui earum rem, explicabo atque porro magnam ut, saepe impedit.</p>
            </div>

            <div class="s-box">
                <img src="s2.png" alt="">
                <h3>Shipping</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem culpa numquam aut enim alias? 
                    Nisi iste perferendis cumque fuga repellat qui earum rem, explicabo atque porro magnam ut, saepe impedit.</p>

            </div>

            <div class="s-box">
                <img src="s3.png" alt="">
                <h3>Delivered</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem culpa numquam aut enim alias? 
                    Nisi iste perferendis cumque fuga repellat qui earum rem, explicabo atque porro magnam ut, saepe impedit.</p>

            </div>
        </div>

    </section>

    <section class="cta">
        <h2>We make quality chocolate <br> Everyday</h2>
        <a href="#contact" class="btn">Let's talk</a>
    </section>
    <section id="contact">
        <div class="footer">
            <div class="main">
                <div class="col">
                    <h4>Menu Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#services">Service</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Our Service</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Contact Us</h4>
                    <div class="social">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>         
        </di    v>
    </section>
    <div class="shopping-cart">
            <?php 
            if ($_SESSION["akses"] === "none") {
                echo '<a href="login.php">';} 
            else if ($_SESSION["akses"] === "admin") {
                echo '<a href="admin/tambah.php">';}
            else if ($_SESSION["akses"] === "user") {
                echo '<a href="user/keranjang.php">';}
            ?>
            <i class="fa-solid fa-cart-plus openModal"></i>
        </a>
    </div>
    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close-btn" id="close-btn">&times;</span>
            <h2>Welcome to Chocolate</h2>
            <p>Thank you for visiting our website! Enjoy the world of premium chocolates.</p>
        </div>
    </div>

    <script type="text/javascript" src="script.js"></script>
</body>
</html>



    <!-- <div class="modal" id="purchaseModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Order Chocolate</h2>
        <form action="tampilan.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="harga_produk">Harga Produk:</label>
                <input type="number" id="harga_produk" name="harga_produk" class="form-control" required>

            </div>
            <div class="form-group">
                <label for="jumlah_produk">Jumlah Coklat:</label>
                <input type="number" id="jumlah_produk" name="jumlah_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk:</label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="10" class="form-control" required></textarea>
            </div>
            <input type="submit" name="tambah" value="Order Now">
        </form>
    </div>
</div> -->