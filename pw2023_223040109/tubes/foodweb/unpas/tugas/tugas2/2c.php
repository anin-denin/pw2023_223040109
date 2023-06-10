

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>2c.php</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        line-height: 0;
      }
      .kotak {
        width: 50px;
        width: 50px;
        border: 1px solid black;
        line-height: 50px;
        text-align: center;
        display: inline-block;
        margin-right: -5px;
        background: salmon;
      }
    </style>
  </head>
  <body>
<?php 
  $num_rows = 10;
    for ($i = $num_rows; $i >= 1; $i--) { // perulangan baris
        for ($j = 1; $j <= $i; $j++) { // perulangan kolom
            echo "<div class=\"kotak\">$j</div>";
        }
        echo "<br>"; // pindah baris setelah selesai menampilkan angka di setiap baris
      }
      
?>
    
  </body>
</html>
