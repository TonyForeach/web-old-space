<?php
require_once 'library/Connection.php';
class Main_model extends Connection
{
    public function __construct(){
        parent::__construct();
    }
    
    public function CountUsers($documentType)
    {
        if ($documentType == 'DNI' || $documentType == 'Carnet de Extranjeria') {
            $where = " WHERE document_type LIKE ?";
            $params = array($documentType . '%');
        } else {
            $where = "";
            $params = array();
        }
         
        $response = $this->db->Select1("COUNT(*)", 'users', $where, $params);
        return $response['results'][0]['COUNT(*)'];
    }
}