<?php
include_once "role.inc.php";
if($guest){

    //Users can change
    //email address here
    if(!isset($_SESSION)){
        session_start();
    }
    $usersId = $_SESSION["userid"];
    include_once "functions.inc.php";
    include_once "dbaccess.inc.php";

    if(!empty($_POST["ChangeEmail"])){
        $newEmail = $_POST["ChangeEmail"];
        if(checkEmail($newEmail) == ""){
            if(!OnlyEmailExists($conn, $newEmail)){
                header("location: ../index.php?currPage=profile&error=emailAlreadyTaken");
                exit(); 
            }
            else{
                updateEmail($conn, $usersId, $newEmail);
            }
        }
        else{
            header("location: ../index.php?currPage=profile&error=notAValidemail");
        }
    }
    else{
        header("location: ../index.php?currPage=profile&noChanges");
    }
    
}
else{
    header("location: ../index.php?access=denied");
    echo '<p>Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}