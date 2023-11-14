<?php

require_once './app/models/peliculas.model.php';
require_once "./app/models/directores.model.php";
require_once './app/views/view.php';

class DirectoresController{
    private $peliculas_model;
    private $model;
    private $view;

    public function __construct() {
        // verifico logueado
        // AuthHelper::verify();
        $this->peliculas_model = new PeliculasModel();
        $this->model = new DirectoresModel();
        $this->view = new View();
    }

    private function getData()
    {
        $input = file_get_contents("php://input");
        $data = json_decode($input);
        return $data;
    }

    public function get($params = [])
    {
        if(empty($params)) {
            // getAll
            // quieren todos los registros
            
            $order_by = isset($_GET["order_by"]) && $_GET["order_by"] != "" ? $_GET["order_by"] : "id";
            $order = isset($_GET["desc"]) || isset($_GET["DESC"]) ? "DESC" : "ASC";
            $order = isset($_GET["asc"]) || isset($_GET["ASC"]) ? "ASC" : $order;

            $data = $this->model->getAll($order_by, $order);

            if ($data === false) {
                $this->view->response("Hubo un error interno al buscar lo solicitado.", 500);
                return;
            }

            $this->view->response($data, 200);
            return;
        }
        // getByID

        if ( !isset($params[":id"]) || $params[":id"] == "") {
            // error , falta el id [necesario]
            $this->view->response("No se recibieron los datos necesarios.", 400);
            return;
        }

        // quieren un registro especifico con id
        $data = $this->model->getById($params[":id"]);

        if (!$data) {
            $this->view->response("No se pudo encontrar lo solicitado.", 404);
            return;
        }

        $this->view->response($data, 200);
    }

    public function post()
    {
        $data = $this->getData();

        if( !isset($data->nombre)){
            // error, me faltan datos.
            $this->view->response("No se recibieron los datos necesarios.", 400);
            return;
        }

        $exito = $this->model->insert($data);

        if(!$exito){
            $this->view->response("Hubo un error interno al insertar.", 500);
            return;
        }

        $this->view->response("Se ha insertado correctamente.", 201);
    }
    public function putById($params = []){

        if (empty($params) || $params[":id"] == "") {
            // error , falta el id [necesario]
            $this->view->response("Falta el id necesario.", 400);
            return;
        }

        $data = $this->getData();

        if( !isset($data->nombre) ){
            // error, me faltan datos.
            $this->view->response("No se recibieron los datos necesarios.", 400);
            return;
        }

        $exito = $this->model->updateById($params[":id"],$data);

        if(!$exito){
            $this->view->response("Hubo un error interno al modificar.", 500);
            return;
        }

        $this->view->response("Se ha modificado correctamente.", 200);
    
    }

    public function deleteById($params = []){

        if (empty($params) || $params[":id"] == "") {
            // error , falta el id [necesario]
            $this->view->response("Falta el id necesario.", 400);
            return;
        }

        // $this->peliculas_model->deleteAllByDirectorId($params[":id"]);
        
        $exito = $this->model->deleteById($params[":id"]);

        if(!$exito){
            $this->view->response("Hubo un error interno al eliminar.", 500);
            return;
        }

        $this->view->response("Se ha eliminado correctamente.", 200);
    }
}
?>


