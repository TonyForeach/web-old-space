<?php
require_once 'library/Connection.php';
class Index_model extends Connection{
    public function __construct() {
        parent::__construct();
    }

    public function Login($model)
    {
        $where = " WHERE user=:user";
        $param = array('user' => $model->user);
        $response = $this->db->Select1("*",'login',$where,$param);
        if (is_array($response)) {
            $response = $response['results'];
            if (0 < count($response)) {
                if (password_verify($model->password,$response[0]["password"])) {
                    if ($response[0]["password"]) {
                        $data = array(
                            "id" => $response[0]["id"],
                            "nombre" => $response[0]["nombre"],
                            "user" => $response[0]["user"],
                        );
                        Session::setSession("nombre",$data);
                        return 1; 
                    } 
                }else {
                    return "Contraseña incorrecta";
                }
                
            }else{
                return "El usuario no esta registrado";
            }
        } else {
            return $response;
        }
        
    }
}