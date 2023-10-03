<?php
    //$numbers = [6,11,4,21,12];
    //echo 'Hello';
    //$numbers = $_GET["arreglo"] . '!';
    //$numbers = array($_GET["arreglo"]);
    $numbers = json_decode($_GET["arreglo"]??"[]");
    $value = 15;

    

    sort($numbers);

    print_r($numbers);

    $length = count($numbers);
    print_r("<br>Largo de arreglo: $length<br>");

    if($length > 0){
        $half_length = $length / 2;
        
        $median_index = (int) $half_length;

        //get median number
        $median = $numbers[$median_index];
        print_r("La mediana del arreglo es: ". $median);
    }else{
        print_r("No existe arreglo para realizar cálculos");
    }
?>