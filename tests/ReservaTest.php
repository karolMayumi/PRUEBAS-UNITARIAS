<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use InvalidArgumentException;
use App\Cliente;
use App\Habitacion;
use App\Reserva;

class ReservaTest extends TestCase
{
    private $cliente;
    private $habitacion;

    protected function setUp(): void
    {
        $this->cliente = new Cliente("Juan Perez", "juan@email.com", "123456789");
        $this->habitacion = new Habitacion(101, "Doble", 100.00, true);
    }

    #[Test]
    public function testFechaIngresoInvalida()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Formato de fecha de ingreso inválido. Use YYYY-MM-DD");
        
        new Reserva(
            $this->cliente,
            $this->habitacion,
            "2024/01/15",
            "2024-01-20"
        );
    }

    #[Test]
    public function testFechaIngresoPasado()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de ingreso no puede ser en el pasado");
        
        $fechaPasado = date('Y-m-d', strtotime('-1 day'));
        
        new Reserva(
            $this->cliente,
            $this->habitacion,
            $fechaPasado,
            date('Y-m-d', strtotime('+5 days'))
        );
    }

    #[Test]
    public function testFechaSalidaAnterior()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de salida debe ser posterior a la fecha de ingreso");
        
        $fechaIngreso = date('Y-m-d', strtotime('+5 days'));
        $fechaSalida = date('Y-m-d', strtotime('+1 day'));
        
        new Reserva(
            $this->cliente,
            $this->habitacion,
            $fechaIngreso,
            $fechaSalida
        );
    }

    #[Test]
    public function testCalcularTotal()
    {
        $fechaIngreso = date('Y-m-d', strtotime('+10 days'));
        $fechaSalida = date('Y-m-d', strtotime('+15 days'));
        
        $reserva = new Reserva(
            $this->cliente,
            $this->habitacion,
            $fechaIngreso,
            $fechaSalida
        );
        
        $total = $reserva->calcularTotal();
        
        $this->assertEquals(500.00, $total);
    }
}