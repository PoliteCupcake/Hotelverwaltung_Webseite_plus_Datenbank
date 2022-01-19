<?php

if(!isset($_SESSION)){
    session_start();
}
$usersId = $_SESSION["userid"];

include_once "functions.inc.php";
include_once "dbaccess.inc.php";

if(!empty($_POST["ChangeUsername"])){
    $newUsername = $_POST["ChangeUsername"];
    if(checkForAlphNum($newUsername) == ""){
        if(!OnlyUidExists($conn, $newUsername)){
            header("location: ../index.php?currPage=profile&error=usernameAlreadyTaken");
            exit(); 
        }
        else{
            updateUsername($conn, $usersId, $newUsername);
        }
    }
    else{
        header("location: ../index.php?currPage=profile&error=notAValidUsername");
    }
}
else{
    header("location: ../index.php?currPage=profile&noChanges");
}

