# LIGAS Y EQUIPOS DE BASQUET
**La idea de este trabajo practico era crear una pagina que respondiera a las necesidades de una página de basquet donde los fans pudiesen ver e informarse sobre los equipos que existen en cada liga. Incluyendo ligas como la nba para mas atraccion del publico y otras ligas alrededor del mundo y asi fomentar mas el conocimiento**
*importar base de datos: dentro de nuestra carpeta de xampps en htdocs usar git (git bash here) y extraer los archivos del github con un clone o lo que crea conveniente*
## ENDPOINTS
*Agregar:* https://localhost/WEB2-TP2-BIDI/api/equipos  (PARAMETROS)  (equipos)**PUT**
{ "id_fk_liga": 1,
    "nombre": "Club Atlético TABIERES",
    "logo": "imagen/TABIERES.PNG",
    "historia": "LTWERTERTWERTWRTWERTEWRT",
    "jugadores":"QWERWERWQERQWERQWERQWERWE, MARTIN"
    }
https://localhost/WEB2-TP2-BIDI/api/ligas  (PARAMETROS)  (ligas)**PUT**
 {
    "logo": "imagen/PUT.PNG",
    "liga": "liga PUT",
    "record": "Campeonatos por entrenadores INSERT",
    "historia": "La Liga Nacional de Básquet es la liga de baloncesto INSERT"
}

*Actualizar:* https://localhost/WEB2-TP2-BIDI/api/equipos/2 **POST** *2=id del equipo*
{ "id_fk_liga": 1,
    "nombre": "Club Atletico SAN JUAN",
    "logo": "imagen/atleticoSanJuan.png",
    "historia": "Ejemplo de historia",
    "jugadores":"Matias Rignoli, JuaN Ravioli"
    }
https://localhost/WEB2-TP2-BIDI/api/ligas/2 **POST** *2=id de la liga*
{
    "logo": "imagen/PUT.PNG",
    "liga": "liga PUT",
    "record": "Campeonatos por entrenadores INSERT",
    "historia": "La Liga Nacional de Básquet es la liga de baloncesto INSERT"
}

*Borrar:* https://localhost/WEB2-TP2-BIDI/api/equipos/num (ligas o equipos)(num=id del cual se quiere eliminar) **DELETE**

*Compaginar:* https://localhost/WEB2-TP2-BIDI/api/equipos/pagina/1 *(el numero final es la pagina que quiere ir)* **GET**

*Ordenar por,Asc o Desc:* https://localhost/WEB2-TP2-BIDI/api/equipos/ordenar/parametros/asc **GET**

*parametros : id_equipo, id_fk_liga, nombre, logo, historia, jugadores*

### traer todos los elementos
https://localhost/WEB2-TP2-BIDI/api/equipos 
*json* [   {
        "id_equipo": 21,
        "id_fk_liga": 1,
        "nombre": "Club Atlético Barrio Parque(Córdoba) MATIASSSSSSSSS",
        "logo": "imagen/barrioParqueArg.pngMATIAAAASS",
        "historia": "LA MEJORASDAAAAAAAAAAA",
        "jugadores": "MATIASSSSS"
    }
]
https://localhost/WEB2-TP2-BIDI/api/ligas
*json* [     {
        "idLiga": 47,
        "logo": "imagen.png",
        "liga": "liga argentina",
        "record": "Campeonatos por entrenadores",
        "historia": "22"
    },
]
### traer elementos por id
https://localhost/WEB2-TP2-BIDI/api/equipos/1 **1=num de id**
*json* [   {
        "id_equipo": 21,
        "id_fk_liga": 1,
        "nombre": "Club Atlético Barrio Parque(Córdoba) MATIASSSSSSSSS",
        "logo": "imagen/barrioParqueArg.pngMATIAAAASS",
        "historia": "LA MEJORASDAAAAAAAAAAA",
        "jugadores": "MATIASSSSS"
    }
]
https://localhost/WEB2-TP2-BIDI/api/ligas/1 **1=num de id**
*json* [     {
        "idLiga": 47,
        "logo": "imagen.png",
        "liga": "liga argentina",
        "record": "Campeonatos por entrenadores",
        "historia": "22"
    },
]
