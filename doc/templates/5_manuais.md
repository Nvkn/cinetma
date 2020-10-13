## Manual técnico del proyecto

### Instalación

Requerimientos:
- Servidor web
- Servidor de bases de datos
- SO: Debian 10 Buster
- Privilegios de administrador
- MariaDB
- [Laravel](https://laravel.com/docs/7.x/installation)
- [Composer](https://getcomposer.org/)
- [npm](https://www.npmjs.com/)
- [Node.js](https://nodejs.org/es/download/package-manager/)

#### Aplicación web - Cinetma
Una vez esté configurado el servidor web (En mi caso, utilicé [Nginx](https://www.nginx.com/)) y configurado el servidor de bases de datos, el proyecto puede ser clonado directamente desde los repositorios.

Después de instalar Laravel, deben ser configurados algunos permisos. Los directorios de `storage` y `bootstrap/cache` deben tener permiso de escritura por el servidor web. Para instalar las dependencias con composer, debe utilizarse el siguiente comando desde el directorio raíz del proyecto de laravel:
```
composer install
```
De este modo, serán instaladas todas las dependencias incluídas en el archivo `composer.json`.


Es necesario también crear un archivo `.env`, que está incluído en el proyecto pero se omite en el repositorio por cuestiones de seguridad, dado que almacena datos importantes. Se puede crear un archivo de ejemplo utiliazdo el siguiente comando desde la consola en el directiorio raíz del proyecto de laravel:
```
cp .env.example .env
```


También es necesario generar una clave única en el archivo .env, lo cual se puede hacer mediante el siguiente comando:
```
php artisan key:generate
```


Debe ser creada una base de datos para poder ejecutar las migraciones. Después de hacer esto, debes añadir los credenciales al archivo `.env`, incluyendo su host, BD, nombre de usuario y contraseña. Esta base de datos será utilizada para almacenar todos los datos y migraciones de la aplicación web, así como las tareas asíncronas (Jobs) de Laravel.

Una vez se hayan realizado los pasos previos, las migraciones ya pueden ser ejecutadas:

```
php artisan migrate
```

El proyecto cuenta con seeders. Estos son opcionales, y su función es añadir datos como ejemplo a las bases de datos. Si deseas realizarlo a la vez que las migraciones, puedes utilizar este comando:

```
php artisan migrate --seed
```


En caso de que ya hayas hecho las migraciones previamente, podrás añadir los seeders sin realizar una nueva migración así:
```
php artisan db:seed
```

También debe ser creada una tabla para almacenar los Jobs y sus incidencias, de la siguiente manera:
```
php artisan queue:table

php artisan queue:failed-table

php artisan migrate
```

Para que las colas estén en funcionamiento, debe utilizarse ```php artisan queue:work```. De ese modo, el proceso debe ser pausado manualmente.

Si quieres que las notificaciones y los Jobs funcionen correctamente, ejecutándose contínuamente en segundo plano, debes instalar además [supervisor](http://supervisord.org/running.html) mediante ```sudo apt-get install supervisor ```.
Una vez instalado, debes crear un nuevo proceso en la carpeta ```/etc/supervisor/conf.d```, como por ejemplo ```laravel-worker.conf```. El archivo debe tener el siguiente contenido, aunque puede ser modificado si se desea:
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/cinetma.myftp.org/cinetma/artisan queue:work --sleep=3 --tries=5
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/cinetma.myftp.org/cinetma/storage/logs/supervisor_queue-work.log
;stopwaitsecs=3600
```

Una vez creado el proceso, para ser iniciado deben ejecutarse los siguientes comandos:
```
sudo supervisorctl reread

sudo supervisorctl update

sudo supervisorctl start laravel-worker:*
```


Con esto estaría finalizada la puesta en marcha de la aplicación web.

#### Bot de Discord de Cinetma

Para la instalación del Bot de Discord, se debe tener abierto el puerto 8443 en el servidor, dado que es el puerto en el que funciona este Bot.

En primer lugar
Debe ser creado un archivo `.env` en el directorio raíz del bot, aunque este es disinto al de laravel. Debe seguir el siguiente esquema:
```
# .env
# Bot de Discord: Nombre del bot

# Configuración del Servidor
PUERTO_WEB_HTTPS = 8443

# Configuración del Bot
PREFIX = "Mi prefijo"
ID = Mi id
TOKEN = Mi token

# Configuración del Webhook
WEBHOOK_ID = Mi webhook_id
WEBHOOK_TOKEN = Mi webhook token
```
Para añadir los datos necesarios, debes seguir los siguientes pasos:

Debes crear una nueva aplicación en [discord.com/developers](https://discord.com/developers/applications). Posteriormente, debes copiar el Client ID (/General Information) y el Token (/Bot) en el archivo `config.json` y en el archivo `.env`.

Para generar el enlace que permita invitar a tu bot, debes ir a `/OAuth2` y seleccionar el scope "Bot". Al abrirse los permisos de Bot, debes seleccionar los permisos necesarios en este caso: "Send Messages", "Embed Links" y "Attach Files". Se generará automáticamente un enlace que permite invitar a tu bot a cualquier servidor.

Una vez creada la aplicación desde Discord, necesitamos instalar las dependencias. Para ello, solamente tenemos que ejecutar el comando
```
npm install
```

Cuando es publicada una nueva película, el bot emite un mensaje en el chat "Novedades" de su servidor. Al crear tu propio bot, probablemente prefieras modificar este apartado. Para ello, debes crear un nuevo Webhook en tu servidor, y añadir sus datos al archivo `.env`.

De este modo, ya tendríamos completamente preparado al Bot de Discord para que funcionase correctamente.


#### Puesta en funcionamiento

Para poner en funcionamiento el proyecto deben haberse realizado correctamente los pasos previos. En ese caso, la aplicación web ya estaría funcionando automáticamente. Para poder iniciar el Bot, únicamente debe ser ejecutado el comando ``node index.js`` en el directorio raíz del Bot. De este modo, el proceso se pararía manualmente. También podría ser ejecutado mediante otras funcionalidades, como por ejemplo [forever](https://www.npmjs.com/package/forever), que hace que esté en contínuo funcionamiento.


### Administración del sistema

Una vez el sistema esté funcionando, puedes desear que ciertos usuarios puedan acceder a los roles de colaborador o moderador, y así puedan subir, modificar y eliminar publicaciones en la aplicación web. En ese caso, únicamente sería necesario entrar en la base de datos desde PHPMyAdmin, y modificar en el usuario (Tabla 'users') las respectivas columnas. Dado que su valor es un Boolean, en caso de querer activarlo el valor debería pasar de ser un 0 a un 1, y viceversa.

### Mantenimiento del sistema

El sistema requiere de pocas acciones para asegurar su mantenimiento. Únicamente se deben realizar copias de seguridad, e instalar regularmente las actualizaciones disponibles (Tanto del Sistema Operativo del Servidor como de los módulos requeridos para el funcionamiento del proyecto).

## Gestión de incidencias

En caso de existir incidencias en los Jobs, estos serían registrados en la tabla 'failed_jobs' de la base de datos.

## Política de privacidad

Protección de datos de carácter persoal:

- [Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales (LOPDPGDD)](https://www.boe.es/buscar/act.php?id=BOE-A-2018-16673)
- [General Data Protection Regulation (GDPR)](https://eur-lex.europa.eu/eli/reg/2016/679/oj)

## Manual de usuario

No sería necesario formar a los usuarios dado que el objetivo es que sea lo mas intuitivo posible.