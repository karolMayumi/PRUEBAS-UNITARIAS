# SISTEMA HOTEL DE SEMANA 12
## HECHO POR MAYUMI
### PASO 1:
Para hacer funiconar estas pruebas unitarias primero creare una carpeta dentro de mi carpeta principal(PRUEBAS UNITARIAS) con el siguiente codigo:
```bash
mkdir semana12
```
Despues ingresaremos a la carpeta crea con el siguiente codigo
```bash
cd semana12
```
### PASO 2:
Para poder ejecutar las prubas configuraremos phpunit con el siguiente codigo:
```bash
composer require --dev phpunit/phpunit
```
### PASO 3: 
Dentro de la carpeta de nombre semana12 creare dos carpetas con los siguientes nombres y con el siguiente codigo:
```bash
mkdir src
mkdir tests
```
### PASO 4:
* **4.1** Dentro de la carpeta de src crearemos dos carpetas de extecion phpunit con los nombres: **Cliente.php**,**Habitacion.php** y **Reserva.php**.
* **4.2** Dentro de la carpeta de tests creamos tambien dos carpetas tambien con extencion phpunit de nombres: **ClienteTest.php**, **HabitacionTest.php** y **ReservaTest.php**.

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
Crearemos la clase en src/Cliente.php aqui es donde corregiremos el codigo :
## 1.-Evitamos que se cree un cliente sin nombre.
## 2.-Evita emails con formato incorrecto.
```php
<?php

namespace App;  

class Cliente
{
    private $nombre;
    private $email;
    private $telefono;

    public function __construct($nombre, $email, $telefono)
    {
        if (empty(trim($nombre))) {
            throw new \InvalidArgumentException("El nombre no puede estar vacío");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("El email no tiene un formato válido");
        }

        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }
}
```
### PASO 7:
Crearemos la clase en src/Habitacion.php aqui es donde corregiremos el codigo :
## 1.-Evita que se creen habitaciones con número 0 o negativo.
## 2.-Evita que se creen habitaciones con precio 0 o negativo.
## 3.-Evita que se reserve una habitación que ya está ocupada.
## 4.-Notifica al usuario que la habitación no está disponible.
```php
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
```
### PASO 8:
Crearemos la clase en src/Reserva.php aqui es donde corregiremos el codigo :
## 1.-Evita fechas en formato incorrecto (ej: 2024/01/15).
## 2.-Evita fechas en formato incorrecto.
## 3.-Evita reservas con fecha de ingreso en el pasado.
## 4.-Evita que la salida sea antes que el ingreso.
## 5.-Calcula los días reales entre ingreso y salida.
```php
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
```
### Paso 9:
Creare una prueba en tests/ClienteTest.php
```php
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use InvalidArgumentException;
use App\Cliente;

class ClienteTest extends TestCase
{
    #[Test]
    public function testNombreVacio()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El nombre no puede estar vacío");
        
        new Cliente("", "test@email.com", "123456789");
    }

    #[Test]
    public function testEmailInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El email no tiene un formato válido");
        
        new Cliente("Juan Perez", "email-invalido", "123456789");
    }
}
```
### Paso 10:
Creare una prueba en tests/HabitacionTest.php
```php
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
```
### Paso 11:
Creare una prueba en tests/ReservaTest.php
```php
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
```
### Paso 12:
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
### PASO 13:
Ahora ejecutare la pruebas
```bash
vendor\bin\phpunit tests
```
Y para ver todo mas ordenado 
```bash
vendor\bin\phpunit tests --testdox
```
Y listo asi es como deberia ejecutarse las pruebas de la semana 12 ¡GRACIAS!

