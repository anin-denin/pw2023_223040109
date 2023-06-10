<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

<!-- header section starts -->
<?php include 'components/user_header.php' ?>

<!-- header section ends -->

<!-- category section starts -->


<section class="products">

   <h1 class="title">food category</h1>

   <div class="box-container">

  <?php 
   $category = $_GET['category'];
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
   $select_products->execute([$category]);
   if($select_products->rowCount() > 0){
      while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC))
      {
  ?>
   <form action="" method="POST" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex">
         <div class="price"><?= $fetch_products['price']; ?><span>K</span></div>
         <input type="number" name="qty" class="qty" value="1" min="1" max="9" maxlength="2">
      </div>
   </form>
   <?php 
   }
      }else{
         echo ' <div class="empty">no products added yet!</div>';
      }
   
   ?>
   </div>

</section>

<!-- category section ends -->








<!-- footer section starts -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->


<!-- custom js file link -->
<script src="js/script.js"></script>
</body>
</html>