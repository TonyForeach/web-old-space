<?php
require_once 'library/Controllers.php';
class ErrorController extends Controllers{
    public function __construct() {
        parent::__construct();
    }
    public function Error($url){
        $this->view->Render($this,"error",$url,null,null);
    }
}
?>