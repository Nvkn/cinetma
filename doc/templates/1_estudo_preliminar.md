# Estudio preliminar

## 1. Introducción


Este proyecto documenta las distintas fases del proceso de desarrollo de una aplicación web destinada al sector del cine independiente, enfocada desde una perspectiva técnica, económica, legal y organizativa.

El software que se presenta consiste en un portal web para la difusión del cine independiente y la comunidad que lo rodea.

## 2. Objetivo


El objetivo de Cinetma es crear una web de alcance estatal que consiga agrupar todas las producciones de cine independiente de este país en una misma web, y funcionar como herramienta de disfusión del cine independiente, de modo que abarate los costes y facilite la promoción del mismo. Gracias a esto, también pretende facilitar el trabajo de los consumidores de ese tipo de cine a la hora de descubrir nuevas películas o buscar información sobre ellas.


## 3. Definiciones


| *Palabra* | Definición |
|--|--|
| *Cinetma* | Es el propio proyecto |
| *Cine independiente* | Hace referencia a todas aquellas películas que se realizan al margen de los circuitos comerciales y de producción habituales. |
| *Aplicación web* | Página web que se está desarrollando en el proyecto |
| *Usuario* | Persona que utiliza la aplicación web o el bot |
| *Administrador* | Administrador de la base de datos |


## 4. Audiencia


En rasgos generales, la audiencia objetiva de este proyecto no se encuentra limitada. Sin embargo, sí que existe una gran diferencia en los tipos de audiencia que pueden existir, dado que les influye de una forma diferente, por lo que se desglosa en los siguientes tipos:

- Por una parte, para las personas que participan de algún modo en la producción de contenido para el sector del cine independiente resulta especialmente interesante, dado que es un gran modo de publicitar el trabajo que han realizado a su público objetivo. Esto engloba tanto al reparto como a los miembros del equipo técnico.

- Por otra parte se encuentran la comunidad que rodea este tipo de cine. Pueden tratarse consumidores habituales o espontáneos.

- Además, aunque de forma menos frecuente, también puede resultar de interés para un público ajeno a ese sector, pero que deseen emplear la aplicación web por diversos motivos, como puede ser descubrir nuevas opciones en las que emplear su tiempo de ocio. En este caso, probablemente tendría más éxito en las personas que previamente fuesen aficionadas al cine.


## 5. Necesidades


El cine independiente, además de tener un público menos amplio que el cine comercial, tiene mucha menos repercusión debido a que no pertenece a grandes compañías. Esto hace que sea mucho más complicado tanto publicitarlo como acceder al mismo. La mayor parte de los medios de comunicación, al hacer eco de novedades sobre la cultura cinematográfica, tanto independiente como comercial, hacen que este quede habitualmente en un segundo plano, por lo que (a excepción de algunos casos aislados) la difusión de sus producciones suele ser mucho menor.

En los medios online, la mayor parte de la difusión de nuevas películas se produce a través de blogs de críticos o galas de premios, pero escasean los portales dedicados exclusivamente al cine independiente. A nivel nacional, en España no existe ningún portal exclusivo para este tipo de cine. De hecho, en varias entrevistas realizadas por la prensa a personas del sector audiovisual (desde directores a distribuidores online), los entrevistados manifiestan que en España faltan plataformas que fomenten este contenido.

Cuando el consumidor desea buscar películas nuevas, las películas mejor valoradas, etc., se encuentra con que únicamente puede acudir a blogs o rankings eventuales publicados de manera espontánea. En otros países como Estados Unidos, existen alternativas como páginas de organizaciones sin ánimo de lucro que crean galas de premios, pero desde un enfoque distinto y, normalmente, para acceder a su contenido se necesita una subscripción de pago.

Además, existe un problema en las páginas web que se dedican a mostrar películas más populares (IMDB, Rotten Tomatoes, Metacritic, FilmAffinity, etc.) suele existir una sobrecarga de información muy grande desde una primera impresión. Además de la cantidad de contenido, también resulta sobrecargado estéticamente, ya que con las portadas de las películas se mezclan una infinidad de colores, algo que (por lo investigado personalmente, según una encuesta) impacta negativamente en la experiencia de los usuarios.

