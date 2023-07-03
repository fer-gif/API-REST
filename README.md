# API-REST
Documentacion API REST


EQUIPOS:
NOTA: el body en el Postman se deberia de escribir de la siguiente manera

{
"nombre":......(string),
"ciudad":.......(string),
"socios":......(number)
} 


api/equipos------ a traves del verbo GET traemos todos los equipos que se encuentran en la base de datos.

api/equipos/:"PARAMETRO"(ID o NOMBRE)-------- con el verbo GET y en "PARAMETRO", colocar el ID o el nombre de un equipo, nos mostrara los datos de ese equipo en particular.

api/equipos/:"NOMBRE"/jugadores-----------------utilizando nuevamente el verbo GET y ademas colocando en "NOMBRE" el nombre del equipo, accedemos a los jugadores que tiene ese equipo. 

api/equipos/:"NOMBRE"/partidos----------------- escribiendo el nombre del equipo que se requiere en "NOMBRE" nos traera los partidos que jugaron ese equipo, utilizando el verbo GET. 

api/equipos------ ya aca utilizando el verbo POST, a traves del body escribir los campos requeridos, sin utilizar parametros en la URL debe agregar un nuevo equipo a la base de datos.

api/equipos/:ID-------con el verbo PUT y pasandole el ID del equipo, capturamos el equipo que queremos editar y a traves del body, insertamos en "nombre", el nuevo nombre del equipo.

api/equipos/:ID-------- en este caso utilizando el verbo DELETE y pasandole nuevamente el ID del equipo, borramos ese equipo de la base de datos.




JUGADORES:
NOTA: el body en el Postman para jugadores se escribe de la siguiente manera
{
    "nombre":....(string),
    "apellido":.....(string),
    "dni" :.....(number),
    "posicion":.....(string("POR","DEF","MED","DEL")),
    "telefono":......(number),
    "edad" :....(number),
    "id_equipo":.....(number)
}

api/jugadores------ a traves del verbo GET traemos todos los jugadores que se encuentran en la base de datos.

api/jugadores/:ID------ con el verbo GET traemos un jugador segun su ID.

api/jugadores---------- a traves del verbo POST y colocando en el body los campos requeridos, se registra un jugador a la base de datos.

api/jugadores/:ID----------a traves del verbo PUT y pasando por parametro su ID, debemos escribir  en el body los datos que tenemos que 
queremos modificar del jugador en particular.

api/jugadores/:ID-----utilizando el verbo DELETE y enviando por parametro el ID, elimina un jugador con ese id.


PARTIDOS:

