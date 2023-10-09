<?php

require_once 'Persona.php';
require_once 'Hijos.php';
require_once 'Padres.php';
require_once 'Conyuge.php';

$persona = new Persona("Juan");
$persona->setNacimiento("10/3/1994");

// Agregar familiares
$familiar1 = new Hijos("María");
$familiar2 = new Padres("Pedro");

$persona->agregarFamiliar($familiar1);
$persona->agregarFamiliar($familiar2);

// Agregar un cónyuge (si corresponde)
$conyuge1 = new Conyuge("Ana");
$persona->agregarConyuge($conyuge1);

function mostrarInfo($data)
{
    echo '<h2>' . $data->getNombre() . '</h2>';

    if ($data instanceof Persona) {
        echo '<h3>Familiares de ' . $data->getNombre() . '</h3>';
        echo '<ul>';
        foreach ($data->presentarFamilia() as $familiar) {
            echo '<li>' . $familiar->getNombre() . '</li>';
        }
        echo '</ul>';
    }
}
mostrarInfo($persona);
//No es agregada por lo que ya tiene conyuge
$conyuge2 = new Conyuge("Julia");
$persona->agregarConyuge($conyuge2);

$conyuge1->mostrarEstadoCivil();
echo "<br>";
// Llamar al método imprimir para mostrar la información
$persona->imprimir();
