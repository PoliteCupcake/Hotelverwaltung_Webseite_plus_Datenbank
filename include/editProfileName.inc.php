<?php
include_once "role.inc.php";
if($guest){

    if(!isset($_SESSION)){
        session_start();
    }
    $usersId = $_SESSION["userid"];

    include_once "dbaccess.inc.php";
    include_once "functions.inc.php";

    if(($_SERVER["REQUEST_METHOD"]) == "POST"){

        if(!empty($_POST["ChangeFirstname"]) && !empty($_POST["ChangeLastname"])){
            
            $newFirstname = checkInput($_POST["ChangeFirstname"]);
            $newLastname = checkInput($_POST["ChangeLastname"]);
            if(checkForAlph($newFirstname) == "" && checkForAlph($newLastname) == ""){
                updateNames($conn, $usersId, $newLastname, $newFirstname);
            }
            else{
                header("location: ../index.php?currPage=profile&error=LettersOnly");
            }
        }
        else{
            header("location: ../index.php?currPage=profile&noChanges");
        }
    }
}
else{
    header("location: ../index.php?access=denied");
    echo '<p>Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}