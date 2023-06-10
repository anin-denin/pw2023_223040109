<?php

include 'components/connect.php'; // Memasukkan file connect.php untuk menghubungkan ke database

session_start(); // Memulai session

if(isset($_SESSION['user_id'])){ // Memeriksa apakah user_id ada di session
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php'); // Mengarahkan pengguna ke halaman home jika user_id tidak ada di session
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?> <!-- Memasukkan header dari file user_header.php -->
<!-- header section ends -->

<div class="heading">
    <h3>orders</h3>
    <p><a href="html.php">Home</a> <span> / Orders</span></p>
</div>

<section class="orders">

    <h1 class="title">Your Orders</h1>

    <div class="box-container">

        <?php
        if($user_id == ''){
            echo '<p class="empty">Please login to see your orders</p>'; // Pesan jika pengguna belum login
        }else{
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?"); // Menyiapkan query untuk memilih pesanan pengguna
            $select_orders->execute([$user_id]); // Menjalankan query dengan user_id sebagai parameter
            if($select_orders->rowCount() > 0){ // Memeriksa apakah ada hasil dari query
                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ // Mengambil baris hasil query sebagai array asosiatif
                    ?>
                    <div class="box">
                        <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p> <!-- Tanggal pesanan -->
                        <p>name : <span><?= $fetch_orders['name']; ?></span></p> <!-- Nama pelanggan -->
                        <p>email : <span><?= $fetch_orders['email']; ?></span></p> <!-- Email pelanggan -->
                        <p>number : <span><?= $fetch_orders['number']; ?></span></p> <!-- Nomor telepon pelanggan -->
                        <p>address : <span><?= $fetch_orders['address']; ?></span></p> <!-- Alamat pengiriman -->
                        <p>payment method : <span><?= $fetch_orders['method']; ?></span></p> <!-- Metode pembayaran -->
                        <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p> <!-- Jumlah total produk dalam pesanan -->
                        <p>total price : <span><?= $fetch_orders['total_price']; ?>/K</span></p> <!-- Total harga pesanan -->
                        <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p> <!-- Status pembayaran -->
                    </div>
                    <?php
                }
            }else{
                echo '<p class="empty">no orders placed yet!</p>'; // Pesan jika belum ada pesanan yang ditempatkan
            }
        }
        ?>

    </div>

</section>










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?> <!-- Memasukkan footer dari file footer.php -->
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script> <!-- Memasukkan file JavaScript kustom -->

</body>
</html>
