<?php 
    if(!isset($_SESSION)){
      session_start();
  }
  
  // $UserType = array("Guest", "User", "Admin");  for later maybe?

  if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(
          $_POST["EmailLogin"] === "Musterman" &&
          $_POST["PasswortLogin"] === "PasswortMuster"
      ) {
          $_SESSION["Username"] = $_POST["EmailLogin"];
          $_SESSION["UserLevel"] = "guest";
          header("Location: https://127.0.0.1/Biegler_Semesterprojektv2/index.php");
          $status = "Your logged in!";
          exit($status);
      }
  }
?>

<div id="LoginCardContainer" class="position-absolute end-0 container-md">
<div class="collapse" id="LoginField">
  <form action="index.php" method="post">
    <div id="LoginCard" class="card">
      <div class="card-body bg-secondary text-light">
        <h3 class="card-title">Login</h3>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div>
            <label class="form-label" for="EmailLogin">E-Mail: </label>
            <input type="text" class="form-control" name="EmailLogin">
          </div>      
        </li>
        <li class="list-group-item">
          <div>
            <label class="form-label" for="PasswortLogin">Passwort: </label>
            <input type="password" class="form-control" name="PasswortLogin">
          </div>
        </li>
      </ul>
      <div class="card-body">
        <button type="submit" class="btn btn-primary">Login</button>
        <button type="reset" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#LoginField">Abbrechen und Schließen</button>
      </div>
    </div>
  </form>
</div>  
</div>

