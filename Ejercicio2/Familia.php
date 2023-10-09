<?php

class Familia
{
    protected $familia = array();
    protected $conyuge = null;
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    public function agregarFamiliar($familiar)
    {
        array_unshift($this->familia, $familiar);
    }

    public function agregarConyuge($conyuge)
    {
        if ($this->conyuge === null) {
            $this->conyuge = $conyuge;
            $conyuge->agregarConyuge($this);
            $this->agregarFamiliar($conyuge);
        } else {
            echo $this->nombre . " ya está casado/a con " . $this->conyuge->getNombre() . "<br>";
        }
    }

    public function presentarFamilia(): array
    {
        return $this->familia;
    }

    public function mostrarEstadoCivil()
    {
        if ($this->conyuge !== null) {
            echo $this->nombre . " está casado/a con " . $this->conyuge->getNombre() . "<br>";
        } else {
            echo $this->nombre . " no está casado/a<br>";
        }
    }
}
