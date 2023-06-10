<?php

include '../components/connect.php'; // Mengimpor file "connect.php" yang berisi koneksi ke database.

session_start(); // Memulai sesi.

$admin_id = $_SESSION['admin_id']; // Mengambil nilai admin_id dari sesi.

if(!isset($admin_id)){ // Jika admin_id tidak terdefinisi atau tidak ada dalam sesi, mengarahkan pengguna ke halaman admin_login.php.
    header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?> <!-- Mengimpor file "admin_header.php" yang berisi bagian header untuk halaman admin -->

<!-- admin dashboard section starts  -->

<section class="dashboard">

    <h1 class="heading">Dashboard</h1>

    <div class="box-container">

        <div class="box">
            <h3>Welcome!</h3>
            <p><?= $fetch_profile['name']; ?></p> <!-- Menampilkan nama profil admin yang diambil dari variabel $fetch_profile -->
            <a href="update_profile.php" class="btn">Update Profile</a>
        </div>

        <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?"); // Mempersiapkan pernyataan SQL untuk mengambil pesanan yang memiliki status pembayaran tertunda.
            $select_pendings->execute(['pending']); // Menjalankan pernyataan SQL dengan mengikat nilai 'pending'.
            while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){ // Meloopi setiap baris hasil query.
                $total_pendings += $fetch_pendings['total_price']; // Menambahkan total harga pesanan yang memiliki status pembayaran tertunda.
            }
            ?>
            <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
            <p>Total Pendings</p>
            <a href="placed_orders.php" class="btn">See orders</a>
        </div>

        <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?"); // Mempersiapkan pernyataan SQL untuk mengambil pesanan yang memiliki status pembayaran selesai.
            $select_completes->execute(['completed']); // Menjalankan pernyataan SQL dengan mengikat nilai 'completed'.
            while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){ // Meloopi setiap baris hasil query.
                $total_completes += $fetch_completes['total_price']; // Menambahkan total harga pesanan yang memiliki status pembayaran selesai.
            }
            ?>
            <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
            <p>Total Completes</p>
            <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`"); // Mempersiapkan pernyataan SQL untuk mengambil semua pesanan.
            $select_orders->execute(); // Menjalankan pernyataan SQL.
            $numbers_of_orders = $select_orders->rowCount(); // Menghitung jumlah baris hasil query.
            ?>
            <h3><?= $numbers_of_orders; ?></h3>
            <p>Total Orders</p>
            <a href="placed_orders.php" class="btn">See Orders</a>
        </div>

        <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`"); // Mempersiapkan pernyataan SQL untuk mengambil semua produk.
            $select_products->execute(); // Menjalankan pernyataan SQL.
            $numbers_of_products = $select_products->rowCount(); // Menghitung jumlah baris hasil query.
            ?>
            <h3><?= $numbers_of_products; ?></h3>
            <p>Products added</p>
            <a href="products.php" class="btn">See Products</a>
        </div>

        <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`"); // Mempersiapkan pernyataan SQL untuk mengambil semua akun pengguna.
            $select_users->execute(); // Menjalankan pernyataan SQL.
            $numbers_of_users = $select_users->rowCount(); // Menghitung jumlah baris hasil query.
            ?>
            <h3><?= $numbers_of_users; ?></h3>
            <p>Users Accounts</p>
            <a href="users_accounts.php" class="btn">See Users</a>
        </div>

        <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admin`"); // Mempersiapkan pernyataan SQL untuk mengambil semua akun admin.
            $select_admins->execute(); // Menjalankan pernyataan SQL.
            $numbers_of_admins = $select_admins->rowCount(); // Menghitung jumlah baris hasil query.
            ?>
            <h3><?= $numbers_of_admins; ?></h3>
            <p>Admins</p>
            <a href="admin_accounts.php" class="btn">See Admins</a>
        </div>

        <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`"); // Mempersiapkan pernyataan SQL untuk mengambil semua pesan baru.
            $select_messages->execute(); // Menjalankan pernyataan SQL.
            $numbers_of_messages = $select_messages->rowCount(); // Menghitung jumlah baris hasil query.
            ?>
            <h3><?= $numbers_of_messages; ?></h3>
            <p>New Messages</p>
            <a href="messages.php" class="btn">see messages</a>
        </div>

    </div>

</section>

<!-- admin dashboard section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
