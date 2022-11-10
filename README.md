Bienvenido al tp de web2 de juan y mati
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