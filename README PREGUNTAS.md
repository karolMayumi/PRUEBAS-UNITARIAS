# Preguntas de la semana09

## 1.-¿Qué ventajas tiene usar `dataProvider` frente a escribir pruebas individuales para cada caso?

El uso de `dataProvider` permite ejecutar una misma prueba con diferentes conjuntos de datos, evitando la duplicación de código. Esto facilita el mantenimiento, mejora la organización de las pruebas y permite aumentar la cobertura de casos de prueba de forma sencilla.

**Ejemplo sin `dataProvider`:**

```php
public function testSuma1()
{
    $this->assertEquals(3, 1 + 2);
}

public function testSuma2()
{
    $this->assertEquals(5, 2 + 3);
}

public function testSuma3()
{
    $this->assertEquals(10, 5 + 5);
}
```

**Ejemplo con `dataProvider`:**

```php
#[DataProvider('proveedorSuma')]
public function testSuma($a, $b, $resultado)
{
    $this->assertEquals($resultado, $a + $b);
}

public static function proveedorSuma(): array
{
    return [
        [1, 2, 3],
        [2, 3, 5],
        [5, 5, 10]
    ];
}
```

---

## 2.-¿Cómo se manejan las excepciones dentro de un `dataProvider`?

Las excepciones generalmente se validan dentro del método de prueba utilizando `expectException()`. El `dataProvider` únicamente proporciona los datos necesarios para determinar cuándo se espera una excepción.

**Ejemplo:**

```php
#[DataProvider('proveedorDivision')]
public function testDivision($a, $b, $esperaExcepcion)
{
    if ($esperaExcepcion) {
        $this->expectException(\DivisionByZeroError::class);
    }

    $resultado = $a / $b;
}

public static function proveedorDivision(): array
{
    return [
        [10, 2, false],
        [20, 4, false],
        [5, 0, true]
    ];
}
```

---

## 3.-¿Qué tipo de datos debe retornar el método proveedor?

El método proveedor debe retornar un arreglo (`array`) o un iterable que contenga los conjuntos de datos que serán utilizados por la prueba.

**Ejemplo:**

```php
public static function proveedorUsuarios(): array
{
    return [
        ['Karol', 20],
        ['Ana', 25],
        ['Luis', 30]
    ];
}
```

Uso en la prueba:

```php
#[DataProvider('proveedorUsuarios')]
public function testEdad($nombre, $edad)
{
    $this->assertGreaterThan(18, $edad);
}
```

---

## 4.-¿Qué dificultades tuviste al implementar las pruebas parametrizadas?

Una de las principales dificultades fue asegurar que la cantidad y el orden de los datos proporcionados por el `dataProvider` coincidieran exactamente con los parámetros definidos en el método de prueba. Cuando existe una diferencia entre ambos, PHPUnit genera errores durante la ejecución.

**Ejemplo de error:**

```php
public static function proveedorDatos(): array
{
    return [
        [1, 2],
        [3, 4]
    ];
}

#[DataProvider('proveedorDatos')]
public function testSuma($a, $b, $resultado)
{
    $this->assertEquals($resultado, $a + $b);
}
```

En este caso, el proveedor devuelve únicamente dos valores, mientras que la prueba espera tres parámetros, provocando un error.

**Solución:**

```php
public static function proveedorDatos(): array
{
    return [
        [1, 2, 3],
        [3, 4, 7]
    ];
}
```

De esta forma, cada conjunto de datos contiene la cantidad correcta de parámetros requeridos por la prueba.