Dado este contexto, se pueden detectar las siguientes deficiencias:

- Escasez de difusión para las producciones de cine independiente.
- Falta de medios de difusión exclusivos con información sobre el cine independiente.
- Escasez o inexistencia de medios en los que sus consumidores puedan interactuar con este tipo de cine.
- Gran incomodidad para el público para descubrir novedades sin acudir a portales web con entradas puntuales en lugar del conjunto de películas.
- Experiencia negativa de los usuarios de portales web sobre cine en cuanto a sobrecarga visual y de información.

Estas deficiencias producen una serie de necesidades, las cuales son:

- Simplificación o reducción de la información de las páginas web relacionadas con el mundo del cine.
- Creación de un sistema que permita almacenar el conjunto de las películas de cine independiente
- Creación de un sistema que permita la difusión del cine independiente de un modo exclusivo y regular.


## 6. Modelo de negocio
Sería posible formar un modelo de negocio a partir de este proyecto. Dado que no existe mucha competencia, en caso de tener éxito, se podrían obtener ingresos gracias a anuncios. Además, existiría la posibilidad de poder pagar para publicitar las películas, poniéndolas en la sección de películas destacadas, de modo que obtendrían mayor visibilidad.

En una versión futura, en caso de implementar las opciones para poder visualizar películas en streaming directamente desde la aplicación web, se podrían incluír pagos para poder realizarlo, o pagos de cuotas mensuales que otorguen acceso al catálogo de películas.

### 6.1. Viabilidad

#### 6.1.1. Viabilidad técnica

La disponibilidad de los recursos humanos y de producción sería muy accesible, dado que no requerirían unos elementos adicionales a los empleados en los métodos de producción. Como recursos humanos, yo sería el programador que lo gestionaría, y los medios de producción empleados serían un hosting y un dominio.

#### 6.1.2. Viabilidad económica

Si fuese comercializado el proyecto, este obtuviese promoción mediante campañas de marketing y fuese optimizado su SEO, se podrían conseguir unos ingresos superiores a los gastos utilizados para su producción. Estos ingresos podrían ser incrementados en gran medida mediante futuras mejoras, añadiendo nuevas funcionalidades extra de pago, que conformarían una nueva fuente de ingresos.


### 6.2. Competencia

A nivel nacional, no existen páginas que se dediquen exclusivamente a este sector. La competencia se centra en pequeños apartados de páginas enfocadas al cine (en todos sus ámbitos). Centrándonos en esto, a nivel nacional no existe competencia directa, dado que páginas como [Sensacine](http://www.sensacine.com/indie/) o [GoodFilms](http://www.goodfilms.es/) no aportan las mismas funcionalidades.

A nivel internacional, podemos encontrar páginas como [Film Independent](https://www.filmindependent.org/) o [Independ](http://www.independ.net/), las cuales tienen una popularidad bastante grande a pesar de dedicarse exclusivamente a cine independiente. En cuanto a páginas que tocan este sector pero no exclusivamente, existen grandes rivales también como [IMDB](https://www.imdb.com/list/ls006660717/) o [Rotten Tomatoes](https://www.rottentomatoes.com/), las cuales tienen un éxito increíble y están muy bien valoradas por el público.

Por ello, existe una competencia mucho menor a nivel nacional que a nivel internacional.


### 6.3. Promoción

Las formas de promoción mas apropiadas serían:
- La promoción por diversas redes sociales, mediante cuentas oficiales que divulgasen el contenido de la página web.
- Posicionamiento web, dado que es indispensable para obtener unos buenos resultados.
- Anuncios. Estos anuncios aparecerían en redes sociales como Facebook o Twitter, promocionando tanto la web como las cuentas oficiales, así como en Google Ads.


### 6.4. Modelo de negocio

El modelo de negodio sería gratis. Los ingresos se obtendrían mediante los anuncios que aparecerían en la web y los anunciantes que deseen promocionar sus nuevas películas en las secciones destacadas.

En el futuro, al incluír las nuevas funcionalidades, pasaría a ser Freemium: Continuaría teniendo las funcionalidades actuales gratuítas, pero añadiría algunas extra que serían de pago.