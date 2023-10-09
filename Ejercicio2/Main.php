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
$conyuge1->setNacimiento("17/09/2000");
$persona->agregarConyuge($conyuge1);

$conyuge2 = new Conyuge("Julia");
$persona->agregarConyuge($conyuge2);
$conyuge2->setNacimiento("17/09/1999");


// Llamar al método imprimir para mostrar la información
$persona->imprimir();
