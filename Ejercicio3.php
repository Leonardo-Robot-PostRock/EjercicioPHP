<?php

class Saludador {
    function saludar($nombre=""){
        if($nombre ===""){
            echo "Hola, mundo.";
        }else{
            echo "Hola, " . $nombre . ".";
        }
    }
}

$s=new Saludador();
$s->saludar();
echo "<br>";
$s->saludar("Leonardo");