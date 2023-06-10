<?php

include 'components/connect.php'; // Memasukkan file koneksi ke database

session_start(); // Memulai sesi

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id']; // Mengatur user_id jika sudah ada sesi yang aktif
}else{
    $user_id = '';
    header('location:home.php'); // Mengarahkan pengguna ke halaman utama jika tidak ada sesi yang aktif
};

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if($check_cart->rowCount() > 0){

        if($address == ''){
            $message[] = 'Please add your address!'; // Menambahkan pesan kesalahan jika alamat kosong
        }else{

            $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message[] = 'Order placed successfully!'; // Menambahkan pesan sukses jika pesanan berhasil ditempatkan
        }

    }else{
        $message[] = 'Your cart is empty'; // Menambahkan pesan kesalahan jika keranjang belanja kosong
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?> <!-- Memasukkan header pengguna -->
<!-- header section ends -->

<div class="heading">
    <h3>Checkout</h3>
    <p><a href="home.php">Home</a> <span> / Checkout</span></p>
</div>

<section class="checkout">

    <h1 class="title">order summary</h1>

    <form action="" method="post">

        <div class="cart-items">
            <h3>Cart items</h3>
            <?php
            $grand_total = 0;
            $cart_items[] = '';
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                    $total_products = implode($cart_items);
                    $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                    ?>
                    <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
                    <?php
                }
            }else{
                echo '<p class="empty">Your cart is empty!</p>'; // Menampilkan pesan jika keranjang belanja kosong
            }
            ?>
            <p class="grand-total"><span class="name">Grand total :</span><span class="price">K<?= $grand_total; ?></span></p>
            <a href="cart.php" class="btn">View cart</a>
        </div>

        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
        <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
        <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
        <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
        <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
        <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

        <div class="user-info">
            <h3>your info</h3>
            <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
            <a href="update_profile.php" class="btn">Update info</a>
            <h3>Delivery address</h3>
            <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
            <a href="update_address.php" class="btn">update address</a>
            <select name="method" class="box" required>
                <option value="" disabled selected>Select payment method --</option>
                <option value="cash on delivery">Cash on delivery</option>
                <option value="credit card">credit card</option>
                <option value="paytm">Paytm</option>
                <option value="paypal">Paypal</option>
                <option value="ovo">OVO</option>
                <option value="dana">Dana</option>
                <option value="shopepay">Shopepay</option>
                <option value="Mbank">BCA/BRI/BNI/BJB</option>
            </select>
            <input type="submit" value="place order" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
        </div>

    </form>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?> <!-- Memasukkan footer -->
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
