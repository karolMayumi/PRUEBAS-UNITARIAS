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