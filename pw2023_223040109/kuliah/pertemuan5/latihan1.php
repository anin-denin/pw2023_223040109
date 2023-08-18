<?php 
    // ARRAY
    // Membuat Array
    $hari = array ('Senin', 'Selasa', 'Rabu');
    $bulan = ['Januari', 'Februari', 'Maret'];
    $myArray = ['Anin', 17, false];
    $binatang = ['🐇', '🐿', '🐘', '🐋', '🐳'];

    // Menampilkan isi Array
    // mencetak satu elemen array menggunakan index
    echo $hari[1];
    echo "<hr>";


    // mencetak seluruh isi array
    // var_dump, print_r
    var_dump($hari);
    echo "<br>";
    print_r($bulan);
    echo"<br>";
    var_dump($myArray);
    echo"<br>";
    print_r($binatang);

    echo"<hr>";

    // Manipulasi isi array
    // isi elemen menggunakan index nya
    $hari[3] = "Kamis";
    print_r($hari);
    echo"<br>";

    // menambahkan elemen di akhir array menggunakan index kosong[]
    $hari[] = "jum'at";
    $hari[] = "Sabtu";
    print_r($hari);

    echo "<br>";


    // Menambahkan elemen baru di akhir array menggunakan array_push()
    array_push($bulan, "April", "Mei", "Juni", "Juli", "Agustus");
    print_r($bulan);

    echo"<hr>";
    // Menambahkan eleme baru di awal array menggunakan array_unshift
    array_unshift($binatang, '🐶', '🐺', '🐵');
    print_r($binatang);

    echo"<hr>";

    // Menghapus elemen di akhir array menggunakan array_pop
    array_pop($hari);
    array_pop($hari);
    print_r($hari);

    echo"<hr>";

    // menghapus elemen diawal array menggunakan array_shift
    array_shift($hari);
    print_r($hari);
?>