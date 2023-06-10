<?php

include 'components/connect.php'; // Memasukkan file connect.php untuk menghubungkan ke database

session_start(); // Memulai session

if(isset($_SESSION['user_id'])){ // Memeriksa apakah user_id ada di session
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){ // Memeriksa apakah tombol submit telah ditekan

    $email = $_POST['email']; // Mengambil nilai email dari input form
    $email = filter_var($email, FILTER_SANITIZE_STRING); // Membersihkan nilai email dari karakter yang tidak diinginkan
    $pass = sha1($_POST['pass']); // Mengambil nilai password dari input form dan mengenkripsi menggunakan fungsi sha1()
    $pass = filter_var($pass, FILTER_SANITIZE_STRING); // Membersihkan nilai password dari karakter yang tidak diinginkan

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?"); // Menyiapkan query untuk memilih user berdasarkan email dan password
    $select_user->execute([$email, $pass]); // Menjalankan query dengan mengisi nilai placeholder dengan email dan password yang telah diberikan
    $row = $select_user->fetch(PDO::FETCH_ASSOC); // Mengambil baris hasil query sebagai array asosiatif

    if($select_user->rowCount() > 0){ // Memeriksa apakah ada hasil dari query
        $_SESSION['user_id'] = $row['id']; // Menyimpan user_id ke dalam session
        header('location:home.php'); // Mengarahkan pengguna ke halaman home.php
    }else{
        $message[] = 'incorrect username or password!'; // Menambahkan pesan kesalahan jika username atau password salah
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?> <!-- Memasukkan header dari file user_header.php -->
<!-- header section ends -->

<section class="form-container">

    <form action="" method="post"> <!-- Form untuk login dengan method POST -->
        <h3>login now</h3>
        <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')"> <!-- Input email dengan atribut wajib diisi, placeholder, class, dan atribut JavaScript untuk menghapus spasi pada nilai -->
        <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')"> <!-- Input password dengan atribut wajib diisi, placeholder, class, dan atribut JavaScript untuk menghapus spasi pada nilai -->
        <input type="submit" value="login now" name="submit" class="btn"> <!-- Tombol submit untuk login -->
        <p>don't have an account? <a href="register.php">register now</a></p> <!-- Tautan untuk mendaftar -->
        <p>are you admin? <a href="admin/admin_login.php">login admin</a></p> <!-- Tautan untuk login sebagai admin -->
    </form>

</section>











<?php include 'components/footer.php'; ?> <!-- Memasukkan footer dari file footer.php -->






<!-- custom js file link  -->
<script src="js/script.js"></script> <!-- Memasukkan file JavaScript kustom -->

</body>
</html>
