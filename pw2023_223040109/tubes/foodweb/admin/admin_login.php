<?php

include '../components/connect.php'; // Mengimpor file "connect.php" yang berisi koneksi ke database.

session_start(); // Memulai sesi.

if(isset($_POST['submit'])){ // Jika tombol submit pada form login ditekan.

    $name = $_POST['name']; // Mengambil nilai input username.
    $name = filter_var($name, FILTER_SANITIZE_STRING); // Membersihkan nilai input username dengan filter sanitasi.
    $pass = sha1($_POST['pass']); // Mengambil nilai input password dan mengenkripsi dengan fungsi sha1.
    $pass = filter_var($pass, FILTER_SANITIZE_STRING); // Membersihkan nilai input password dengan filter sanitasi.

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?"); // Mempersiapkan pernyataan SQL untuk mengambil admin berdasarkan username dan password.
    $select_admin->execute([$name, $pass]); // Menjalankan pernyataan SQL dengan mengikat nilai name dan pass.

    if($select_admin->rowCount() > 0){ // Jika jumlah baris yang dihasilkan lebih dari 0, maka admin ditemukan.
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC); // Mengambil data admin dari baris yang dihasilkan.
        $_SESSION['admin_id'] = $fetch_admin_id['id']; // Menyimpan admin_id dalam sesi.
        header('location:dashboard.php'); // Redirect ke halaman dashboard.php setelah login berhasil.
    }else{
        $message[] = 'incorrect username or password!'; // Menyimpan pesan kesalahan jika username atau password salah.
    }

//    header('Location: home.php');
//    exit;

}

if(isset($_POST['submit2'])){
    // Kode validasi dan pemrosesan form lainnya

    // Redirect ke halaman home.php jika form diproses dengan benar
    header('Location: home.php');
    exit;
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
    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php
if(isset($message)){ // Jika terdapat pesan kesalahan yang disimpan.
    foreach($message as $message){ // Meloopi setiap pesan kesalahan.
        echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      '; // Menampilkan pesan kesalahan dengan ikon penutup untuk menghapus pesan.
    }
}
?>

<!-- admin login form section starts  -->

<section class="form-container">

    <form action="" method="POST"> <!-- Form untuk login admin -->
        <h3>login now</h3>
<!--        <p>default username = <span>anindenin</span> & password = <span>anindenin12345</span></p>-->
        <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="login now" name="submit" class="btn">
    </form>

</section>

<!-- admin login form section ends -->
</body>
</html>
