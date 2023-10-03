<?php
//$numbers = [6,11,4,21,12];
//echo 'Hello';
//$numbers = $_GET["arreglo"] . '!';
//$numbers = array($_GET["arreglo"]);
$numbers = json_decode($_GET["arreglo"] ?? "[]");
$value = 15;


//ordenar de manera ascendente
sort($numbers);

print_r($numbers);

//obtener la longitud del array
$length = count($numbers);
print_r("<br>Largo de arreglo: $length<br>");

if ($length > 0) {
    //Cálculo de mediana----------------------------------------------
    $half_length = $length / 2;

    $median_index = (int) $half_length;

    //get median number
    $median = $numbers[$median_index];
    print_r("La mediana del arreglo es: " . $median);

    //Cálculo de media------------------------------------------------
    $sumOfNumbers = array_sum($numbers);
    print_r("<br> Suma de números " . $sumOfNumbers);
    $mean = $sumOfNumbers / $length;
    print_r("<br> La media es: " . $mean);

    //Cálculo de moda-------------------------------------------------
    $multiDArr = [];
    for ($i = 0; $i < count($numbers); $i++) {
        $key = $numbers[$i];
        // Verifica si el valor actual ya está en el arreglo de recuento ($multiDArr).
        if (isset($multiDArr[$key])) {
            $multiDArr[$key] = $multiDArr[$key] + 1;
        } else {
            $multiDArr[$key] = 1;
        }
    }

    $highestOcurring = 0;
    $mode = null;

    if (count($multiDArr) === count($numbers)) {
        echo "<br>No hay moda, no hay números repetidos";
    } else {
        foreach ($multiDArr as $key => $value) {
            if ($value > $highestOcurring) {
                $highestOcurring = $value;
                $mode = $key;
            }
        }
        print_r("<br>La moda es: " . $mode);
    }

} else {
    print_r("No existe arreglo para realizar cálculos");
}
?>