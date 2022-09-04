<?php
  //variable super global, server contiene informacion sobre la peticion mandada
  if($_SERVER["REQUEST_METHOD"]=="POST"){

    /*var_dump($_POST);
    die();*/
   
    /*$contact = [
      "name" => $_POST["name"], 
      "phone_number" => $_POST["phone_number"], 
    ];
    if(file_exists("contacts.json")){
      $contacts = json_decode(file_get_contents("contacts.json"), true);
      // obtenemos y decodificamos el contenido del json para usarlo en la lista
      //cuando php decodifica un json crea un objeto con lo que decofica, por eso ponermos el true, para que lo combiar en un array
    }else{
      $contacts = [];
    }

    $contacts[] = $contact;

    //funcion para almacenar el contacts  en un archivo json
    file_put_contents("contacts.json", json_encode($contacts));*/

    require "database.php";
    $name = $_POST["name"];
    $phoneNumber = $_POST["phone_number"];

    $statement = $conn -> prepare("INSERT INTO contacts(Name, Phone_Number) VALUES('$name', '$phoneNumber')");
    $statement -> execute();
    //redireccionamos con un header
    header("Location: index.php");
  }
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
              <a class="nav-link" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./add.php">Add Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      
      <div class="container pt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Add New Contact</div>
              <div class="card-body">
                <form method="post" action="add.php">
                  <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
      
                    <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                    </div>
                  </div>
      
                  <div class="mb-3 row">
                    <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>
      
                    <div class="col-md-6">
                      <input id="phone_number" type="tel" class="form-control" name="phone_number" required autocomplete="phone_number" autofocus>
                    </div>
                  </div>
      
                  <div class="mb-3 row">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </main>
  </body>
</html>
