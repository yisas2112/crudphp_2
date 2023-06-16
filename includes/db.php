<?php 
    session_start();
    class db{
      private $servidor = "localhost";
      private $user = "root";
      private $pass = "";
      private $dbname = "php_mysql_crud";
      private $conection;

      public function __construct(){
        try{
          $this->conection = new PDO("mysql:host=$this->servidor;dbname=$this->dbname", $this->user, $this->pass);
          $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch(PDOExeption $err){
          return "Falla de conexión".$e;

        }
      }

      public function ejecutar($sql){
        $this->conection->exec($sql);
        return $this->conection->lastInsertId();
      }

      public function consulta($sql){      
        $setencia = $this->conection->prepare($sql);
        $setencia->execute();
        return $setencia->fetchAll();
      }
    }
?>