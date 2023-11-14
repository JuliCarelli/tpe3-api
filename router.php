<?php
require_once './app/controllers/peliculas.controller.php';
require_once './app/controllers/directores.controller.php';

require_once './libs/Router.php';

$router = new Router();

$router->addRoute("peliculas", "GET", "PeliculasController", "get");
$router->addRoute("peliculas/:id", "GET", "PeliculasController", "get");

$router->addRoute("peliculas", "POST", "PeliculasController", "post");

$router->addRoute("peliculas/:id", "PUT", "PeliculasController", "putById");
$router->addRoute("peliculas/:id", "DELETE", "PeliculasController", "deleteById");


$router->addRoute("directores", "GET", "DirectoresController", "get");
$router->addRoute("directores/:id", "GET", "DirectoresController", "get");

$router->addRoute("directores", "POST", "DirectoresController", "post");

$router->addRoute("directores/:id", "PUT", "DirectoresController", "putById");
$router->addRoute("directores/:id", "DELETE", "DirectoresController", "deleteById");


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
?>