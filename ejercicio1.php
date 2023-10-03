<?php

$numbers = json_decode($_GET["arreglo"] ?? "[]");

if (count($numbers) > 0) {
    //ordenar de manera ascendente
    sort($numbers);

    //Mostrar arreglo
    echo "Arreglo ordenado de manera ascendente<br>";
    print_r($numbers);

    //obtener la longitud del array
    $length = count($numbers);

    print_r("<br>Largo de arreglo: $length");

    //Cálculo de mediana----------------------------------------------
    $index = floor($length / 2);
    $median;
    //Se puede realizar verficación de otra manera cómo por ejemplo if($length & 1), es una operación de "bitwise AND". 
    if (count($numbers) > 0) {
        if ($length % 2) {
            $median = $numbers[$index];
        } else {
            //get median number
            $median = ($numbers[$index - 1] + $numbers[$index]) / 2;

        }
        echo "<br>La mediana del arreglo es: " . $median;
    } else {
        echo "<br>La mediana del arreglo no existe, array vacío";
    }


    //Cálculo de media------------------------------------------------
    $sumOfNumbers = array_sum($numbers);
    if (count($numbers) > 1) {
        print_r("<br> Suma de números: " . $sumOfNumbers);
        $mean = $sumOfNumbers / $length;
        print_r("<br> La media es: " . $mean . "<br>");
    } else {
        echo "<br>No se puede calcular la media con un sólo elemento.";
    }

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


    if (count($multiDArr) === count($numbers)) {
        echo "<br>No hay moda, no hay números repetidos.";
    } else {
        $modes = array_keys($multiDArr, max($multiDArr));
        if (count($modes) > 1) {
            echo "Las modas son: ";
        }else {
            echo "La moda es: ";
        }
        for ($i = 0; $i < count($modes); $i++) {
            if ($modes[$i] !== end($modes)) {
                print_r($modes[$i] . "|");
            } else {
                print_r($modes[$i]);
            }
        }
    }


    // print_r("<br>La moda es: " . $modes[0]);

    // echo "<br>Las modas son: " . implode($modes[$i]);


} else {
    print_r("No existe arreglo para realizar cálculos");
}
?>