<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
    $select_user->execute([$email, $number]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount() > 0){
        $message[] = 'Email atau nomor sudah ada!';
    }else{
        if($pass != $cpass){
            $message[] = 'Konfirmasi password tidak sesuai!';
        }else{
            $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
            $insert_user->execute([$name, $email, $number, $cpass]);
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            if($select_user->rowCount() > 0){
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            }
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

    <form action="" method="post">
        <h3>Register Now</h3>
        <input type="text" name="name" required placeholder="Masukkan nama Anda" class="box" maxlength="50">
        <input type="email" name="email" required placeholder="Masukkan alamat email Anda" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="number" name="number" required placeholder="Masukkan nomor telepon Anda" class="box" min="0" max="9999999999" maxlength="99">
        <input type="password" name="pass" required placeholder="Masukkan password Anda" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="cpass" required placeholder="Konfirmasi password Anda" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="Daftar Sekarang" name="submit" class="btn">
        <p>Sudah memiliki akun? <a href="login.php">Masuk sekarang</a></p>
        <p>Anda admin? <a href="admin/admin_login.php">Login sebagai admin</a></p>
    </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
