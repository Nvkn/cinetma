# Codificación y Pruebas

## Codificación


La codificación es la parte mas larga del proyecto. Para poder comenzar con ella, previamente obtuve formación sobre Laravel para poder desarrollar correctamente el proyecto, mediante la lectura de la documentación y completé un curso online sobre Laravel.

En primer lugar, diseñé un calendario para distribuír el tiempo a las distintas partes del proyecto. También distribuí las distintas tareas que debía realizar mediante Trello, una aplicación web que emplea el sistema kanban.

Para poder comenzar, procedí a crear un nuevo servidor en Google Cloud utilizando Debian Buster, en el que instalé y configuré Nginx para que funcionase correctamente. También registré y configuré el dominio gratuíto. Para finalizar, instalé Laravel.

A la hora de desarrollar tanto la aplicación como el Bot, lo hacía a través de mi ordenador utilizando Sublime Text 2, conectándome al servidor por SFTP, por lo que cada vez que actualizaba los datos en mi ordenador estos se actualizaban directamente en el servidor. Además, durante todo el proyecto utilicé Git como sistema de control de versiones, mediante el repositorio de [GitLab del IES San Clemente](https://gitlab.iessanclemente.net/dawo/a18nicolasbq/-/tree/master). Para conectarme al servidor, lo hacía por SSH mediante [PuTTY](https://www.putty.org/), generando claves SSH para el Servidor con [PuttyGen](https://www.puttygen.com/).

Utilicé una plantilla de Bootstrap como esquema para continuar con la maquetación, dado que decidí maquetar la aplicación web personalmente para que se ajustase lo mejor posible a las necesidades, atendiendo a que fuese compatible con distintas resoluciones.

Gracias a la documentación de Laravel conseguí ir sacando adelante todo lo que necesitaba. Aún así, tuve retrasos en el calendario en todas las fases que había determinado para la codificación, en gran parte debidas a que empleaba demasiado tiempo en maquetar manualmente, ya que una primera versión de la web no me convencía y decidí cambiar los colores y algunos otros aspectos de la misma.

No se me presentaron grandes complicaciones, dado que con la ayuda de la documentación y la resolución de dudas similares en páginas como Stack Overflow pude solucionar los problemas que iban surgiendo. Quizás el apartado en el que me vi obligado a gastar una mayor cantidad de tiempo y que podría haber sido optimizado fue a la hora de utilizar Vue.js, ya que tenía una menor formación sobre el mismo que me hizo tardar algo más.

Una vez terminada la aplicación web, procedí a intentar crear un bot para Twitter. Había buscado bastante información al respecto en tutoriales, guías y documentación sobre la API, pero me surgió un gran problema: Al contrario que en los documentos que había visto, no pude obtener instantáneamente una API KEY, por lo que decidí crear un bot de Discord en su lugar para agilizar la producción, ya que no podía permitirme esperar debido a los plazos de entrega. En esta situación, decidí formarme sobre la creación de bots en Discord.


Debido a que el tamaño inicial del servidor era bastante reducido, me vi obligado a incrementar varias veces su memoria RAM, así como también tuve que ampliar su espacio de almacenamiento. Esto no resultó un problema, pero en ciertas situaciones ralentizó un poco el proceso de producción (debido a la creación de instantáneas de seguridad antes de las mejoras para asegurarme de no perder el trabajo realizado).

Esperaba poder incluír varias de las mejoras futuras del proyecto, pero no pude debido a los plazos de tiempo.




## Pruebas

Las pruebas realizadas para asegurar el funcionamiento de la página web fueron las siguientes:
- Realización de pruebas manuales cada vez que se publique una nueva versión estable de la aplicación o una nueva funcionalidad.
	+ Para ello, cada vez que incluía una nueva funcionalidad o actualizaba algún apartado, realizaba numerosas pruebas manuales, tanto con los datos adecuados para comprobar que los resultados eran satisfactorios como con objetivos malintencionados para comprobar la seguridad de la misma.

- Realización de pruebas manuales de funcionamiento y usabilidad por un grupo reducido de personas ajenas a la aplicación.
	+ Durante el proceso de producción y al final del mismo, varias personas ajenas al proceso de producción (incluídas entre ellas tanto personas con conocimientos sobre informática como personas con dificultades para desenvolverse en el mundo digital) probaron tanto la aplicación web para determinar si los resultados eran correctos, tanto a nivel en funcionalidad como en satisfacción del usuario a la hora de ser utilizados. Gracias a ello, fueron modificados algunos apartados estéticos de la aplicación web.