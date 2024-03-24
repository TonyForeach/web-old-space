<?php
require_once 'library/Controllers.php';
class IndexController extends Controllers{

    public function __CONSTRUCT(){
        parent::__construct();
    }
       
    public function Index(){
        if (null != Session::getSession('nombre')) {
            header('Location: '.URL.'Main');
        }
        else{ 
            $model1 = Session::getSession("model1");
            $model2 = Session::getSession("model2");
            if (null != $model1 || null != $model2) {
                $array1 = unserialize( $model1);
                $array2 = unserialize( $model2);
                if(is_array($array1) && is_array($array2)){
                    $model1 = $this->TLogin($array1);
                    $model2 = $this->TLogin($array2);
    
                    $this->view->Render($this, "index",$model1,$model2,null);
                }else{
                    $this->view->Render($this, "index",null,null,null);
                }
            }else {
                $this->view->Render($this, "index",null,null,null);
            }
        }
    }
    public function Login(){
        $execute = true;
        if (empty($_POST["user"])){
            $user = "Ingrese el usuario";
            $execute = false;
        }
        if (empty($_POST["password"])){
            $password = "Ingrese el password";
            $execute = false;
        }
        $model1 = array(
            "user"=>$_POST["user"] ?? null,
            "password"=>$_POST["password"] ?? null,
        );
        Session::setSession('model1',serialize($model1));

        if ($execute) {
            $value = $this->model->Login($this->TLogin($model1));
            if (is_numeric($value)) {
                Session::setSession('model1',"");
                Session::setSession('model2',"");
                header('Location: '.URL.'Main');
            } else {
                Session::setSession('model2', serialize(array(
                    "user"=>$value,
                )));
                header('Location: '.URL);
            }
            
        } else {
            Session::setSession('model2', serialize(array(
                "user"=>$user ?? null,
                "password"=>$password ?? null,
            )));
            header('Location: '.URL);
        }
        
    }

    public function Logout(){
        Session::setSession('model1',"");
        Session::setSession('model2',"");
        Session::setSession('nombre',"");
        header('Location: '.URL);
    }
}