<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use InvalidArgumentException;
use Exception;
use App\Habitacion;

class HabitacionTest extends TestCase
{
    #[Test]
    public function testNumeroCero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El número de habitación debe ser positivo");
        
        new Habitacion(0, "Doble", 100.00);
    }

    #[Test]
    public function testNumeroNegativo()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El número de habitación debe ser positivo");
        
        new Habitacion(-5, "Doble", 100.00);
    }

    #[Test]
    public function testPrecioCero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio debe ser positivo");
        
        new Habitacion(101, "Doble", 0);
    }

    #[Test]
    public function testPrecioNegativo()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio debe ser positivo");
        
        new Habitacion(101, "Doble", -50.00);
    }

    #[Test]
    public function testReservarHabitacionDisponible()
    {
        $habitacion = new Habitacion(101, "Doble", 100.00, true);
        
        $resultado = $habitacion->reservar();
        
        $this->assertTrue($resultado);
        $this->assertFalse($habitacion->isDisponible());
    }

    #[Test]
    public function testReservarHabitacionNoDisponible()
    {
        $this->expectException(Exception::class);
        
        $habitacion = new Habitacion(101, "Doble", 100.00, false);
        $habitacion->reservar();
    }
}