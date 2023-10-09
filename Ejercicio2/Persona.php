<?php
class Persona
{
    private string $nombre;
    private string $nacimiento;
    private $familia = array();
    private $conyuge = array();

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
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

    public function esMayorDeEdad(): bool
    {
        $edad = $this->contarEdad();
        return $edad >= 18;
    }

    public function presentarFamilia(): array
    {
        return $this->familia;
    }

    public function agregarFamiliar(Persona $familiar)
    {
        $this->familia[] = $familiar;
    }

    public function agregarConyuge(Persona $conyuge)
    {
        $esMayor = $this->esMayorDeEdad();
        $esMayorConyuge = $conyuge->esMayorDeEdad();
        if ($esMayor && $esMayorConyuge && count($this->conyuge) < 1) {
            $tieneConyuge = false;
            foreach ($this->conyuge as $c) {
                if ($c->nombre === $conyuge->nombre) {
                    $tieneConyuge = true;
                    break;
                }
            }
            if (!$tieneConyuge) {
                array_unshift($this->conyuge, $conyuge);
            }
        }
    }

    public function imprimir()
    {
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Fecha de Nacimiento: " . $this->nacimiento . "<br>";
        echo "Edad: " . $this->contarEdad() . " años<br>";

        if ($this->esMayorDeEdad()) {
            echo "Es mayor de edad.<br>";
        } else {
            echo "No es mayor de edad.<br>";
        }

        echo "Familiares:<br>";
        foreach ($this->familia as $familiar) {
            if ($familiar instanceof Persona) {
                echo $familiar->nombre . "<br>";
            }
        }

        echo "Cónyuge:<br>";
        foreach ($this->conyuge as $conyuge) {
            if ($conyuge instanceof Persona) {
                echo $conyuge->nombre . "<br>";
            }
        }
    }
}
