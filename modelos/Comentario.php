<?php
    class Comentario{
        private $conn;
        private $table = 'comentarios';

        public function __construct($cx)
        {
            $this->conn = $cx;
        }

        public function listar ($usuario_id, $rol_id){
            $cad="";
            if ($rol_id!=1){
                $cad = " where prop_art = :usuario_id";
            }
            $qry = "select * from view_".$this->table.$cad;
            $st = $this->conn->prepare($qry);
            if ($rol_id!=1){
                $st->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            }
            $st->execute();
            return $st->fetchAll(PDO::FETCH_OBJ);
        }
    }