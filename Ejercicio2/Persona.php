<?php
require_once 'Familia.php';

class Persona extends Familia
{ 
    private string $nacimiento;

    public function __construct(string $nombre)
    {
        parent::__construct($nombre);
        $this->nacimiento = date("d/m/y");
    }

    /**
     * @param string $nacimiento 
     * @return self
     */
    public function setNacimiento(string $nacimiento): self
    {
        $this->nacimiento = $nacimiento;
        return $this;
    }

    public function contarEdad(): int
    {
        $fechaNacimiento = date($this->nacimiento);
        $fechaNacimiento = explode("/", $fechaNacimiento);
        $edad = (date("md", date("U", mktime(0, 0, 0, $fechaNacimiento[0], $fechaNacimiento[1], $fechaNacimiento[2]))) > date("md")
            ? ((date("Y") - $fechaNacimiento[2]) - 1)
            : (date("Y") - $fechaNacimiento[2]));
        return $edad;
    }

    public function imprimir()
    {
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Fecha de Nacimiento: " . $this->nacimiento . "<br>";
        echo "Edad: " . $this->contarEdad() . " años<br>";

        echo "Familiares de sangre : ";


        $count = count($this->familia);
        $index = 0;
        
        foreach ($this->familia as $familiar) {
            if ($familiar instanceof Persona) {
                echo $familiar->nombre;
                if($index < $count - 2 ){
                    echo " * ";
                }
                $index++;
            }
        }
        echo "<br>";
        echo "Cónyuge: ";
            if ($this->conyuge instanceof Conyuge) {
                echo $this->conyuge->getNombre() . "";
            }
        }
    }

