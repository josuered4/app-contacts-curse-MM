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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Modo Nocturno-->
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.0/darkly/bootstrap.min.css" 
    integrity="sha512-gUckM9ucxSOwqWuP2kRpTZjtzXfgyKGUlMbXcOq9SAXY+qubqqJTht1XHZvK8rUjFKylKb+gtTK2IiOK3jk4TA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script 
    defer
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" 
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./static/css/index.css" />

    <title>Contacts App</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand font-weight-bold" href="#">
          <img class="mr-2" src="./static/img/logo.png" />
          ContactsApp
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./add.php">Add Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
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
                  <a href="#" class="btn btn-secondary mb-2">Edit Contact</a>
                  <a href="delete.php?id=<?=$contact["id"]?>" class="btn btn-danger mb-2">Delete Contact</a>
                  <!--redireccionamos al delete y le concatenamos el id-->
                </div>
              </div>
            </div>
          <?php endforeach?>

        </div>
      </div>
    </main>
  </body>
</html>
