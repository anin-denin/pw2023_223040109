<?php 

// Array Multidimensi
// array di dalam array

$mahasiswa = [
    ['Anin', '🍕', '🐇'],
    ['Denin', '🍔', '🐿'],
    ['Nadia', '🍟', '🐘'], 
    ['Jennie', '🌭', '🐋'],
    ['Rose', '🥩', '🐳']
];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 2</title>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>

    <!-- menambahkan index agar sesuai dengan index array -->
  
    <?php foreach ($mahasiswa as $mhs ) { ?>
    <ul>
        <li>Nama : <?= $mhs[0]; ?></li>
        <li>Makanan favorit :<?= $mhs[1]; ?></li>
        <li>Peliharaan :<?= $mhs[2]; ?></li>
    </ul>
    <?php } ?>
</body>
</html>