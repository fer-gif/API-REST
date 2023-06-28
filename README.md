# API-REST
Documentacion API REST

<font color="red">This text is red!</font>

EQUIPOS:

api/equipos------ a traves del verbo GET traemos todos los equipos que se encuentran en la base de datos.

api/equipos/:"PARAMETRO"(ID o NOMBRE)-------- con el verbo GET y en "PARAMETRO", colocar el ID o el nombre de un equipo, nos mostrara los datos de ese equipo en particular.

api/equipos/:"NOMBRE"/jugadores-----------------utilizando nuevamente el verbo GET y ademas colocando en "NOMBRE" el nombre del equipo, accedemos a los jugadores que tiene ese equipo. 

api/equipos------ ya aca utilizando el verbo POST, a traves del body escribir 
'{"nombre":"NombreEquipo"}' y sin utilizar parametros en la URL debe agregar un nuevo equipo a la base de datos.

api/equipos/:ID-------con el verbo PUT y pasandole el ID del equipo, capturamos el equipo que queremos editar y a traves del body, insertamos en "nombre", el nuevo nombre del equipo.

api/equipos/:ID-------- en este caso utilizando el verbo DELETE y pasandole nuevamente el ID del equipo, borramos ese equipo de la base de datos.


JUGADORES:

api/jugadores------ a traves del verbo GET traemos todos los jugadores que se encuentran en la base de datos.
