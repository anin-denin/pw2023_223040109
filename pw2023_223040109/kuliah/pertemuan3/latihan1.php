<?php 
echo "Mulai <br>";
$nilai_awal = 1;
while ($nilai_awal <= 10) {
    echo "Hello World $nilai_awal x!<br>";
    $nilai_awal += 1; //atau cara singkat -- (-= 1) 
}
echo "Selesai";


echo "<hr>";

echo "Mulai <br>";
for ($nilai_awal = 1; $nilai_awal <= 10; $nilai_awal++) {
    echo "Hello World $nilai_awal kali.<br>";
}

echo "Selesai <br>";
?>