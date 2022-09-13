<?php
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
  
  $contact = $statement->fetch(PDO::FETCH_ASSOC);//en lugar de retornar un array nos dara a un objeto 

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

      $statement = $conn -> prepare("UPDATE contacts SET Name = :name, Phone_Number=:phone_number WHERE id = :id");
      $statement -> execute([
        ":id" => $id, 
        ":name" => $_POST["name"], 
        ":phone_number" => $_POST["phone_number"], 
      ]);
      //redireccionamos con un header
      header("Location: index.php");
    }  
  }
?>

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
            <form method="post" action="edit.php?id=<?=$contact["id"]?>">
              <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
  
                <div class="col-md-6">
                  <input value="<?= $contact["Name"]?>" id="name" type="text" class="form-control" name="name"  autocomplete="name" autofocus>
                </div>
              </div>
  
              <div class="mb-3 row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>
  
                <div class="col-md-6">
                  <input value="<?= $contact["Phone_Number"]?>" id="phone_number" type="tel" class="form-control" name="phone_number"  autocomplete="phone_number" autofocus>
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
