<?php

namespace App;

class Habitacion
{
    private $numero;
    private $tipo;
    private $precio;
    private $disponible;

    public function __construct($numero, $tipo, $precio, $disponible = true)
    {
        if ($numero <= 0) {
            throw new \InvalidArgumentException("El número de habitación debe ser positivo");
        }

        if ($precio <= 0) {
            throw new \InvalidArgumentException("El precio debe ser positivo");
        }

        $this->numero = $numero;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->disponible = $disponible;
    }

    public function reservar()
    {
        if (!$this->disponible) {
            throw new \Exception("La habitación no está disponible");
        }

        $this->disponible = false;
        return true;
    }

    public function liberar()
    {
        $this->disponible = true;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function isDisponible()
    {
        return $this->disponible;
    }
}