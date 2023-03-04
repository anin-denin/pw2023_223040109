<?php 
    // Date
    // untuk menampilkan tanggal dengan format tertentu
    echo date("l, d-M-Y <br>"); //l = nama hari

    // Time
    // UNIX Timestamp / EPOCH time
    // detik yg sudah berlalu sejak 1 januari 1970
    // (+) kedepan (-) ke belakang
    echo time();
    echo date("l, d M Y", time()-60*60*24*100);

    // mktime
    // membuat sendiri detik
    // mktime(0,0,0,0,0,0)
    // jam, menit, detik, bulan, tanggal, tahun
    // hari kelahiran
    echo date ("l", mktime(0,0,0,7,28,2004));

    // strtotime (string to time)
    echo date("l", strtotime("28 jul 2004"));
?>
