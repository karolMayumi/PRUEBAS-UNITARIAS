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