<?php
declare (strict_types = 1);
class AnonymousClasses
{
    public function TLogin(array $array){
        return new class($array){
            public $id = 0;
            public $nombre;
            public $user;
            public $password;
            function __construct($array){
                if(0 < count($array)){
                    if (!empty($array["id"])){$this->id = $array["id"];}
                    if (!empty($array["nombre"])){$this->nombre = $array["nombre"];}
                    if (!empty($array["user"])){$this->user = $array["user"];}
                    if (!empty($array["password"])){$this->password = $array["password"];}
                }
            }
        };
    }


    public function TUser(array $array){
        return new class($array){
            public $id = 0;
            public $full_name;
            public $document_type;
            public $document_number;
            public $created_at;
            function __construct($array){
                if(0 < count($array)){
                    if (!empty($array["id"])){$this->id = $array["id"];}                    
                    if (!empty($array["full_name"])){$this->full_name = $array["full_name"];}
                    if (!empty($array["document_type"])) {$this->document_type = $array["document_type"];}
                    if (!empty($array["document_number"])) {$this->document_number = $array["document_number"];}
                    if (!empty($array["created_at"])){$this->created_at = $array["created_at"];}
                }
            }
        };
    }
}

?>