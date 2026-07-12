### **RESPUESTAS A LAS PREGUNTAS DE LA GUÍA de la semana 14**
## 1. ¿Qué diferencia hay entre `setUp()` y `setUpBeforeClass()`?

- `setUp()` se ejecuta **antes de cada prueba** (`@Test`). Se utiliza para preparar los datos o crear los objetos que necesita cada prueba.

- `setUpBeforeClass()` se ejecuta **una sola vez antes de que comiencen todas las pruebas** de la clase. Se usa para inicializar recursos que serán compartidos por todas las pruebas, como una conexión a una base de datos o la carga de archivos grandes.

## 2. ¿Por qué es importante usar `tearDown()` en pruebas con base de datos?

`tearDown()` se ejecuta **después de cada prueba** y sirve para limpiar los recursos utilizados.

Es importante porque:

- Elimina los datos de prueba insertados.
- Cierra conexiones con la base de datos.
- Evita que una prueba afecte a las siguientes.
- Mantiene la base de datos en un estado limpio.

## 3. ¿Qué pasaría si no usáramos `tearDown()` y ejecutáramos muchas pruebas?

Si no se usa `tearDown()`:

- Los datos de prueba se acumularían en la base de datos.
- Algunas pruebas podrían fallar porque encuentran información de pruebas anteriores.
- Las conexiones podrían quedar abiertas, consumiendo memoria y recursos.
- Los resultados de las pruebas dejarían de ser confiables.

## 4. ¿En qué casos usarías `setUpBeforeClass()`?

Usaría `setUpBeforeClass()` cuando necesite realizar una configuración que solo deba hacerse una vez, por ejemplo:

- Abrir una conexión a una base de datos.
- Cargar un archivo de configuración.
- Inicializar recursos compartidos por todas las pruebas.
- Preparar un servidor o un entorno de pruebas.

De esta forma se mejora el rendimiento, ya que no es necesario repetir la misma inicialización antes de cada prueba.