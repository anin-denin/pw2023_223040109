<?php 
require('functions.php');
$title = 'Home';

    $students = [
        [
            "nama" => "Anin Denin Nadia",
            "npm" => "223040109",
            "email" => "anindeninadia@gmail.com",
        ],
        [
            "nama" => "Jennie RubyJane",
            "npm" => "223040008",
            "email" => "jennieruby@gmail.com",
        ],
        
    ];

// echo $_SERVER["REQUEST_URI"];
// /pw2023_223040109/kuliah/pertemuan9/

require('views/index.view.php');
?>
