<?php

namespace App;

class Reserva
{
    private $cliente;
    private $habitacion;
    private $fechaIngreso;
    private $fechaSalida;

    public function __construct($cliente, $habitacion, $fechaIngreso, $fechaSalida)
    {
        $ingreso = \DateTime::createFromFormat('Y-m-d', $fechaIngreso);
        $salida = \DateTime::createFromFormat('Y-m-d', $fechaSalida);

        if (!$ingreso || $ingreso->format('Y-m-d') !== $fechaIngreso) {
            throw new \InvalidArgumentException("Formato de fecha de ingreso inválido. Use YYYY-MM-DD");
        }

        if (!$salida || $salida->format('Y-m-d') !== $fechaSalida) {
            throw new \InvalidArgumentException("Formato de fecha de salida inválido. Use YYYY-MM-DD");
        }

        $hoy = new \DateTime('today');
        if ($ingreso < $hoy) {
            throw new \InvalidArgumentException("La fecha de ingreso no puede ser en el pasado");
        }

        if ($salida <= $ingreso) {
            throw new \InvalidArgumentException("La fecha de salida debe ser posterior a la fecha de ingreso");
        }

        $this->cliente = $cliente;
        $this->habitacion = $habitacion;
        $this->fechaIngreso = $ingreso;
        $this->fechaSalida = $salida;

        $habitacion->reservar();
    }

    public function calcularTotal()
    {
        $dias = $this->fechaIngreso->diff($this->fechaSalida)->days;
        return $dias * $this->habitacion->getPrecio();
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getHabitacion()
    {
        return $this->habitacion;
    }

    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }
}