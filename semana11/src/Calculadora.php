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

