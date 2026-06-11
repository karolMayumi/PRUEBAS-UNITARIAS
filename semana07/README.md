# EJERCICICO DE LA SEMANA 07 Y 08
## HECHO POR MAYUMI
 Primero para ejecutar nuesras pruebas crearemos dos carpetas dentro de la carpeta de la semana07 de nombre (SRC y TESTS) con el siguiente codigo:
 ```bash
 mkdir src
 mkdir tests
 ```
 Luego Instalaremos el PHPUnit con el siguiente codigo:
 ```bash
 Composer require --dev phpunit/phpunit
 ```
 Despues agregaremos un autoload PS_04 a composer.json,abrimos composer.json y agregamos el siguiente codigo:
 ```php
 {
    "autoload": {
         "psr-4": { 
               "App\\": "src/"
        }
    },
  }
 ```
 Después actualizamos el autoload con el siguiente codigo:
 ```bash
 Composer dump-autoload
 ```
 Ahora después de actualizar creamos dos nuevo archivos uno dentro de src y el otro dentro de tests cada uno  de extención php como el siguiente: 
 **src/calculadora.php**
 **tests/calculadoraTest.php**
 Después realizamos nuestras Pruebas de suma,restar,multiplicar,dividir en la carpeta src/calculadora.php 
 ```php
 <?php

namespace App;

class Calculadora
{
    public function sumar($a, $b)
    {
        return $a + $b;
    }

    public function restar($a, $b)
    {
        return $a - $b;
    }

    public function multiplicar($a, $b)
    {
        return $a * $b;
    }

    public function dividir($a, $b)
    {
        if ($b == 0) {
            throw new \Exception("División entre cero");
        }
        return $a / $b;
    }
}
```
Después hacemos nuestra codificación en **tests/calculadoraTest.php**
```php
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
    }

    public function testRestar()
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
}
```
Ahora para ejecutar hasta ahi que son la Pruebas de la semana 07 usamos el siguiente codigo:
```bash
D:\Vsemestre\PRUEBAS UNITARIAS\semana07>vendor\bin\phpunit tets
```
AHORA CONTINUAREMOS CON LAS PRUEBAS DE LA SEMANA08 
Dentro del codigo de la semana07 en la carpeta de **src/Calculadora.php** agregamos el siguiente codigo:
```php
// NUEVAS FUNCIONES PARA LA SEMANA 08
    public function esPar($numero)
    {
        return $numero % 2 == 0;
    }

    public function esPositivo($numero)
    {
        return $numero > 0;
    }

    public function esNegativo($numero)
    {
        return $numero < 0;
    }

    public function esCero($numero)
    {
        return $numero == 0;
    }
```

Después en la carpeta **tests/CalculadoraTest.php** continuamos en el mismo codigo de la semana07 con el siguiente codigo:
```php
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
```
Ahora crearemos un archivo phpunit.xml en la raiz del proyecto la función principal es automatizar y ordenar la forma en que se ejecutan tus pruebas unitarias dentro del archivo ira el siguiente codigo:
```php
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php"
         colors="true"
         cacheDirectory=".phpunit.cache">
    <testsuites>
        <testsuite name="Tests">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```
Por ultimo para ejcutar todas las pruebas ejecutamos el siguiente codigo:
```bash
D:\Vsemestre\PRUEBAS UNITARIAS\semana07>vendor\bin\phpunit tets
```
Y listo asi es como ejecutamos las ORUEBAS UNITARIAS DE LA SEMANA 07 Y 08 ¡GRACIAS!