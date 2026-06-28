# Informe de Pruebas Unitarias - Hotel Paraíso

**Fecha:** 27/06/2026  
**Responsable:** [Karol Mayumi Damas] 
**Proyecto:** Sistema de Reservas de Hotel  

---

## Resumen Ejecutivo

Se completaron las pruebas unitarias del Sistema de Reservas de Hotel, corrigiendo 10 errores identificados en el código original. Todas las pruebas pasaron exitosamente.

**Resultados:**
- ✅ 12 pruebas ejecutadas
- ✅ 22 aserciones pasaron
- ✅ 0 fallos
- ✅ 0 errores

---

## Detalle de Pruebas

### Cliente (Tests\Cliente)
| Prueba | Estado | Descripción |
|--------|--------|-------------|
| ✅ Nombre vacio | PASS | Valida que el nombre no esté vacío |
| ✅ Email invalido | PASS | Valida formato de email |

### Habitacion (Tests\Habitacion)
| Prueba | Estado | Descripción |
|--------|--------|-------------|
| ✅ Numero cero | PASS | Valida número de habitación positivo |
| ✅ Numero negativo | PASS | Valida número de habitación positivo |
| ✅ Precio cero | PASS | Valida precio positivo |
| ✅ Precio negativo | PASS | Valida precio positivo |
| ✅ Reservar habitacion disponible | PASS | Verifica disponibilidad antes de reservar |
| ✅ Reservar habitacion no disponible | PASS | Lanza excepción al reservar ocupada |

### Reserva (Tests\Reserva)
| Prueba | Estado | Descripción |
|--------|--------|-------------|
| ✅ Fecha ingreso invalida | PASS | Valida formato YYYY-MM-DD |
| ✅ Fecha ingreso pasado | PASS | Rechaza fechas anteriores a hoy |
| ✅ Fecha salida anterior | PASS | Valida que salida sea posterior a ingreso |
| ✅ Calcular total | PASS | Calcula correctamente días de estadía |

---

## Correcciones Implementadas

| ID | Clase | Error | Solución |
|----|-------|-------|----------|
| CP-01 | Cliente | Nombre vacío | Validación con `empty(trim())` |
| CP-02 | Cliente | Email inválido | Uso de `filter_var()` |
| CP-03 | Habitacion | Número ≤ 0 | Validación `$numero > 0` |
| CP-04 | Habitacion | Precio ≤ 0 | Validación `$precio > 0` |
| CP-05 | Habitacion | No verifica disponibilidad | Validación antes de reservar |
| CP-06 | Habitacion | No lanza excepción | Lanza Exception si no disponible |
| CP-07 | Reserva | Formato fecha inválido | Uso de `DateTime::createFromFormat()` |
| CP-08 | Reserva | Fecha en pasado | Comparación con `new DateTime('today')` |
| CP-09 | Reserva | Salida anterior a ingreso | Validación `$salida > $ingreso` |
| CP-10 | Reserva | Cálculo incorrecto de días | Uso de `diff()->days` |

---

## Evidencia de Ejecución

```bash
PS D:\Vsemestre\PRUEBAS UNITARIAS\semana12> vendor/bin/phpunit tests --testdox

PHPUnit 13.2.1 by Sebastian Bergmann and contributors.
Runtime:       PHP 8.4.22
Configuration: D:\Vsemestre\PRUEBAS UNITARIAS\semana12\phpunit.xml

Time: 00:00.024, Memory: 18.00 MB

Cliente (Tests\Cliente)
 ✔ Nombre vacío
 ✔ Email invalido

Habitacion (Tests\Habitacion)
 ✔ Numero cero
 ✔ Numero negativo
 ✔ Precio cero
 ✔ Precio negativo
 ✔ Reservar habitacion disponible
 ✔ Reservar habitacion no disponible

Reserva (Tests\Reserva)
 ✔ Fecha ingreso invalida
 ✔ Fecha ingreso pasado
 ✔ Fecha salida anterior
 ✔ Calcular total

OK (12 tests, 22 assertions)