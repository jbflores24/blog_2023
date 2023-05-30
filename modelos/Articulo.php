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

        public function crear ($titulo, $imagen, $texto, $usuario_id){
            $qry = "insert into ". $this->table. "(titulo, imagen, texto, usuario_id) values (:titulo, :imagen, :texto, :usuario_id)";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $st->bindParam(':imagen', $imagen, PDO::PARAM_STR);
            $st->bindParam(':texto', $texto, PDO::PARAM_STR);
            $st->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            if ($st->execute()){
                return true;
            }
            printf ("Error $s\n", $st->error);       
            $st->close();
            return false;
        }

        public function getArticulo($id){
            $qry = "select * from ".$this->table." where id = :id";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
            return $st->fetch(PDO::FETCH_OBJ);
        }

        public function editar($id, $titulo, $imagen, $texto){
            $qry = "update ".$this->table." set titulo=:titulo, texto=:texto where id = :id";
            if ($imagen != ""){
                $qry = "update ".$this->table." set titulo=:titulo, texto=:texto, imagen=:imagen where id = :id";
            }
            $st = $this->conn->prepare($qry);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $st->bindParam(':texto', $texto, PDO::PARAM_STR);
            if ($imagen != ""){
                $st->bindParam(':imagen', $imagen, PDO::PARAM_STR);
            }
            if ($st->execute()){
                return true;
            }
            printf ("Error $s\n", $st->error);
            $st->close();
            return false;
        }

        public function eliminar($id){
            $qry = "delete from ".$this->table." where id = :id";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            try{
                if ($st->execute()){
                    return true;
                }
            }catch(Exception $e){
                return false;
            }
        }
    }