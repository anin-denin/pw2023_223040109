<?php

include '../components/connect.php'; // Mengimpor file "connect.php" yang berisi koneksi ke database.

session_start(); // Memulai sesi.

$admin_id = $_SESSION['admin_id']; // Mengambil admin_id dari sesi.

if(!isset($admin_id)){ // Jika admin_id tidak ada dalam sesi, maka redirect ke halaman admin_login.php.
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){ // Jika terdapat parameter "delete" dalam URL, maka akan menghapus admin berdasarkan ID yang diberikan.
    $delete_id = $_GET['delete'];
    $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?"); // Mempersiapkan pernyataan SQL untuk menghapus admin berdasarkan ID.
    $delete_admin->execute([$delete_id]); // Menjalankan pernyataan SQL dengan mengikat nilai delete_id.
    header('location:admin_accounts.php'); // Redirect ke halaman admin_accounts.php setelah menghapus admin.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admins accounts</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

    <h1 class="heading">admins account</h1>

    <div class="box-container">

        <div class="box">
            <p>register new admin</p>
            <a href="register_admin.php" class="option-btn">register</a>
        </div>

        <?php
        $select_account = $conn->prepare("SELECT * FROM `admin`"); // Mempersiapkan pernyataan SQL untuk mengambil semua admin.
        $select_account->execute(); // Menjalankan pernyataan SQL.
        if($select_account->rowCount() > 0){ // Jika jumlah baris yang dihasilkan lebih dari 0, maka ada admin yang tersedia.
            while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ // Mengambil data admin dari setiap baris yang dihasilkan.
                ?>
                <div class="box">
                    <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
                    <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>
                    <div class="flex-btn">
                        <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('delete this account?');">delete</a>
                        <?php
                        if($fetch_accounts['id'] == $admin_id){ // Jika ID admin yang sedang ditampilkan sama dengan admin yang sedang login, maka tampilkan opsi update.
                            echo '<a href="update_profile.php" class="option-btn">update</a>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }else{
            echo '<p class="empty">no accounts available</p>'; // Jika tidak ada admin yang tersedia, tampilkan pesan bahwa tidak ada akun yang tersedia.
        }
        ?>

    </div>

</section>

<!-- admins accounts section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
