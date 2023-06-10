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
    <title>profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?> <!-- Memasukkan header dari file user_header.php -->
<!-- header section ends -->

<section class="user-details">

    <div class="user">
        <?php

        ?>
        <img src="images/user-icon.png" alt="">
        <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p> <!-- Nama pengguna -->
        <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p> <!-- Nomor telepon pengguna -->
        <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p> <!-- Email pengguna -->
        <a href="update_profile.php" class="btn">update info</a> <!-- Tombol untuk mengupdate info pengguna -->
        <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p> <!-- Alamat pengguna -->
        <a href="update_address.php" class="btn">update address</a> <!-- Tombol untuk mengupdate alamat pengguna -->
    </div>

</section>










<?php include 'components/footer.php'; ?>







<!-- custom js file link  -->
<script src="js/script.js"></script> <!-- Memasukkan file JavaScript kustom -->

</body>
</html>
