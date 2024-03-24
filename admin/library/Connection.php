<?php
require_once 'QueryManager.php';
class Connection
{
    var $db;
    function __construct() {
        $this->db = new QueryManager("root", "", "ganaconos_bdusers_register");
    }
}

?>