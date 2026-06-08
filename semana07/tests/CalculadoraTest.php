<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    public function testSumar()
    {
        // ARRANGE
        $calc = new Calculadora();

        // ACT
        $resultado = $calc->sumar(5, 3);

        // ASSERT
        $this->assertEquals(8, $resultado);
    }public function testRestar()
    {
        $calc = new Calculadora();
        $resultado = $calc->restar(10, 4);
        $this->assertEquals(6, $resultado);
    }

    public function testMultiplicar()
    {
        $calc = new Calculadora();
        $resultado = $calc->multiplicar(4, 5);
        $this->assertEquals(20, $resultado);
    }

    public function testDividir()
    {
        $calc = new Calculadora();
        $resultado = $calc->dividir(10, 2);
        $this->assertEquals(5, $resultado);
    }

    public function testDividirEntreCero()
    {
        $this->expectException(\Exception::class);
        $calc = new Calculadora();
        $calc->dividir(10, 0);
    }

    public function testEsPar()
    {
        $calc = new Calculadora();
        $this->assertTrue($calc->esPar(4));
        $this->assertFalse($calc->esPar(5));
        $this->assertTrue($calc->esPar(0));
    }

    public function testEsPositivo()
    {
        $calc = new Calculadora();
        $this->assertTrue($calc->esPositivo(10));
        $this->assertFalse($calc->esPositivo(-5));
        $this->assertFalse($calc->esPositivo(0));
    }

    public function testEsNegativo()
    {
        $calc = new Calculadora();
        $this->assertTrue($calc->esNegativo(-10));
        $this->assertFalse($calc->esNegativo(5));
        $this->assertFalse($calc->esNegativo(0));
    }

    public function testEsCero()
    {
        $calc = new Calculadora();
        $this->assertTrue($calc->esCero(0));
        $this->assertFalse($calc->esCero(5));
        $this->assertFalse($calc->esCero(-5));
    }
}