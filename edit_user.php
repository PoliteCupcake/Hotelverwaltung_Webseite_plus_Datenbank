<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION["signUpErrors"])){
        $ErrorArr = $_SESSION["signUpErrors"];
    } 
    
    require_once "include/functions.inc.php";
    $existingUsersId = $_GET["usersId"];
    include_once "include/edit_user.inc.php";

    if(isset($_GET["inputError"])){
        echo "<p>error</p>";
    }
    
$specifiedUser = array();

    if(isset($_GET["usersId"])){
        $allUsers = getAllUsers($conn);
        foreach($allUsers as $user){
            if($user["usersId"] == $existingUsersId){
                $specifiedUser = $user;
                break;
            } 
        } 
    }

?>

<div class="PageContent">
    <h2>Ändern eines Benutzers</h2>
    <form action="include/edit_user.inc.php" method="post">
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
                <input class="col-md-6" type="text"     name="firstname"        value="<?php echo $specifiedUser["firstname"]; ?>">
            </div class="container row pb-2">
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="lastname">Nachname*:</label>
                <input class="col-md-6" type="text"     name="lastname"         value="<?php echo $specifiedUser["lastname"]; ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="email">E-Mail*:</label>
                <input class="col-md-6" type="text"     name="email"            value="<?php echo $specifiedUser["email"]; ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="username">Benutzername*:</label>
                <input class="col-md-6" type="text"     name="username"         value="<?php echo $specifiedUser["username"]; ?>">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="pwd">Passwort wählen*:</label>
                <input class="col-md-6" type="password" name="pwd"           placeholder="Leer lassen, um nichts zu ändern!" >
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="pwdRepeat">Passwort wiederholen*:</label>
                <input class="col-md-6" type="password" name="pwdRepeat"    placeholder="Leer lassen, um nichts zu ändern!">
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="role">Rolle: </label>
                <select class="col-md-6" name="role" id="role">
                <?php
                if($specifiedUser["role"] == "guest"){
                    echo '<option selected name="role" value="guest">Gast</option>';
                    echo '<option name="role" value="service">Techniker</option>';
                }
                else{
                    echo '<option name="role" value="guest">Gast</option>';
                    echo '<option selected name="role" value="service">Techniker</option>';                    
                }
                ?>
                </select>                
            </div>
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="status">Aktiv: </label>
                <input class="col-md-6" type="checkbox" name="status" <?php if($specifiedUser["status"] == "active") {echo "checked";}?> >
            </div>
            <!-- usersId posted to edit_user.inc.php -->
            <input type="hidden" id="usersId" name="usersId" value="<?php echo $existingUsersId ?>">
            <button type="submit"  name="submit">Sign up </button>

        </form>
</div>