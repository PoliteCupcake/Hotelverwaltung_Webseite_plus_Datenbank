<?php

if($admin)
{

$usersId = $_SESSION["userid"];
include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";
?>

    if(!isset($_SESSION)){
        session_start();
    }
    if(!empty($_SESSION["signUpErrors"])){
        $ErrorArr = $_SESSION["signUpErrors"];
    }
    
    require_once "include/functions.inc.php";
    
    if(isset($_GET["inputError"])){
        echo "<p>error</p>";
    }
?>

<div class="PageContent">
    <h2>Neuen Benutzer anlegen</h2>
    <form action="include/create_user.inc.php" method="post">
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="anrede">Anrede: </label>
                <select class="col-md-6" name="anrede" id="anrede">
                    <option selected name="anrede" value="">Keine Angabe</option>
                    <!--changed: "User_Anrede" to "anrede" -->
                    <option name="anrede" value="Herr">Herr</option>
                    <option name="anrede" value="Frau">Frau</option>
                    <option name="anrede" value="Enby">Enby</option> 
                </select>                
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="firstname">Vorname*:</label>
                <input class="col-md-6" type="text"     name="firstname"     placeholder="<?php if(isset($ErrorArr)){echo $ErrorArr["firstname"];} ?>">
            </div class="container row pb-2">
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="lastname">Nachname*:</label>
                <input class="col-md-6" type="text"     name="lastname"      placeholder="<?php if(isset($ErrorArr)){echo $ErrorArr["lastname"];} ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="email">E-Mail*:</label>
                <input class="col-md-6" type="text"     name="email"         placeholder="<?php if(isset($ErrorArr)){echo $ErrorArr["email"];} ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="username">Benutzername*:</label>
                <input class="col-md-6" type="text"     name="username"      placeholder="<?php if(isset($ErrorArr)){echo $ErrorArr["username"];} ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="pwd">Passwort wählen*:</label>
                <input class="col-md-6" type="password" name="pwd"           placeholder="<?php if(isset($ErrorArr)){echo $ErrorArr["pwd"];} ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="pwdRepeat">Passwort wiederhgolen*:</label>
                <input class="col-md-6" type="password" name="pwdRepeat" >
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="role">Rolle: </label>
                <select class="col-md-6" name="role" id="role">
                    <option selected name="role" value="guest">Gast</option>
                    <option name="role" value="serviceTech">Techniker</option>
                </select>                
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="status">Aktiv: </label>
                <input class="col-md-6" type="checkbox" name="status" checked>
            </div>
            <button type="submit"  name="submit">Sign up </button>

        </form>
</div>

    <?php
}
else
{
    echo '<p class="text-center">Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}

?>