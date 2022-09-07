<?php
  //es como un import 
  require "database.php";

  $id = $_GET["id"];

  $statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
  $statement->bindParam(":id", $id);
  $statement->execute();

  if ($statement->rowCount()==0) {
    //si no se encontro nada
    
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
  }


  $conn->prepare("DELETE FROM contacts WHERE id = :id")->execute([":id" => $id]);
  //Lo mismo que abajo pero mas corto.

  /*$statement = $conn->prepare("DELETE FROM contacts WHERE id = :id");
  $statement->bindParam(":id", $id);
  $statement->execute();*/
  //statement->execute([":id" => $id]); mas rapido 

  header("Location: index.php");
