<?php
  /*
  if(file_exists("contacts.json")){
    $contacts = json_decode(file_get_contents("contacts.json"), true);
    // obtenemos y decodificamos el contenido del json para usarlo en la lista
    //cuando php decodifica un json crea un objeto con lo que decofica, por eso ponermos el true, para que lo combiar en un array
  }else{
    $contacts = [];
  }*/

  require "database.php";

  //query manda los datos en formato lista 
  $contacts = $conn->query("SELECT * FROM contacts");

?>
<?php require "partials/header.php"?>
  <div class="container pt-4 p-3">
    <div class="row">
      <!--
      <div class="col-md-4 mb-3">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title text-capitalize">Contact Name 1</h3>
            <p class="m-2">987654321</p>
            <a href="#" class="btn btn-secondary mb-2">Edit Contact</a>
            <a href="#" class="btn btn-danger mb-2">Delete Contact</a>
          </div>
        </div>
      </div>-->

      <?php if($contacts->rowCount()==0):?>
        <div class="col-md-4 mx-auto">
          <div class="card card-body text-center">
            <p>No contacts saved yet</p>
            <a href="add.php">Add One!</a>
          </div>
        </div>
      <?php endif?>

      <?php foreach($contacts as $contact): ?>
        <div class="col-md-4 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <h3 class="card-title text-capitalize"><?= $contact["Name"]; ?></h3>
              <p class="m-2"><?= $contact["Phone_Number"]; ?></p>
              <a href="edit.php?id=<?=$contact["id"]?>" class="btn btn-secondary mb-2">Edit Contact</a>
              <a href="delete.php?id=<?=$contact["id"]?>" class="btn btn-danger mb-2">Delete Contact</a>
              <!--redireccionamos al delete y le concatenamos el id-->
            </div>
          </div>
        </div>
      <?php endforeach?>

    </div>
  </div>
<?php require "partials/footer.php" ?>
