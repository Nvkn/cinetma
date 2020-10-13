# Análisis: Requisitos del sistema

Este documento describe los requisitos para Cinetma, especificando que funcionalidades ofrecerá y de que manera.

## 1. Descripción general

Teniendo en cuenta los datos obtenidos del estudio preliminar, el proyecto pretende crear una aplicación web en la que se vayan almacenando numerosas películas de cine independiente, siendo posible ampliar su catálogo continuamente. Para ello, debe almacenar los datos de las películas, las cuales estarán a disposición de todos los usuarios para consultar sus datos e interactuar con ellas.

Puede tratarse de películas tanto finalizadas como en producción, de modo que se puedan dar a conocer de manera anticipada nuevas películas que aún no han sido publicadas. En este caso, los usuarios pueden contribuír a la producción de la misma mediante donaciones si lo desean.

Todas estas funciones son realizadas a través de un portal web. Como complemento al mismo, existirá un Bot para Discord que proporcionará diversas funcionalidades, aportando información a los usuarios, y utilizando como referencia al portal web por si desean ampliar la información proporcionada.

## 2. Funcionalidades

Funcionalidades del portal web:

- Gestión de usuarios en la BD
	+ Crear usuario (email, nick, contraseña)
	+ Modificar usuario (id, nombre, apellidos, nick, notificaciones)
	+ Eliminar usuario (id)
- Gestión de películas en la BD.
	+ Listar todas las películas ()
	+ Listar películas filtradas (tipoPelicula, categoría)
	+ Crear película (titulo, finalizada, descripcion, sinopsis, portada, donacion, trailer, categoria, imagenes, reparto, staff, duracion, fecha de lanzamiento)
	+ Editar película (id, titulo, finalizada, descripcion, sinopsis, portada, donacion, trailer, categoria, imagenes, reparto, staff, duracion, fecha de lanzamiento)
	+ Eliminar película (id)
	+ Eliminar imagen (id pelicula, id imagen)
- Gestión de categorías en la BD
	+ Crear categoría (nombre categoria)
	+ Eliminar categoria (id)
- Gestión de personas (reparto o staff) en la BD
	+ Crear persona (nombre)
	+ Eliminar persona (id)
	+ Obtener persona (id)
- Gestión de valoraciones en la BD
	+ Crear valoración (nota, id pelicula)
	+ Obtener valoración (id usuario, id pelicula)
	+ Eliminar valoración (id usuario, id pelicula)
- Operaciones de un usuario con sus películas
	+ Listar películas de un usuario ()
- Visualización de películas
	+ Listar películas para la pagina de inicio ()
	+ Obtener película (id)
	+ Obtener vista para editar pelicula (id)
- Búsquedas
	+ Obtener resultados búsqueda (texto)

Funcionalidades del Bot de Discord:

- Peticiones del Bot de Discord
	+ Obtener película por su título (titulo)
	+ Obtener últimas películas ()
	+ Obtener películas mejor valoradas ()
	+ Obtener una película aleatoria ()

## 3. Requisitos funcionales

- Infraestructura
	+ 1 Dominio web de primer nivel.
	+ 1 servidor web dedicado.
	+ 100GB SSD para bases de datos
	+ 150GB SSD para almacenamiento de archivos
	+ 16GB RAM
	+ Tráfico ilimitado
- Backend
	+ Debian Server
	+ PHP 7.3.14
	+ NodeJS
	+ MariaDB 10.3.22
	+ Git
	+ Certificado SSL Let's Encrypt
	+ Web Application Firewall (WAF)
	+ Frameworks PHP: Laravel
	+ Javascript: Discord.js 12.2.0
	+ Comunicación asíncrona: Axios v0.19.2
- Frontend
	+ HTML5
	+ CSS3: Bootstrap
	+ JavaScript: jQuery, Vue.js
	+ Comunicación asíncrona: AJAX

## 4. Requisitos no funcionales
- Eficiencia
	+ El sistema debe ser capaz de procesar 30 transacciones por segundo
	+ Toda funcionalidad y transacción de la aplicación debe responder en menos de 5 segundos.
