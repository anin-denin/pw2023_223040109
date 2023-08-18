<?php 
    $binatang = ['🐇', '🐿', '🐘', '🐋', '🐳'];
    $makanan = ['🍕', '🍔', '🍟', '🌭', '🥩'];
    $nama = ['Anin', 'Denin', 'Nadia', 'Jennie', 'Rose'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 1</title>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>

    <!-- menambahkan index agar sesuai dengan index array -->
    <!-- cara ini kurang tepat -->
    <?php foreach($nama as $i => $nm) { ?>
    <ul>
        <li>Nama : <?= $nm; ?></li>
        <li>Makanan favorit :<?= $makanan[$i]; ?></li>
        <li>Peliharaan :<?= $binatang[$i]; ?></li>
    </ul>
    <?php } ?>
</body>
</html>