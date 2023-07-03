# API Proyecto Futbol5

**Table of Contents**

[TOCM]

### EQUIPOS:
>* Nota: El Body En  Postman se deberia de escribir de la siguiente manera:
Usar unicamente cuando se requiera MODIFICAR (PUT) o AGREGAR(POST) un equipo.<br>
            { <br>
                "Nombre":......(String),<br>
                "Ciudad":.......(String),<br>
                "Socios":......(Number) <br>
            }


#### *¿Como escribir las urls?*

- ##### api/equipos:
A traves del verbo **GET** traemos todos los equipos que se encuentran en la base de datos.

- ##### api/equipos/:PARAMETRO (ID o NOMBRE):
Con el verbo **GET** y escribiendo en "**PARAMETRO**" el ID o el nombre del equipo, captamos los datos de ese equipo en particular.

api/equipos/:ID :
En este caso utilizando el verbo DELETE y pasandole nuevamente el ID del equipo, borramos ese equipo de la base de datos.

- ##### api/equipos/:NOMBRE/jugadores:
Utilizando nuevamente el verbo **GET** y ademas colocando en "**NOMBRE**" EL nombre del equipo, accedemos a los jugadores que tiene ese equipo.

- ##### api/equipos/:NOMBRE/partidos:
Escribiendo el nombre del equipo que se requiere en "**NOMBRE**" nos traera los partidos que jugaron ese equipo, utilizando el verbo **GET**.

- ##### api/equipos:
Ya aca utilizando el verbo **POST**, a traves del body escribir los campos requeridos, sin utilizar parametros en la URL debe agregar un nuevo equipo a la base de datos.

- ##### api/equipos/:ID :
Con el verbo **PUT** y pasandole el **ID** del equipo, capturamos el equipo que queremos editar y a traves del body, insertamos en los datos a modificar del equipo.

- ##### api/equipos/:ID :
En este caso utilizando el verbo **DELETE** y pasandole nuevamente el **ID** del equipo, borramos ese equipo de la base de datos.


### JUGADORES:
> NOTA: el body en el Postman para jugadores se escribe de la siguiente manera.Usar unicamente cuando se requiera MODIFICAR (PUT) o AGREGAR(POST) un jugador.<br>
{<br>
"nombre":....(string),<br>
"apellido":.....(string),<br>
"dni" :.....(number), <br>
"posicion":.....(string("POR","DEF","MED","DEL")),<br>
"telefono":......(number), <br>
"edad" :....(number), <br>
"id_equipo":.....(number) <br>
}

#### *¿Como escribir las urls?*

- ##### api/jugadores:
A traves del verbo **GET** traemos todos los jugadores que se encuentran en la base de datos.

- ##### api/jugadores/:ID :
Con el verbo **GET** traemos un jugador segun su ID.

- ##### api/jugadores
A traves del verbo **POST** y colocando en el body los campos requeridos, se registra un jugador a la base de datos.  Al momento de escribir en el body, en "posicion", los unicos valores que se permiten son : "POR";"DEF";"MED";"DEL".

- ##### api/jugadores/:ID :
A traves del verbo **PUT** y pasando por parametro su **ID**, debemos escribir en el body los datos que tenemos que queremos modificar del jugador en particular.

- ##### api/jugadores/:ID :
Utilizando el verbo **DELETE** y enviando por parametro el **ID**, elimina un jugador con ese id.


### PARTIDOS: 
> NOTA: el body en el Postman para partidos se escribe de la siguiente manera. Usar unicamente cuando se requiera MODIFICAR (PUT) o AGREGAR(POST) un partido.<br>
{<br>
"id_equipo1":....(number),<br>
"id_equipo2":.....(number),<br>
"goles_equipo1" :.....(number), <br>
"goles_equipo2":.....(number),<br>
"fecha":......(number)<br>
}

#### *¿Como escribir las urls?*

- ##### api/partidos:
A traves del verbo **GET** traemos todos los partidos que se encuentran en la base de datos.

- ##### api/partidos/:ID :
Con el verbo **GET** traemos un partido en particular segun su ID.

- ##### api/partidos
A traves del verbo **POST** y colocando en el body los campos requeridos, se registra un partido a la base de datos. 

- ##### api/partidos/:ID :
A traves del verbo **PUT** y pasando por parametro su **ID**, debemos escribir en el body los datos que tenemos que queremos modificar del partido en particular.

- ##### api/partidos/:ID :
Utilizando el verbo **DELETE** y enviando por parametro el **ID**, elimina un partido con ese id.


### QUERY PARAMS:


### TOKEN:
Para poder acceder a las acciones de modificacion, agregar o eliminar cualquier registro de las tablas, el usuario debe tener un acceso al token que sera generado a traves de la api.
Para generar dicho token, el usuario debe loguearse con su usuario y contraseña correspondiente. Y luego de comprobar de que los datos sean correctos la api retornara el token de acceso que deberia ser usado en cada peticion con el metodo POST, PUT O DELETE. Para login de usuario el endpoint disponible "api/login" con metodo POST en el body del login aparecera
{
    "usuario":"Admin",
    "password":"admin1234"
}

Con dicho token generado, en el header de la peticion se debe incluir el atributo 