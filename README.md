Bienvenido al tp de web2 de juan y mati
ENDPOINTS
agregar: localhost/WEB2-TP2-BIDI/api/equipos  (PARAMETROS)  (equipos o ligas)(PUT)
actualizar: localhost/WEB2-TP2-BIDI/api/equipos/num  (num=id del que va a modificar)(PARAMETROS) (equipos o ligas)(POST)
borrar: localhost/WEB2-TP2-BIDI/api/equipos/num (ligas o equipos)(num=id del cual se quiere eliminar) (DELETE)
compaginar: localhost/WEB2-TP2-BIDI/api/equipos/paginar/1 (el numero final es la pagina que quiere ir) (GET)
ordenar por,Asc o Desc: localhost/WEB2-TP2-BIDI/api/equipos/ordenar/nombre/asc (GET)

(parametros a tener en cuenta : id_equipo, id_fk_liga, nombre, logo, historia, jugadores)

EJ DE PARAMETROS PARA AGREGAR EQUIPOS:
{ "id_fk_liga": 1,
    "nombre": "Club Atlético Barrio Parque(Córdoba) MATIASSSSSSSSS",
    "logo": "imagen/barrioParqueArg.pngMATIAAAASS",
    "historia": "LA MEJORASDAAAAAAAAAAA",
    "jugadores":"MATIASSSSS"
    }




-Primeros pasos de router (matias)
public function controllerparam(&param=null)->si este param no se trae te lo cambia a null y lo permito igual
-POSTMAN create a request=agregar esta linea en el postman + el metodo https://localhost/WEB2-TP2-BIDI/

6/11 matias
hay un error en el controller que nose que es lo que lo produce, nose como solucionarlo. Por ahora mi unico objetivo era realizar una consulta y que me devuelva todo de ligas

7/11 Juan
Acomode el error en controller, agregue cositas JSONView, view, y routers, que hacen que ande en la consulta y lo devuelva y muestra :D
---Juan muestro Ligas completa (GET)
---Muestro ligas por ID (GET)
---Agrego liga (POST)
---Borro liga (DELETE)
---Modifico league (PUT)

7/11 matias
agregue funciones en team, por ahora solo hay una, mañana continuo. Creo que tambien tengo que arreglar el delete de ligas para que elimine todos los equipos tambien

8/11 matias
agregue mas funciones a team , limpie algo de codigo y agregue llaves
Intente proseguir con el addTeam, imposible nose como tomar la fk para checkearla, ELIMINAR LIGA tiene un error tambien, deje comentarios en las lineas q para mi no tienen mucho sentido o no entienod porque estan ahi, MODIFICAR LIGA tambien tiene un error, no checkea que todos los parametros esten llenos igual que pasa con AGREGAR LIGA

10/11  matias
modifique el if de errores, param solo es utilizable si se manda por get no por post

15/11 matias
limpie codigo, agregue funciones de team, hice el compaginado de la pagina pero me quedo incoompleto, me falta separarlo en dos

15/11 matias
Agregue funciones, agregue paginado, mejore sintaxis para ordenar parametros de una manera mas limpia, separe funciones