<?php
require('functions.php');

$title = 'Form Tambah Data';

// Insert data jika tombol di klik
if(isset($_POST['tambah'])) {
    // tampilkan pesan jika data berhasil ditambahkan
    if(tambah($_POST) > 0) {
        echo "<script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    }
}

require('views/tambah.view.php');


