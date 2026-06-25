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