<?php 
    function urutAngka($angka) {
        $baris = 1;
        $i = 1;
        while ($i <= $angka) {
          for ($j = 1; $j <= $baris; $j++) {
            echo $i . " ";
            $i++;
          }
          echo "<br/>";
          $baris++;
        }
      }
      
      // contoh pemanggilan function
      echo urutAngka(15);
      
?>