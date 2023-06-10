<?php

include 'components/connect.php'; // Memasukkan file connect.php untuk menghubungkan ke database

session_start(); // Memulai session

if(isset($_SESSION['user_id'])){ // Memeriksa apakah user_id ada di session
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

include 'components/add_cart.php'; // Memasukkan file add_cart.php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?> // Memasukkan file user_header.php untuk menampilkan header
<!-- header section ends -->

<!-- search form section starts  -->

<section class="search-form">
    <form method="post" action="">
        <input type="text" name="search_box" placeholder="search here..." class="box">
        <button type="submit" name="search_btn" class="fas fa-search"></button>
    </form>
</section>

<!-- search form section ends -->


<section class="products" style="min-height: 100vh; padding-top:0;">

    <div class="box-container">

        <?php
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){ // Memeriksa apakah kotak pencarian diisi atau tombol pencarian diklik
            $search_box = $_POST['search_box']; // Mengambil nilai kotak pencarian
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); // Mengambil produk dari database berdasarkan nama yang cocok dengan kotak pencarian
            $select_products->execute();
            if($select_products->rowCount() > 0){ // Jika produk ditemukan, tampilkan dalam bentuk kotak
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <form action="" method="post" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                        <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                        <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="flex">
                            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                        </div>
                    </form>
                    <?php
                }
            }else{
                echo '<p class="empty">no products added yet!</p>'; // Jika tidak ada produk yang ditemukan, tampilkan pesan "no products added yet!"
            }
        }
        ?>

    </div>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?> // Memasukkan file footer.php untuk menampilkan footer
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
