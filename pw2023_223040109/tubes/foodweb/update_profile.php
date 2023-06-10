<?php

include 'components/connect.php'; // Mengimpor file 'connect.php' yang berisi koneksi ke database.

session_start(); // Memulai sesi PHP.

if(isset($_SESSION['user_id'])){ // Memeriksa apakah ada 'user_id' yang tersimpan dalam sesi.
    $user_id = $_SESSION['user_id']; // Jika ada, mengambil nilai 'user_id' dari sesi.
}else{
    $user_id = ''; // Jika tidak ada, mengatur 'user_id' menjadi string kosong.
    header('location:home.php'); // Mengarahkan pengguna ke halaman 'home.php'.
};

if(isset($_POST['submit'])){ // Memeriksa apakah tombol 'submit' telah diklik.

    $name = $_POST['name']; // Mengambil nilai 'name' dari input-form.
    $name = filter_var($name, FILTER_SANITIZE_STRING); // Membersihkan nilai nama dari karakter yang tidak diinginkan.

    $email = $_POST['email']; // Mengambil nilai 'email' dari input-form.
    $email = filter_var($email, FILTER_SANITIZE_STRING); // Membersihkan nilai email dari karakter yang tidak diinginkan.

    $number = $_POST['number']; // Mengambil nilai 'number' dari input-form.
    $number = filter_var($number, FILTER_SANITIZE_STRING); // Membersihkan nilai nomor telepon dari karakter yang tidak diinginkan.

    if(!empty($name)){ // Memeriksa apakah nilai 'name' tidak kosong.
        $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?"); // Mempersiapkan pernyataan SQL untuk memperbarui kolom 'name' pada tabel 'users' berdasarkan 'id' pengguna.
        $update_name->execute([$name, $user_id]); // Menjalankan pernyataan SQL dengan mengikat nilai nama dan 'user_id'.
    }

    if(!empty($email)){ // Memeriksa apakah nilai 'email' tidak kosong.
        $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?"); // Mempersiapkan pernyataan SQL untuk memeriksa apakah email sudah digunakan.
        $select_email->execute([$email]); // Menjalankan pernyataan SQL dengan mengikat nilai email.
        if($select_email->rowCount() > 0){ // Memeriksa apakah ada baris dengan email yang sama dalam hasil query.
            $message[] = 'email already taken!'; // Jika ada, menyimpan pesan ke dalam array $message.
        }else{
            $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?"); // Mempersiapkan pernyataan SQL untuk memperbarui kolom 'email' pada tabel 'users' berdasarkan 'id' pengguna.
            $update_email->execute([$email, $user_id]); // Menjalankan pernyataan SQL dengan mengikat nilai email dan 'user_id'.
        }
    }

    if(!empty($number)){ // Memeriksa apakah nilai 'number' tidak kosong.
        $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?"); // Mempersiapkan pernyataan SQL untuk memeriksa apakah nomor telepon sudah digunakan.
        $select_number->execute([$number]); // Menjalankan pernyataan SQL dengan mengikat nilai nomor telepon.
        if($select_number->rowCount() > 0){ // Memeriksa apakah ada baris dengan nomor telepon yang sama dalam hasil query.
            $message[] = 'number already taken!'; // Jika ada, menyimpan pesan ke dalam array $message.
        }else{
            $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?"); // Mempersiapkan pernyataan SQL untuk memperbarui kolom 'number' pada tabel 'users' berdasarkan 'id' pengguna.
            $update_number->execute([$number, $user_id]); // Menjalankan pernyataan SQL dengan mengikat nilai nomor telepon dan 'user_id'.
        }
    }

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709'; // Kata sandi kosong dalam bentuk hash SHA1.
    $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?"); // Mempersiapkan pernyataan SQL untuk mengambil kata sandi sebelumnya dari pengguna berdasarkan 'user_id'.
    $select_prev_pass->execute([$user_id]); // Menjalankan pernyataan SQL dengan mengikat nilai 'user_id'.
    $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC); // Mengambil hasil query sebagai array asosiatif.
    $prev_pass = $fetch_prev_pass['password']; // Mengambil nilai kata sandi sebelumnya dari array asosiatif.
    $old_pass = sha1($_POST['old_pass']); // Mengambil nilai kata sandi lama dari input-form dan menghash-nya menggunakan SHA1.
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING); // Membersihkan nilai kata sandi lama dari karakter yang tidak diinginkan.
    $new_pass = sha1($_POST['new_pass']); // Mengambil nilai kata sandi baru dari input-form dan menghash-nya menggunakan SHA1.
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING); // Membersihkan nilai kata sandi baru dari karakter yang tidak diinginkan.
    $confirm_pass = sha1($_POST['confirm_pass']); // Mengambil nilai konfirmasi kata sandi baru dari input-form dan menghash-nya menggunakan SHA1.
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING); // Membersihkan nilai konfirmasi kata sandi baru dari karakter yang tidak diinginkan.

    if($old_pass != $empty_pass){ // Memeriksa apakah kata sandi lama bukan kata sandi kosong.
        if($old_pass != $prev_pass){ // Memeriksa apakah kata sandi lama tidak cocok dengan kata sandi sebelumnya.
            $message[] = 'old password not matched!'; // Jika tidak cocok, menyimpan pesan ke dalam array $message.
        }elseif($new_pass != $confirm_pass){ // Memeriksa apakah kata sandi baru tidak cocok dengan konfirmasi kata sandi.
            $message[] = 'confirm password not matched!'; // Jika tidak cocok, menyimpan pesan ke dalam array $message.
        }else{
            if($new_pass != $empty_pass){ // Memeriksa apakah kata sandi baru bukan kata sandi kosong.
                $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?"); // Mempersiapkan pernyataan SQL untuk memperbarui kolom 'password' pada tabel 'users' berdasarkan 'id' pengguna.
                $update_pass->execute([$confirm_pass, $user_id]); // Menjalankan pernyataan SQL dengan mengikat nilai konfirmasi kata sandi baru dan 'user_id'.
                $message[] = 'password updated successfully!'; // Menyimpan pesan ke dalam array $message.
            }else{
                $message[] = 'please enter a new password!'; // Menyimpan pesan ke dalam array $message jika kata sandi baru kosong.
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
    <title>update profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container update-form">

    <form action="" method="post">
        <h3>update profile</h3>
        <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box" maxlength="50">
        <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="number" name="number" placeholder="<?= $fetch_profile['number']; ?>"" class="box" min="0" max="9999999999" maxlength="10">
        <input type="password" name="old_pass" placeholder="enter your old password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="new_pass" placeholder="enter your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="confirm_pass" placeholder="confirm your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="update now" name="submit" class="btn">
    </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
