<?php

include 'components/connect.php'; // Memasukkan file connect.php untuk menghubungkan ke database

session_start(); // Memulai session

if(isset($_SESSION['user_id'])){ // Memeriksa apakah user_id ada di session
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['send'])){ // Memeriksa apakah tombol submit dengan name 'send' telah ditekan

    $name = $_POST['name']; // Mengambil nilai dari input dengan name 'name'
    $name = filter_var($name, FILTER_SANITIZE_STRING); // Membersihkan dan memfilter nilai name dengan filter sanitasi string
    $email = $_POST['email']; // Mengambil nilai dari input dengan name 'email'
    $email = filter_var($email, FILTER_SANITIZE_STRING); // Membersihkan dan memfilter nilai email dengan filter sanitasi string
    $number = $_POST['number']; // Mengambil nilai dari input dengan name 'number'
    $number = filter_var($number, FILTER_SANITIZE_STRING); // Membersihkan dan memfilter nilai number dengan filter sanitasi string
    $msg = $_POST['msg']; // Mengambil nilai dari textarea dengan name 'msg'
    $msg = filter_var($msg, FILTER_SANITIZE_STRING); // Membersihkan dan memfilter nilai msg dengan filter sanitasi string

    $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_message->execute([$name, $email, $number, $msg]);

    if($select_message->rowCount() > 0){
        $message[] = 'already sent message!'; // Menambahkan pesan jika pesan telah dikirim sebelumnya
    }else{

        $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)"); // Menyiapkan query untuk memasukkan pesan ke dalam database
        $insert_message->execute([$user_id, $name, $email, $number, $msg]); // Menjalankan query dengan menyertakan nilai-nilai yang akan dimasukkan ke dalam database

        $message[] = 'sent message successfully!'; // Menambahkan pesan jika pesan berhasil dikirim

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?> <!-- Memasukkan header -->
<!-- header section ends -->

<div class="heading">
    <h3>contact us</h3>
    <p><a href="home.php">Home</a> <span> / Contact</span></p>
</div>

<!-- contact section starts  -->

<section class="contact">

    <div class="row">

        <div class="image">
            <img src="images/contact-img.jpg" alt="">
        </div>

        <form action="" method="post">
            <h3>tell us something!</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required> <!-- Input untuk mengisi nama dengan batasan panjang 50 karakter -->
            <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="enter your number" required maxlength="10"> <!-- Input untuk mengisi nomor telepon dengan batasan panjang 10 digit -->
            <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required> <!-- Input untuk mengisi email dengan batasan panjang 50 karakter -->
            <textarea name="msg" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea> <!-- Textarea untuk mengisi pesan dengan batasan panjang 500 karakter -->
            <input type="submit" value="send message" name="send" class="btn"> <!-- Tombol submit untuk mengirim pesan -->
        </form>

    </div>

</section>

<!-- contact section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?> <!-- Memasukkan footer -->
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
