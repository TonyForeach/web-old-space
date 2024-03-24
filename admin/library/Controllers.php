<?php
require_once 'Views.php';
require_once 'Paginador.php';
require_once 'Session.php';
require_once 'Session.php';
require_once 'AnonymousClasses.php';
class Controllers extends AnonymousClasses{
    var $view;
    var $paginador;
    var $model;

    public function __construct() {
        date_default_timezone_set('America/Lima');
        Session::star();
        $this->view =new Views();
        $this->paginador = new Paginador();
        $this->loadClassmodels();
    }
    public function loadClassmodels() {
        $array = explode("Controller", get_class($this)); 
        $model = $array[0].'_model';
        $path = 'model/'.$model.'.php';
        if (file_exists($path)) {
            require $path;
            $this->model = new $model();
        }
    }
}
?>