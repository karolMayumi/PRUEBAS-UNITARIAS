<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    private $calculadora;

    protected function setUp(): void
    {
        $this->calculadora = new Calculadora();
    }

    // ------------------------- PROVEEDORES (DEBEN SER STATIC) -------------------------

    public static function proveedorSuma(): array
    {
        return [
            [5, 3, 8],
            [0, 0, 0],
            [-5, 3, -2],
            [100, 200, 300],
        ];
    }

    public static function proveedorResta(): array
    {
        return [
            [10, 4, 6],
            [5, 10, -5],
            [0, 5, -5],
            [100, 50, 50],
        ];
    }

    public static function proveedorMultiplicacion(): array
    {
        return [
            [4, 5, 20],
            [7, 0, 0],
            [-3, 4, -12],
            [10, 10, 100],
        ];
    }

    public static function proveedorDivision(): array
    {
        return [
            [10, 2, 5, false],
            [7, 2, 3.5, false],
            [0, 5, 0, false],
            [10, 0, null, true],
        ];
    }

    // ------------------------- PRUEBAS -------------------------

    #[DataProvider('proveedorSuma')]
    public function testSumar($a, $b, $esperado)
    {
        $resultado = $this->calculadora->sumar($a, $b);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('proveedorResta')]
    public function testRestar($a, $b, $esperado)
    {
        $resultado = $this->calculadora->restar($a, $b);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('proveedorMultiplicacion')]
    public function testMultiplicar($a, $b, $esperado)
    {
        $resultado = $this->calculadora->multiplicar($a, $b);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('proveedorDivision')]
    public function testDividir($a, $b, $esperado, $expectException)
    {
        if ($expectException) {
            $this->expectException(\InvalidArgumentException::class);
            $this->calculadora->dividir($a, $b);
        } else {
            $resultado = $this->calculadora->dividir($a, $b);
            $this->assertEquals($esperado, $resultado);
        }
    }
}