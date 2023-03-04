<?php 
    function hitungLuasLingkaran($r) {
        $luas = 3.14 *$r *$r;
        return $luas;
    }

    function hitungKelilingLingkaran($r) {
        $keliling = 2 * 3.14 *$r;
        return $keliling;
    }

    $r_luas = 10;
    $r_keliling = 20;

    $luas_lingkaran = hitungLuasLingkaran($r_luas);
    $keliling_lingkaran = hitungKelilingLingkaran ($r_keliling);

    echo "<b>Menghitung Luas Lingkaran </b><br><br>";
    echo "Jari-jari = " . $r_luas . " cm <br>";
    echo "Luas Lingkaran = " . $luas_lingkaran . " cm².";

    echo "<hr>";

    echo "<b>Menghitung Keliling Lingkaran</b><br><br>";
    echo "jari-jari = " . $r_keliling . " cm.<br>";
    echo "Keliling lingkaran = " . $keliling_lingkaran . " cm.";
?>