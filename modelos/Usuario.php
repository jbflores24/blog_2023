<?php

class Usuario {
    private $conn;
    private $table = 'usuarios';

    public function __construct($cx)
    {
        $this->conn = $cx;
    }

    public function registro ($nombre, $email, $password){
        //Instrucción que dice que hacer
        $qry = "insert into ".$this->table. " (nombre, email, password, rol_id) values (:nombre, :email, :password, 2)";
        //Preparo la operación
        $st = $this->conn->prepare($qry);
        //Encripto la contraseña
        $pass_encriptada = md5($password);
        // Asocial los parámetros de la sentencia $qry
        $st->bindParam (':nombre',$nombre, PDO::PARAM_STR);
        $st->bindParam (':email',$email, PDO::PARAM_STR);
        $st->bindParam (':password',$pass_encriptada, PDO::PARAM_STR);
        //Se ejecuta la acción
        if ($st->execute()){
            return true;
        }
        return false;
    }

    public function valida_email ($email){
        $qry = "select * from ". $this->table . " where email = :email";
        $st = $this->conn->prepare($qry);
        $st->bindParam (':email',$email, PDO::PARAM_STR);
        $st->execute();
        $resultado = $st->fetch(PDO::FETCH_ASSOC);
        if ($resultado){
            return true;
        }
        return false;
    }

    public function listar(){
        $qry = "select * from view_".$this->table;
        $st = $this->conn->prepare($qry);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public function individual($id){
        $qry = "select * from ".$this->table." where id = :id";
        $st = $this->conn->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public function editar($id, $rol_id){
        $qry = "update ". $this->table . " set rol_id = :rol_id where id = :id";
        $st = $this->conn->prepare($qry);
        $st->bindParam(":rol_id",$rol_id, PDO::PARAM_INT);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        if ($st->execute()){
            return true;
        }
        printf ("Error $s\n", $st->error);       
        return false; 
    }

    public function eliminar ($id){
        $qry = "delete from ". $this->table . " where id = :id";
        $st = $this->conn->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        try {
            if ($st->execute()){
                return true;
            }
        }catch(Exception $e) {
            return false;
        }
    }

    public function acceder ($email, $password){
        $pass = md5($password);
        $qry = "select * from " . $this->table . " where email= :email and password = :password";
        $st = $this->conn->prepare($qry);
        $st->bindParam (':email', $email, PDO::PARAM_STR);
        $st->bindParam (':password', $pass, PDO::PARAM_STR);
        $st->execute();
        if ($st->fetch(PDO::FETCH_ASSOC)){
            return true;
        } else {
            return false;
        }
    }

    public function usuario_email ($email){
        $qry = "select * from " . $this->table . " where email = :email";
        $st = $this->conn->prepare($qry);
        $st->bindParam (':email', $email, PDO::PARAM_STR);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }
}