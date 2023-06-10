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
    <title>Home Page</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?> <!-- Memasukkan header -->

<section class="hero">

    <div class="swiper hero-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Order Online</span>
                    <h3>Delicious Pizza</h3>
                    <a href="menu.php" class="btn">See Menus</a>
                </div>
                <div class="image">
                    <img src="images/home-img-1.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Order Online</span>
                    <h3>Chezzy Hamburger</h3>
                    <a href="menu.php" class="btn">See Menus</a>
                </div>
                <div class="image">
                    <img src="images/home-img-2.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Order Online</span>
                    <h3>Roasted Chicken</h3>
                    <a href="menu.php" class="btn">See Menus</a>
                </div>
                <div class="image">
                    <img src="images/home-img-3.png" alt="">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<section class="category">

    <h1 class="title">Food Category</h1>

    <div class="box-container">

        <a href="category.php?category=fast food" class="box">
            <img src="images/cat-1.png" alt="">
            <h3>Fast Food</h3>
        </a>

        <a href="category.php?category=main dish" class="box">
            <img src="images/cat-2.png" alt="">
            <h3>Main Dishes</h3>
        </a>

        <a href="category.php?category=drinks" class="box">
            <img src="images/cat-3.png" alt="">
            <h3>Drinks</h3>
        </a>

        <a href="category.php?category=desserts" class="box">
            <img src="images/cat-4.png" alt="">
            <h3>Desserts</h3>
        </a>

    </div>

</section>




<section class="products">

    <h1 class="title">Latest Dishes</h1>

    <div class="box-container">

        <?php
        $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); // Menyiapkan query untuk memilih produk
        $select_products->execute(); // Menjalankan query
        if($select_products->rowCount() > 0){ // Memeriksa apakah ada hasil dari query
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ // Melakukan pengulangan untuk setiap baris hasil query
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
                        <div class="price"><?= $fetch_products['price']; ?><span>K</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                    </div>
                </form>
                <?php
            }
        }else{
            echo '<p class="empty">No products added yet!</p>'; // Menampilkan pesan jika tidak ada produk yang ditambahkan
        }
        ?>

    </div>

    <div class="more-btn">
        <a href="menu.php" class="btn">View All</a>
    </div>

</section>


















<?php include 'components/footer.php'; ?> <!-- Memasukkan footer -->


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

    var swiper = new Swiper(".hero-slider", {
        loop:true,
        grabCursor: true,
        effect: "flip",
        pagination: {
            el: ".swiper-pagination",
            clickable:true,
        },
    });

</script>

</body>
</html>
