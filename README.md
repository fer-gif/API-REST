#API Proyecto Futbol5

###EQUIPOS:
>* Nota: El Body En  Postman se deberia de escribir de la siguiente manera:
Usar unicamente cuando se requiera MODIFICAR (PUT) o AGREGAR(POST) un equipo.
{ 
"Nombre":......(String),
"Ciudad":.......(String),
"Socios":......(Number) 
}

####*¿Como escribir las urls?*

- ##### api/equipos:
A traves del verbo **GET** traemos todos los equipos que se encuentran en la base de datos.

- #####api/equipos/:PARAMETRO (ID o NOMBRE):
Con el verbo **GET** y escribiendo en "**PARAMETRO**" el ID o el nombre del equipo, captamos los datos de ese equipo en particular.

api/equipos/:ID :
En este caso utilizando el verbo DELETE y pasandole nuevamente el ID del equipo, borramos ese equipo de la base de datos.

- #####api/equipos/:NOMBRE/jugadores:
Utilizando nuevamente el verbo **GET** y ademas colocando en "**NOMBRE**" EL nombre del equipo, accedemos a los jugadores que tiene ese equipo.

- #####api/equipos/:NOMBRE/partidos:
Escribiendo el nombre del equipo que se requiere en "**NOMBRE**" nos traera los partidos que jugaron ese equipo, utilizando el verbo **GET**.

- #####api/equipos/posiciones:
A traves del verbo **GET**, traemos las posiciones del torneo del primero al ultimo.

- #####api/equipos:
Ya aca utilizando el verbo **POST**, a traves del body escribir los campos requeridos, sin utilizar parametros en la URL debe agregar un nuevo equipo a la base de datos.

- ##### api/equipos/:ID :
Con el verbo **PUT** y pasandole el **ID** del equipo, capturamos el equipo que queremos editar y a traves del body, insertamos en los datos a modificar del equipo.

- ##### api/equipos/:ID :
En este caso utilizando el verbo **DELETE** y pasandole nuevamente el **ID** del equipo, borramos ese equipo de la base de datos.


###JUGADORES:
> NOTA: el body en el Postman para jugadores se escribe de la siguiente manera.Usar unicamente cuando se requiera MODIFICAR (PUT) o AGREGAR(POST) un jugador:
{
"nombre":....(string),
"apellido":.....(string),
"dni" :.....(number), 
"posicion":.....(string("POR","DEF","MED","DEL")),
"telefono":......(number), 
"edad" :....(number), 
"id_equipo":.....(number) 
}
####*¿Como escribir las urls?*

- #####api/jugadores:
A traves del verbo **GET** traemos todos los jugadores que se encuentran en la base de datos.

- #####api/jugadores/:ID :
Con el verbo **GET** traemos un jugador segun su ID.

- #####api/jugadores
A traves del verbo **POST** y colocando en el body los campos requeridos, se registra un jugador a la base de datos.  Al momento de escribir en el body, en "posicion", los unicos valores que se permiten son : "POR";"DEF";"MED";"DEL".

- #####api/jugadores/:ID :
A traves del verbo **PUT** y pasando por parametro su **ID**, debemos escribir en el body los datos que tenemos que queremos modificar del jugador en particular.

- #####api/jugadores/:ID :
Utilizando el verbo **DELETE** y enviando por parametro el **ID**, elimina un jugador con ese id.


###PARTIDOS: 
> NOTA: el body en el Postman para partidos se escribe de la siguiente manera. Usar unicamente cuando se requiera MODIFICAR (PUT) o AGREGAR(POST) un partido:

{
"id_equipo1":....(number),
"id_equipo2":.....(number),
"goles_equipo1" :.....(number), 
"goles_equipo2":.....(number),
"fecha":......(number), 
}
####*¿Como escribir las urls?*

- #####api/partidos:
A traves del verbo **GET** traemos todos los partidos que se encuentran en la base de datos.

- #####api/partidos/:ID :
Con el verbo **GET** traemos un partido en particular segun su ID.

- #####api/partidos
A traves del verbo **POST** y colocando en el body los campos requeridos, se registra un partido a la base de datos. 

- #####api/partidos/:ID :
A traves del verbo **PUT** y pasando por parametro su **ID**, debemos escribir en el body los datos que tenemos que queremos modificar del partido en particular.

- #####api/partidos/:ID :
Utilizando el verbo **DELETE** y enviando por parametro el **ID**, elimina un partido con ese id.
