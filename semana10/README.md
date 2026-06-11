# EJERCICIOS DE SEMANA 10
## HECHO POR MAYUMI
### PASO 1:
Para hacer funiconar estas pruebas unitarias primero creare una carpeta dentro de mi carpeta principal(PRUEBAS UNITARIAS) con el siguiente codigo:
```bash
mkdir semana10
```
Despues ingresaremos a la carpeta crea con el siguiente codigo
```bash
cd semana10
```
### PASO 2:
Para poder ejecutar las prubas configuraremos phpunit con el siguiente codigo:
```bash
composer require --dev phpunit/phpunit
```
### PASO 3:
Dentro de la carpeta de nombre semana10 creare dos carpetas con los siguientes nombres y con el siguiente codigo:
```bash
mkdir src
mkdir tests
```
### PASO 4:
4.1 Dentro de la carpeta de src crearemos dos carpetas de extecion phpunit con los nombres: **Calculadora.php** y **Validador.php**
4.2 Dentro de la carpeta de tests creamos tambien dos carpetas tambien con extencion phpunit de nombres: **CalculadoraTest.php** y **ValidadorTest.php**

### PASO 5:
Una vez lista creado todas las carpetas que usaremos para ejecutar nuestras pruebas empezaremos con la configuracion en Composer.json con el siguiente codigo:
```bash
{
    "require-dev": {
        "phpunit/phpunit": "^13.2"
    },
    "autoload": {
        "psr-4": {
            "App\\":"src/"
        }
    }
}
```
```
Composer dump-autoload
```
### PASO 6
Crearemos la clase en src/Calculadora.php 
```bash
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
            throw new \InvalidArgumentException("División por cero");
        }
        return $a / $b;
    }
}
```
### Paso 7
Crearemos la clase validador dentro de src/Validador.php
```bash
<?php

namespace App;

class Validador
{
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
}
```
### Paso 8 
Creare una prueba en tests/CalculadoraTest.php
```bash
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
```
### Paso 9
Ahora creamos la pruebas en tests/ValidadorTest.php
```bash
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Validador;

class ValidadorTest extends TestCase
{
    private $validador;

    protected function setUp(): void
    {
        $this->validador = new Validador();
    }

    // ------------------------- PROVEEDORES (DEBEN SER STATIC) -------------------------

    public static function proveedorEsPar(): array
    {
        return [
            [4, true],
            [5, false],
            [0, true],
            [-2, true],
        ];
    }

    public static function proveedorEsPositivo(): array
    {
        return [
            [10, true],
            [0, false],
            [-5, false],
        ];
    }

    // ------------------------- PRUEBAS -------------------------

    #[DataProvider('proveedorEsPar')]
    public function testEsPar($numero, $esperado)
    {
        $resultado = $this->validador->esPar($numero);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('proveedorEsPositivo')]
    public function testEsPositivo($numero, $esperado)
    {
        $resultado = $this->validador->esPositivo($numero);
        $this->assertEquals($esperado, $resultado);
    }
}
```
### Paso 10
Creare un archivo de nombre phpunit.xml en la raiz de mi proyecto para que las pruebas salan de manera ordena.
```bash
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
### PASO 11
Ahora ejecutare la pruebas
```bash
vendor\bin\phpunit tests
```
Y para ver todo mas ordenado 
```bash
vendor\bin\phpunit tests --testdox
```
Y listo asi es como deberia ejecutarse las pruebas de la semana 10 ¡GRACIAS!