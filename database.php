<?php

$host = "localhost";
$database = "contacts_app";
$user = "root";
$password = "";

try{
  //strign connexion
  $conn = new PDO("mysql:host=$host;dbname=$database",$user,$password);

  //se ejecutara un query e imprimimos las bases de datos.
  /*foreach($conn->query("SHOW DATABASES")as $row){
    print_r($row);
  }
  die();*/
}catch (PDOException $e){
  //en caso de haber un problema de conexion
  die("PDO Connnection Error: ". $e->getMessage());
}
