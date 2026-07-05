# DESCARGA Y CONFIGURACION DE xdebug
## HECHO POR MAYUMI
### PASO 1:
Primero nos ubicamos en la carpeta de la semana 12 
```cd semana12```
### PASO 2:
Ahora voy a ejecutar este comando para saber en que carpeta esta instalado mi phph
``` where php ```
### PASO 3:
Despues ejecutaremos 
```php --- ini``
Ese comando nos dice donde esta el archivo de php ini, que sera el archivo donde se configura Xdebug.
### PASO 4:
Descargaremos Xdebug
Entramos
``https://xdebug.org/wizard``
Y en nuestra terminal ejecutamos
```php -i```
Sale un resultado ese resultado lo copeamos y pegamos en la página de Xdebug Wizard, esto hara que la página te dirá exactamente qué archivo php_xdebug.dll descargar para tu versión de PHP.
### PASO 5:
Una vez descarga el archivo voy a copear a la siguiente carpeta
``C:\Users\USER\.config\herd\bin\php84\ext``
si no existe la carpeta *ext* lo creamos y dentro de ella lo copeamos.
### PASO 6:
Ahora pasaremos a Editar el *php.ini*
Dentro de *php.ini* bucamos *zend_extension=opcache* y debajo de esa linea agregamos las siguientes lineas
*zend_extension=xdebug
xdebug.mode=coverage
xdebug.start_with_request=yes* 
### PASO 7:
Configuraremos en *phpunit.xml* la parte donde sera hara la seccion de cobertura
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

    <source>
        <include>
            <directory>src</directory>
        </include>
    </source>

</phpunit>
```
Le indica a PHPUnit que la carpeta src contiene el código que debe analizar para calcular la cobertura.
### PASO 8:
Cierro la terminal y vuelvo abrir una nueva y ejecutamos ```php -v```
### PASO 9:
Generaremos la cobertura en la carpeta de la semana12
```vendor\bin\phpunit --coverage-html coverage```
¡Y LISTO!¡GRACIAS!

