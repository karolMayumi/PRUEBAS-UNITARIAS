# EJERCICIOS DE SEMANA 11
## HECHO POR MAYUMI
### PASO 1:
Para hacer funiconar estas pruebas unitarias primero creare una carpeta dentro de mi carpeta principal(PRUEBAS UNITARIAS) con el siguiente codigo:
```bash
mkdir semana11
```
Despues ingresaremos a la carpeta crea con el siguiente codigo
```bash
cd semana11
```
### PASO 2:
Para poder ejecutar las prubas configuraremos phpunit con el siguiente codigo:
```bash
composer require --dev phpunit/phpunit
```
### PASO 3: 
Dentro de la carpeta de nombre semana11 creare dos carpetas con los siguientes nombres y con el siguiente codigo:
```bash
mkdir src
mkdir tests
```
### PASO 4:
* **4.1** Dentro de la carpeta de src crearemos dos carpetas de extecion phpunit con los nombres: **Calculadora.php** y **Validador.php**
* **4.2** Dentro de la carpeta de tests creamos tambien dos carpetas tambien con extencion phpunit de nombres: **CalculadoraTest.php** y **ValidadorTest.php**

### PASO 5:
Una vez lista creado todas las carpetas que usaremos para ejecutar nuestras pruebas empezaremos con la configuracion en Composer.json con el siguiente codigo:
```php
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
### PASO 6:
Crearemos la clase en src/Calculadora.php 
```php
<?php

namespace App;

class Calculadora
{
    public function dividir($a, $b)
    {
        if ($b ==0) {
            throw new \InvalidArgumentException("No se puede dividir por cero");
        }
        return $a / $b;
    }

public function raizCuadrada($numero)
{
    if ($numero < 0) {
        throw new \InvalidArgumentException("No se puede calcular la raiz cuadrada de un número negativo");
    }
    return sqrt($numero);
 }

 // AGREGADO: Método para el Paso 7
    public function factorial($n)
    {
        if ($n < 0) {
            throw new \InvalidArgumentException("El número no puede ser negativo");
        }

        if ($n == 0) {
            return 1;
        }

        $resultado = 1;
        for ($i = 1; $i <= $n; $i++) {
            $resultado *= $i;
        }

        return $resultado;
    }
}
```
### Paso 7
Crearemos la clase validador dentro de src/Validador.php
```php
<?php

namespace App;

class Validador
{
    public function validarEdad($edad)
    {
        if ($edad < 0) {
            throw new \InvalidArgumentException("La edad no puede ser un numero negativo");
        }
        if ($edad < 18) {
            throw new \Exception("Es menor de edad");
        }
        return true;
    }

    public function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("El email ingresado no es válido");
        }
        return true;
    }

    // AGREGADO: Método para el Paso 7
    public function validarPassword($password)
    {
        if (strlen($password) < 8) {
            throw new \Exception("Contraseña demasiado corta");
        }

        if (!preg_match('/[0-9]/', $password)) {
            throw new \Exception("Debe contener al menos un número");
        }

        return true;
    }
}
```
### Paso 8 
Creare una prueba en tests/CalculadoraTest.php
```php
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
```
### Paso 9
Ahora creamos la pruebas en tests/ValidadorTest.php
```php
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validador;
use Exception;
use InvalidArgumentException;

class ValidadorTest extends TestCase
{
    private $validador;

    protected function setUp(): void
    {
        $this->validador = new Validador();
    }

    public function testValidarEdadNormal()
    {
        $this->assertTrue($this->validador->validarEdad(20));
    }

    public function testValidarEdadNegativa()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La edad no puede ser un numero negativo");
        $this->validador->validarEdad(-5);
    }

    public function testValidarEdadMenor()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Es menor de edad");
        $this->validador->validarEdad(15);
    }

    public function testValidarEmailNormal()
    {
        $this->assertTrue($this->validador->validarEmail("correo@ejemplo.com"));
    }

    public function testValidarEmailInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El email ingresado no es válido");
        $this->validador->validarEmail("correo-invalido");
    }

    public function testValidarPasswordNormal()
    {
        $this->assertTrue($this->validador->validarPassword("Secret123"));
    }

    public function testValidarPasswordCorta()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Contraseña demasiado corta");
        $this->validador->validarPassword("Sec1");
    }

    public function testValidarPasswordSinNumero()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Debe contener al menos un número");
        $this->validador->validarPassword("SoloLetras");
    }
}
```
### Paso 10
Creare un archivo de nombre phpunit.xml en la raiz de mi proyecto para que las pruebas salan de manera ordena.
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
### PASO 11
Ahora ejecutare la pruebas
```bash
vendor\bin\phpunit tests
```
Y para ver todo mas ordenado 
```bash
vendor\bin\phpunit tests --testdox
```
Y listo asi es como deberia ejecutarse las pruebas de la semana 11 ¡GRACIAS!

