# khipu-demo-js

Este es un ejemplo de como usar la biblioteca javascript de khipu para permitir pagar directamente en tu sitio.

La biblioteca javascript de khipu permite levantar el terminal de pagos y pagar sin necesidad de salir del comercio. En
el caso de que la persona que paga no tenga instalada la aplicación de khipu, se redirige a una página de instalación.
Cuando el terminal esté instalado se vuelve de manera automática al comercio para terminar el pago.

Puedes encontrar la documentación completa en [el repositorio GitHub de la Biblioteca javascript khipu](https://github.com/khipu/lib-javascript).

## Requerimientos

Necesitas un servidor visible en internet con:

- PHP 5.0 o superior
- Soporte de JSON para PHP

## API REST de khipu

Esta demo usa la API REST de khipu para crear pagos y recibir noticiaciones. Para poder entender bien como funciona toda la demo
es recomendable que leas la [documentación de la API](https://khipu.com/page/api).

## Instalación

Debes dejar todos los archivos en una carpeta de tu servidor web, por ejemplo en *http://miservidor.com/demojs*. Esta
carpeta debe estar visible desde internet para poder usar la característica de *notificación instantanea*.

## Configuración

Esta demo viene pre-configurada con una cuenta de cobro en modo desarrollador. Debes configurarla con tu propia cuenta
de cobro para poder acceder a los cobros en el portal de khipu. Para esto debes abrir el archivo *constants.php* y cambiar
los siguientes parámetros:

- RECEIVER_ID: Es tu ID de cobrador para tu cuenta khipu.
- SECRET: Tu llave secreta en khipu.
- BASE_PATH: El directorio web donde se aloja la demo (por ejemplo: http://miservidor.com/demojs).
- RETURN_URL: Es la URL a la que se debe redirigir el browser cuando el pago haya sido completado.
- NOTIFY_URL: Es la URL donde está el archivo *demo-notify-js.php*.

Para saber como obtener tu ID de cobrador y tu SECRET debes leer la [documentación de la API](https://khipu.com/page/api#llave-del-cobrador).

**Importante**: Debes configurar tu *id de cobrador* en el archivo *demo-notify-js.php*. Esto se debe a que si el archivo
 en cuestión podría estar en una carpeta distinta a donde se encuentra *constants.php*.

## Documentación

- Biblioteca Javascript: [https://github.com/khipu/lib-javascript](https://khipu.com/page/biblioteca-javascript)
- ID y SECRET: [https://khipu.com/page/api#llave-del-cobrador](https://khipu.com/page/api#llave-del-cobrador).
- Obtener el listado de bancos: [https://khipu.com/page/api#receiver-banks](https://khipu.com/page/api#receiver-banks).
- Crear una URL de pago: [https://khipu.com/page/api#crear-url](https://khipu.com/page/api#crear-url).

