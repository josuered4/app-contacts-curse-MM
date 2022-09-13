<?php
  require "database.php";
  //variable super global, server contiene informacion sobre la peticion mandada
  $error = null;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["name"])||empty($_POST["phone_number"])){
      $error = "Please fill all the field";
    }else if(strlen($_POST["phone_number"])<9){
      $error = "Phone number must be at least 9 characters";
    }else{
      $name = $_POST["name"];
      $phoneNumber = $_POST["phone_number"];

      //$statement = $conn -> prepare("INSERT INTO contacts(Name, Phone_Number) VALUES('$name', '$phoneNumber')");
      $statement = $conn -> prepare("INSERT INTO contacts(Name, Phone_Number) VALUES(:name, :phone_number)"); //con datos sonitizados de sql
      $statement -> bindParam(":name",$_POST["name"] ); //limpiamos los datos de sql
      $statement -> bindParam(":phone_number",$_POST["phone_number"] );
      $statement -> execute();
      //redireccionamos con un header
      header("Location: index.php");
    }
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

    
  }
?>

<!DOCTYPE html>
<?php require "partials/header.php"?>
      
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Add New Contact</div>
          <div class="card-body">
            <?php if($error): ?>
              <p class="text-danger">
                <?= $error ?>
              </p>
            <?php endif ?>
            <form method="post" action="add.php">
              <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
  
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name"  autocomplete="name" autofocus>
                </div>
              </div>
  
              <div class="mb-3 row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>
  
                <div class="col-md-6">
                  <input id="phone_number" type="tel" class="form-control" name="phone_number"  autocomplete="phone_number" autofocus>
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
      
<?php require "partials/footer.php"?>
