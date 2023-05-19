<?php
    class Articulo{
        private $conn;
        private $table = 'articulos';

        public function __construct($cx)
        {
            $this->conn = $cx;
        }

        public function listar($usuario_id, $rol_id){
            $cad="";
            if ($rol_id !=1 ){
                $cad = " where usuario_id = :usuario_id";
            }
            $qry = "select * from view_".$this->table.$cad;
            $st = $this->conn->prepare($qry);
            if ($rol_id !=1 ){
                $st->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            }
            $st->execute();
            return $st->fetchAll(PDO::FETCH_OBJ);
        }
    }