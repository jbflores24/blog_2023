<?php
class Mysql{
    //Variables para la conexión
    private $host = "localhost";
    private $db_name = 'blog_2023';
    private $user = 'root';
    private $password = '';
    private $conn;

    //Conexión al servidor de B.D. con PDO
    public function connect (){
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) {
            echo "Error en la conexión : " . $e->getMessage();
        }
        return $this->conn;
    }
}