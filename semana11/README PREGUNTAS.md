# PREGUNTAS SEMANA 11
## ¿Qué diferencia hay entre expectException y expectExceptionMessage?
ExpectException: Define el tipo de error o la clase de la excepción que esperas que ocurra (por ejemplo: InvalidArgumentException::class o Exception::class). Solo le importa qué tipo de error es, no lo que dice.

ExpectExceptionMessage: Define el texto exacto o mensaje que lleva esa excepción dentro (por ejemplo: "No se puede dividir por cero").

## ¿Por qué es importante colocar expectException ANTES de ejecutar el código?
En PHP, cuando ocurre una excepción (throw new ...), el flujo normal del programa se interrumpe inmediatamente.

Si colocas el código que falla antes del expectException, PHP arrojará el error, detendrá el test por completo y PHPUnit nunca llegará a leer la línea donde le decías que lo estabas esperando. Al ponerlo antes, le avisas a PHPUnit: "Ojo, voy a ejecutar una línea que va a fallar; quédate listo para capturar ese error y ver si es el correcto".

## ¿Qué pasa si una función debe lanzar una excepción pero no lo hace?
El test fallará automáticamente.

Cuando usas expectException, le estás dando una condición obligatoria a PHPUnit. Si la función termina su ejecución normalmente (retornando un valor o un true) sin que se dispare ningún error, PHPUnit marcará el test como Failure avisándote que el error esperado nunca ocurrió. Esto sirve para detectar si olvidaste poner las validaciones de seguridad en tu código real.

## ¿En qué situaciones de un proyecto real usarías expectException?
Se utiliza en cualquier escenario donde necesites proteger tu aplicación de flujos incorrectos, datos corruptos o acciones prohibidas:

Validación de formularios y registros: Cuando un usuario intenta registrarse con un email inválido, una contraseña insegura o siendo menor de edad (como en tu laboratorio).

Operaciones financieras o matemáticas: Evitar transferencias con montos negativos, saldos insuficientes o divisiones por cero.

Control de acceso y seguridad: Cuando un usuario intenta entrar a una ruta administrativa sin haber iniciado sesión o sin tener los permisos (roles) necesarios.

Conexiones a servicios externos: Validar cómo reacciona tu sistema si una base de datos está caída o si una API externa (como una pasarela de pagos) no responde.
