<?php
//$numbers = [6,11,4,21,12];
//echo 'Hello';
//$numbers = $_GET["arreglo"] . '!';
//$numbers = array($_GET["arreglo"]);
$numbers = json_decode($_GET["arreglo"] ?? "[]");
$value = 15;



sort($numbers);

print_r($numbers);

$length = count($numbers);
print_r("<br>Largo de arreglo: $length<br>");

if ($length > 0) {
    //Cálculo de mediana
    $half_length = $length / 2;

    $median_index = (int) $half_length;

    //get median number
    $median = $numbers[$median_index];
    print_r("La mediana del arreglo es: " . $median);

    //Cálculo de media
    $sumOfNumbers = array_sum($numbers);
    print_r("<br> Suma de números " . $sumOfNumbers);
    $mean = $sumOfNumbers / $length;
    print_r("<br> La media es: " . $mean);

    //Cálculo de moda
    // for ($i=0; $i < ; $i++) { 
    //     # code...
    // }

} else {
    print_r("No existe arreglo para realizar cálculos");
}
?>