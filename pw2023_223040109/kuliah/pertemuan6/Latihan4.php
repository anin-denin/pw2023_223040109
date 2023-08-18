<?php 

// Array Associative
//  Array yang indexnya adalah string yg kita buat sendiri

$mahasiswa = [
    [
        'nama' => 'Anin', 
        'makanan' => ['🍕', '🥩', '🥙' , '🥐'],
        'peliharaan'  => '🐇'
    ],
    [
        'nama' => 'Denin',
        'makanan' => ['🍔', '🍟', '🌭'], 
        'peliharaan' => '🐿'
    ],
    [
        'nama' => 'Nadia',
        'makanan' => ['🍟', '🍗'],
        'peliharaan' => '🐘'
    ], 
    [
        'nama' => 'Jennie',
        'makanan' => ['🌭'], 
        'peliharaan' => '🐋'
    ],
    [
        'nama' => 'Rose',
        'makanan' => [],
        'peliharaan' => '🐳'
    ]
];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 3</title>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>

    <!-- menambahkan index agar sesuai dengan index array -->
  
    <?php foreach ($mahasiswa as $mhs ) { ?>
    <ul>
        <li>Nama : <?= $mhs['nama']; ?></li>
        <!-- di bikin looping karna array makanan jadi banyak -->
        <li>Makanan favorit : 
            <?php foreach($mhs['makanan'] as $m) {
                echo $m;
            } ?>
        </li>
        <!-- hanya 1 array -->
        <li>Peliharaan :<?= $mhs['peliharaan']; ?></li>
    </ul>
    <?php } ?>
</body>
</html>