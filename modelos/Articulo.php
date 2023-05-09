<?php
    class Articulo{
        private $conn;
        private $table = 'articulos';

        public function __construct($cx)
        {
            $this->conn = $cx;
        }

        public function listar(){
            $qry = "select * from view_".$this->table;
            $st = $this->conn->prepare($qry);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_OBJ);
        }
    }