- Seguridad
	+ Los permisos de los usuarios deben ser cambiados únicamente por el administrador de la base de datos.
	+ El sistema debe desarrollarse aplicando recomendaciones de uso de Laravel para maximizar su seguridad.
	+ Todos los formularios del portal web deben validarse y estar protegidos contra CSRF.
	+ Todas las funciones que gestionen las bases de datos deben ser realizadas por usuarios registrados.
	+ Los usuarios deben ver limitadas sus funcionalidades según los privilegios que tengan sus respectivos roles.
	+ Los formularios deben estar protegidos contra inyección de datos SQL.
- Disponibilidad
	+ El sistema debe tener una disponibilidad del 99,99% de las veces que un usuario intente accederlo.

## 5. Tipos de usuarios

Estos son los distintos tipos de usuarios de la aplicación web:

- **Usuario anónimo**, que podrá ver todas las películas, editar su perfil y realizar búsquedas.
- **Usuario registrado**, que podrá valorar películas.
- **Colaborador**, cuyos privilegios son poder subir nuevas películas, así como editar y eliminar películas de su propiedad.
- **Moderador**, que tendrá la posibilidad de subir nuevas películas, y tanto editar como eliminar cualquier película, sea o no de su propiedad.
- **Administrador de la base de datos**, que designará si un usuario registrado puede ser colaborador o moderador.

## 6. Entorno operacional

### 6.1. Dominio

Para el desarrollo de la aplicación, se utilizará un dominio gratuíto proporcionado por [no-ip](https://www.noip.com/).
El dominio empleado es [https://cinetma.myftp.org/](https://cinetma.myftp.org/).

En una hipotética versión de producción, se utilizaría un dominio registrado de pago.

### 6.2. Hardware
Para el desarrollo del proyecto se utilizarán los distintos elementos:
- Ordenador, para desarrollar la aplicación y el bot.
- Smartphone, para probar la aplicación desde su versión móvil.
- Servidor web, para hostear la aplicación web y el bot.
- Servidor de bases de datos, para almacenar las bases de datos necesarias.
- CDN, para la utilización de los siguientes elementos:
	+ FontAwesome
	+ Google Fonts
	+ jQuery
	+ Ajax
	+ Axios
	+ Bootstrap 4
	+ Vue.js
	+ SweetAlert2


### 6.3. Software

Para el desarrollo del proyecto, se necesitarán instalar los siguientes softwares:
- Nginx
- Putty
- Sublime Text 2
- Navegador web (Chrome y Mozilla Firefox)
- Plugin para navegador web: Vue DevTools
- Advanced Rest Client

Para poder utilizar el bot, debe ser instalado el siguiente software:
- Discord

Para emplear la aplicación web, se necesita únicamente el navegador web (previamente mencionado).

## 7. Interfaces externos

Para comunicarse tanto con la aplicación web como con el bot, los usuarios emplearán una interfaz de usuario.

En el caso de la aplicación web, esto sucederá mediante las distintas vistas y los datos aportados en ellas; mientras que en el caso del bot, esto sucederá mediante los comandos escritos en los chats en los que este se encuentre (tanto en servidores como por mensajes directos).

A mayores, el bot se comunica con la aplicación web mediante Software, en este caso mediante métodos definidos en una API.

## 8. Mejoras futuras

Este proyecto puede contemplar un gran número de mejoras futuras. Las mejoras mas destacables serían:

- Implementar una "lista" en la que cada usuario registrado pudiese almacenar películas que le interesaría ver o que haya visto, para mantener un registro.
- Poder valorar de modo independiente los distintos aspectos de las películas en lugar de aportar una nota global (por ejemplo, valorar por separado el guión, la producción audiovisual, el sonido...).
- Implementar una barra de búsqueda dinámica que ofrezca posibles resultados a medida que se va escribiendo el texto.
- Añadir un sistema de críticas en el que cada usuario, además de aportar una nota como valoración, pueda también escribir una reseña sobre la película dando su opinión personal.
- Añadir pasarelas de pago que permitan realizar las donaciones directamente a las películas en producción, en lugar de incluír un enlace a la donación.
- Incluír botones para compartir en twitter tanto películas como valoraciones.
- Implementar un sistema que analice los datos y permita recomendar películas a los usuarios según sus gustos, basado en otros usuarios con un perfil similar.