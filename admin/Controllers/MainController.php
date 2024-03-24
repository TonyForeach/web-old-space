<?php
require_once 'library/Controllers.php';
class MainController extends Controllers{
    public function __construct(){
        parent::__construct();
    }

    public function Index(){
        if (null != Session::getSession("nombre")) {
            // Obtener el total de registros
            $total = $this->model->CountUsers(null);

            // Obtener los registros con DNI
            $dni = $this->model->CountUsers('DNI');

            // Obtener los registros con Carnet de Extranjería
            $carnet = $this->model->CountUsers('Carnet de Extranjeria');

            // Pasar los datos a la vista
            $data = array(
                'total' => $total,
                'dni' => $dni,
                'carnet' => $carnet
            );

            // Renderizar la vista con los datos obtenidos
            $this->view->Render($this,"main", $data, null, null);
        } else {
            header("Location: ".URL);
        }
    }
}
