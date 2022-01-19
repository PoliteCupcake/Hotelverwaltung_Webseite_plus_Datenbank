

<?php

    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION["signUpErrors"])){
        $ErrorArr = $_SESSION["signUpErrors"];
    } 
    
    require_once "include/functions.inc.php";
    
    if(isset($_GET["inputError"])){
        echo "<p>error</p>";
    }
?>
<!--
<div class="container row pb-2">
    <label class="col-md-4 text-md-end" for="Vorname">Neuer Vorname: </label>
    <input class="col-md-6" type="text" name="Vorname">                        
</div>
-->

<div class="PageWrap">
    <div class="PageContent">
        <form action="include/signup.inc.php" method="post">
            <div class="container row pb-2">
                <label class="col-md-4 text-md-end" for="Anrede">Anrede: </label>
                <select class="col-md-6" name="anrede" id="anrede">
                    <option selected name="anrede" value="">Keine Angabe</option>
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
            <button type="submit"  name="submit">Sign up </button>

        </form>
    </div>
</div>
<?php

?>
</body>
</html>