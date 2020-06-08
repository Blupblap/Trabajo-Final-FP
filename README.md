## Trabajo Final FP
### Introducción
Esto es el proyecto final del grado superior de Desarrollo de Aplicaciones Web. Para el proyecto hemos decidido crear un juego basado en la gestión de recursos, ya que visto en retrospectiva nos ha parecido una buena forma de poner a prueba todo lo aprendido durante el curso, ya que se haría uso de bases de datos, de edición de estilos y diseño, de programación con javascript, uso de APIs y otros conocimientos diversos.

La creación del proyecto no fue algo sencillo ya que nos encontramos con diversos problemas, el primero de todos intentar entender el framework en el que estamos basando nuestro proyecto, ya que aunque lo hayamos estudiado en clase aún había muchas cosas que se escapaban de nuestros conocimientos, por lo que aprovechamos unos cuantos días para entenderlo todo bien. 

Pero una vez fueron superados esos problemas tuvimos que aprender a trabajar en equipo y en organizarnos los trabajos por partes e issues mediante el gestor de versiones Git.

### Distribución de tareas

La distribución de tareas la dividimos en dos partes desde un principio, donde uno de los miembros del grupo estaría más enfocado en el Back, y otro en el Front.

Para llevar estas tareas por separado dividimos cada problema en pequeños subproblemas, los cuales estos se verían reflejados en ramas, una vez se resolviera el problema, se haría un pull request donde se revisará que todo está correcto y que no hay conflictos.

El encargado del Back fue Pedro, donde se encargó de todo lo relacionado con la configuración y uso de Laravel además de encargarse de las APIs, los controladores, las migraciones, y el servidor externo. 

Por otro lado en el Front trabajó Guillermo, donde además de buscar y editar las imágenes para el juego, se encargó del apartado del CSS y Javascript, además del diseño de la web.

### Estructura general

Para la creación del proyecto decidimos usar Laravel para su esqueleto y cuerpo, lo cual nos hizo enfrentarnos a diversos problemas nacidos del desconocimiento de este framework, los cuales fuimos solucionando con la práctica y con diversas pruebas. 

El proyecto también hace uso de una base de datos donde se guardan toda la información de los usuarios además de datos fijos sobre los distintos edificios y ciudades. Estos datos se introducen en la base de datos mediante seeders desde el propio proyecto Laravel. El tipo de base de datos que usamos es **mySQL**.

Para las diversas peticiones **Ajax** hemos usado una **API REST**, a la cual se puede acceder sin problemas desde el proyecto.

Y todo esto está ubicado en un servidor remoto de Amazon Web Service, el cual permite que se acceda al proyecto desde cualquier sitio. 

### Tecnologías usadas

Hemos usado diversas tecnologías y lenguajes para la elaboración del juego. 

Como base tenemos **HTML5**, ya que al tratarse de un proyecto web nos ha servido para basar el resto de tecnologías, como de costumbre. 

Para la parte del diseño hemos usado **CSS**, más concretamente **SCSS**, el cual nos aporta una mayor libertad y control a la hora de diseñar nuestro proyecto, además hemos hecho uso del framework de diseño **Bootstrap**, el cual además de ser sencillo de utilizar aporta varias herramientas útiles que hacen más cómoda la maquetación del juego.

La interacción usuario-cliente la hemos desarrollado mediante **Javascript**, con la ayuda de **JQuery**, la cual simplificó el código en gran medida. 

La lógica de servidor la hemos lleva a cabo usando **PHP**, usando el framework **Laravel**, que nos facilita la estructuración del proyecto y nos proporciona herramientas para la creación de modelos, controladores, vistas y demás.
 
Para las vistas hemos usado **Blade**, el motor de plantillas que proporciona Laravel. Eso nos permite usar código PHP entre las etiquetas HTML.

### Guía del usuario

En este apartado explicaremos todo lo necesario para poder usar nuestro juego y poder probarlo uno mismo.

El juego al estar en un servidor remoto se puede acceder desde cualquier lugar, siendo solo necesario escribir la dirección: 
<http://35.181.28.135/> en cualquier navegador web moderno.

En la barra de navegación hay diversas opciones, donde se podrá ver el ranking de los mejores jugadores además de una página de información para saber más del juego, la cual recomendamos leer. 

Una vez se ha registrado el usuario al proyecto este verá la vista de su ciudad, donde ya podrá empezar a jugar haciendo click en las diversas piedras distribuidas por el mapa para empezar a construir su pueblo.

### Derechos de autor

Absolutamente todas las imágenes usadas en el juego son de medios externos ya que carecemos de los conocimientos para crear estas mismas. Todas las imágenes pertenecen a sus respectivos dueños y el uso de estas han sido para fines meramente académicos y no se pretende sacar un beneficio monetario de las mismas. 

### Webgrafia

- [Documentación de Laravel](https://laravel.com/docs/6.x)
- [Stack Overflow](https://stackoverflow.com/)
- [W3Schools](https://www.w3schools.com/)
- [Bootstrap](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
- [MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web)
- [JQuery API Documentation](https://api.jquery.com/)
