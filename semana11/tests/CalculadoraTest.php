<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Calculadora;
use InvalidArgumentException;

class CalculadoraTest extends TestCase
{
    private $calculadora;

    protected function setUp(): void
    {
        $this->calculadora = new Calculadora();
    }

    public static function proveedorDivisionNormal(): array
    {
        return [
            [10, 2, 5],
            [20, 4, 5],
            [9, 3, 3]
        ];
    }

    #[DataProvider('proveedorDivisionNormal')]
    public function testDividirNormal($dividendo, $divisor, $esperado)
    {
        $resultado = $this->calculadora->dividir($dividendo, $divisor);
        $this->assertEquals($esperado, $resultado);
    }

    public function testDividirEntreCero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->dividir(10, 0);
    }

    public function testRaizCuadradaNormal()
    {
        $this->assertEquals(3, $this->calculadora->raizCuadrada(9));
        $this->assertEquals(5, $this->calculadora->raizCuadrada(25));
    }

    public function testRaizCuadradaNegativa()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->raizCuadrada(-5);
    }

    public function testFactorialNormal()
    {
        $this->assertEquals(120, $this->calculadora->factorial(5));
        $this->assertEquals(24, $this->calculadora->factorial(4));
        $this->assertEquals(6, $this->calculadora->factorial(3));
    }

    public function testFactorialCero()
    {
        $resultado = $this->calculadora->factorial(0);
        $this->assertEquals(1, $resultado);
    }

    public function testFactorialNegativo()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->factorial(-3);
    }
}