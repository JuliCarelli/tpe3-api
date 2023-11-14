Integrantes: Luis Oses - luisosespro123@gmail.com - 43909208 / Julieta Carelli - julicarelli1@gmail.com - 40009561

Temática: Películas.

Breve descripción de la temática: Realizamos un modelo de datos de películas en el que hay dos tablas: una donde está la información de la película, es decir su título, el género, el año y el/la director/a; y otra con la información del/de la director/a. El usuario podrá acceder a esta lista y ver todas las películas del mismo (DER).

 --- Peliculas ---

Para listar todas las peliculas:
GET -> peliculas

Se puede filtrar por director. 
Se buscará todas las peliculas que su director sea el recibido por $_GET:
GET -> peliculas?director=(id)

Para ordenar las peliculas por cualquiera de los campos (id, titulo, genero, year, director):
GET -> peliculas?order_by=(campo)

Para ordenar las peliculas de manera ascendente o descendente (ascendente es el default y siempre tiene prioridad):
GET -> peliculas?asc
GET -> peliculas?ASC

GET -> peliculas?desc
GET -> peliculas?DESC

Para buscar una pelicula por su ID:
GET -> peliculas/:id


Para agregar una pelicula:
POST -> peliculas
Ejemplo de body:
    {
	"titulo" : "Tenet",
	"genero" : "Drama, Accion",
	"year" : "2020-10-1",
	"director" : 6
    }
Todos los campos son obligatorios.

Para modificar una pelicula:
PUT -> peliculas
Ejemplo de body:
    {
	"titulo" : "Tenet",
	"genero" : "Fantasia",
	"year" : "2020-10-1",
	"director" : 8
    }

 --- Directores ---
 
Para listar todos los directores:
GET -> directores

Para ordenar los directores por cualquiera de los campos (id, nombre):
GET -> directores?order_by=(campo)

Para ordenar los directores de manera ascendente o descendente (ascendente es el default y siempre tiene prioridad):

GET -> directores?asc
GET -> directores?ASC

GET -> directores?desc
GET -> directores?DESC

Para buscar un director por su ID:
GET -> directores/:id

Para agregar un director:
POST -> directores

Ejemplo de body:
    {
		"nombre": "Christopher Nolan"
	}
Todos los campos son obligatorios.

Para modificar un director:
PUT -> directores/:id

Ejemplo de body:
    {
		"nombre": "Christopher Nolan"
	}