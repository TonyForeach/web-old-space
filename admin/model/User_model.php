<?php
require_once 'library/Connection.php';
class User_model extends Connection
{
    public function __construct(){
        parent::__construct();
    }

    public function GetUsers($paginador, $filter, $page, $register, $method, $url, $fechaInicio, $fechaFin)
    {
        if ($paginador != null) {
            $where = " WHERE (full_name LIKE :full_name OR document_number LIKE :document_number)";
            $array = array(
                'full_name' => '%' . $filter . '%',
                'document_number' => '%' . $filter . '%'
            );
    
            if ($fechaInicio !== null && $fechaFin !== null) {
                // Convertir fechas de inicio y fin al formato de fecha y hora de la base de datos
                $fechaInicio = date('Y-m-d', strtotime(str_replace('/', '-', $fechaInicio)));
                $fechaFin = date('Y-m-d', strtotime(str_replace('/', '-', $fechaFin)));
                
                $where .= " AND created_at BETWEEN :fechaInicio AND :fechaFin";
                $array['fechaInicio'] = $fechaInicio;
                $array['fechaFin'] = $fechaFin;
            }
    
            return $paginador->paginador("id, full_name, document_type, document_number, created_at", "users", $method, $register, $page, $where, $array, $url);
        } else {
            $where = " WHERE id = :id";
            return $this->db->Select1("*", 'users', $where, array('id' => $filter));
        }
    }

    public function UserExport($fechaInicio, $fechaFin){
    
        if($fechaInicio !== null && $fechaFin !== null){
          $fechaInicio = date('Y-m-d', strtotime(str_replace('/', '-', $fechaInicio)));
          $fechaFin = date('Y-m-d', strtotime(str_replace('/', '-', $fechaFin)));
          
          $where = " WHERE created_at BETWEEN :fechaInicio AND :fechaFin";
          $array['fechaInicio'] = $fechaInicio;
          $array['fechaFin'] = $fechaFin;
          return $this->db->Select1("*", 'users', $where, $array);
        }else{
          return $this->db->Select1("*",'users',null,null);
        }
    }
}
