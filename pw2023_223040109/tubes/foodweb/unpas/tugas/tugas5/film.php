<?php 

// latihan film.php (minimal ada 5 film)
// poster (harus gambar) , judul , tahun, genre , pemeran utama, sutradara

$film = [
    [
        'poster' => 'avengers.jpg' ,
        'judul' => 'Avengers',
        'tahun'  => '2019',
        'genre' => ['action', 'adventure', 'drama'],
        'pemeran utama' => 'Robert Downey Jr.',
        'sutradara' => 'Anthony Russo'
    ],
    [
        'poster' => "insidious.jpg",
        'judul' => 'Insidious',
        'tahun'  => '2010',
        'genre' => ['Horror', 'Thriller', 'Mystery'],
        'pemeran utama' => 'patrick Wilson',
        'sutradara' => 'James Wan'
    ],
    [
        'poster' => "interstellar.jpg",
        'judul' => 'Interstellar', 
        'tahun'  => '2014',
        'genre' => ['Adventure', 'Drama', 'Sci-fi'],
        'pemeran utama' => 'Matthew McConaughe',
        'sutradara' => 'Christopher Nolan'
    ],
    [
        'poster' => "parasite.jpg",
        'judul' => 'Parasite',
        'tahun'  => '2019',
        'genre' => ['Drama', 'Thriller'],
        'pemeran utama' => 'Song Kang-ho',
        'sutradara' => 'Bong Joon Ho'
    ],
    [
        'poster' => "toy story.jpg",
        'judul' => 'Toy Story 4',
        'tahun'  => '2019',
        'genre' => ['Animation', 'Adventure', 'Comedy'],
        'pemeran utama' => 'Tom Hanks',
        'sutradara' => 'Josh Cooley'
    ],
    [
        'poster' => "coco.jpg",
        'judul' => 'COCO',
        'tahun'  => '2017',
        'genre' => ['Animation', 'Adventure', 'Comedy'],
        'pemeran utama' => 'Benjamin Bratt',
        'sutradara' => 'Adrian Molina'
    ],
    [
        'poster' => "harry potter.jpg",
        'judul' => 'Harry Potter',
        'tahun'  => '2011',
        'genre' => ['Fantasy', 'Adventure', 'Family'],
        'pemeran utama' => 'Emma Watson',
        'sutradara' => 'David yates'
    ],
    [
        'poster' => "soul.png",
        'judul' => 'Soul',
        'tahun'  => '2022',
        'genre' => ['Animation', 'Adventure', 'Comedy'],
        'pemeran utama' => 'Tina Fey',
        'sutradara' => 'Pete Docter'
    ],
    [
        'poster' => "twilight.jpg",
        'judul' => 'Twilight',
        'tahun'  => '2008',
        'genre' => ['Drama', 'Fantasy', 'romance'],
        'pemeran utama' => 'Kristen Stewart',
        'sutradara' => 'Catherine'
    ],
    [
        'poster' => "avatar 2.jpg",
        'judul' => 'Avatar 2',
        'tahun'  => '2022',
        'genre' => ['Action', 'Adventure', 'Fantasy'],
        'pemeran utama' => 'Zoe Saldana',
        'sutradara' => 'James Cameron'
    ],
    
];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan film</title>
    <!-- css -->
    <style>
        ul li img {
            width: 90px; 
            height : 120px;
        }

    </style>
</head>
<body>
    <h2>Film</h2>

    <!-- menambahkan index agar sesuai dengan index array -->

    <!-- poster -->
    <?php foreach ($film as $f) { ?>
  <ul>
    <li> Poster :
      <img src="img/<?= $f['poster']; ?>" alt="">
    </li>
  </ul>
  <br>
  <br>

  <!-- judul -->
    <li> Judul :
        <?= $f['judul']; ?>
    </li>
    <br>

    <!-- tahun -->
    <li> Tahun :
        <?= $f['tahun']; ?>
    </li>
    <br>

    <!-- genre -->
    <li> Genre :
        <?php foreach($f['genre'] as $g) {
            echo $g;
        } ?>
    </li>
    <br>

    <!-- pemeran utama -->
    <li> Pemeran Utama :
       <?= $f['pemeran utama']; ?>
    </li>
    <br>

    <!-- sutradara -->
    <li> Sutradara :
        <?= $f['sutradara']; ?>
    </li>
    <br>
    <br>
<?php } ?>


</body>
</html>