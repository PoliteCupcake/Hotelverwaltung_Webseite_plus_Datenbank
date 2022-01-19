<?php

include_once "functions.inc.php";
include_once "dbaccess.inc.php";

if(isset($_POST["ChangeName"]) && !empty($_POST["ChangeName"])){
    
    $newFirstname = checkInput($_POST["ChangeFirstname"]);
    $newLastname = checkInput($_POST["ChangeLastname"]);
    if(checkForAlph($newFirstname) == "" && checkForAlph($newLastname) == ""){
        // change in database
    }
    else{
        header("location: ../index.php?currPage=profile&error=LettersOnly");
    }
}
else{
    header("location: ../index.php?currPage=profile&noChanges");
}

if(isset($_POST["ChangeEmail"]) && !empty($_POST["ChangeEmail"])){
    $newEmail = $_POST["ChangeLastname"];
    if(checkEmail($newEmail) == ""){
        // change in database
    }
    else{
        header("location: ../index.php?currPage=profile&error=notAValidEmail");
    }
}
else{
    header("location: ../index.php?currPage=profile&noChanges");
}

if(isset($_POST["ChangeUsername"]) && !empty($_POST["ChangeUsername"])){
    $newUsername = $_POST["ChangeUsername"];
    if(checkForAlphNum($newUsername) == ""){
        // change in database
    }
    else{
        header("location: ../index.php?currPage=profile&error=notAValidUsername");
    }
}
else{
    header("location: ../index.php?currPage=profile&noChanges");
}
