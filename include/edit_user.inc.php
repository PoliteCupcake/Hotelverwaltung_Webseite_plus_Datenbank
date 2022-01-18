<?php


include_once "functions.inc.php";
include_once "dbaccess.inc.php";



//$inputArr = array($anrede, $firstname, $lastname, $email, $username, $pwd, $pwdRepeat);
$stringInputArr = array("firstname", "lastname", "email", "username"); // check these values for errors
$inputAlph = array("lastname", "firstname");

$UserData = array();
$ErrorArr = array();

foreach($stringInputArr as $input){
    $UserData[$input] = "";
    $ErrorArr[$input] = ""; 
 } 



if($_SERVER["REQUEST_METHOD"] === "POST"){

    $existingUsersId = $_POST["usersId"];
    foreach($stringInputArr as $input){
        $UserData[$input] = checkInput($_POST[$input]);

        if($UserData[$input] == ""){
            $ErrorArr[$input] = 'Bitte ausfüllen!'; 
        }
        else{
            $ErrorArr["username"] = checkForAlphNum($UserData["username"]);
            $ErrorArr["email"] = checkEmail($UserData["email"]);
        }
    }
    foreach($inputAlph as $input){
        $Errors[$input] = checkForAlph($UserData[$input]);
    }
     
}




$_SESSION["signUpErrors"] = $ErrorArr;

if(!empty($_POST["pwd"])){
    if(!pwdMatch($_POST["pwd"], $_POST["pwdRepeat"])){
        header("location: ../index.php?currPage=edit_user&usersId=". $existingUsersId ."&inputError=pwdNotMatching");
        exit(); 
    }
    $pwdChanged = true;
}
else{
    $pwdChanged = false;
}

if(signUpError($stringInputArr, $ErrorArr)){
    header("location: ../index.php?currPage=edit_user&usersId=". $existingUsersId ."&inputError=wrongInputs");
    exit(); 
}



if(isset($_POST["submit"]))
{   


    $anrede = $_POST["anrede"];
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    // typ can only be changed by admin!!
    $typ = $_POST["role"];          //Options: anonym, guest, service, admin

    if($_POST["status"]){           //Options: active, inactive
        $status = "active";
    }
    else{
        $status = "inactive";
    }


    if(userUid_by_userId($conn, $existingUsersId) !== $_POST["username"]){
        if(!OnlyUidExists($conn, $username)){
            header("location: ../index.php?currPage=edit_user&usersId=". $existingUsersId ."&inputError=usernameAlreadyTaken");
            exit(); 
        }
    }
    if(userEmail_by_userId($conn, $existingUsersId) != $_POST["email"]){
        if(!OnlyUidExists($conn, $email)){
            header("location: ../index.php?currPage=edit_user&usersId=". $existingUsersId ."&inputError=emailAlreadyTaken");
            exit(); 
        }
    } 


    editUserByAdmin($conn, $existingUsersId, $pwdChanged, $anrede, $firstname, $lastname, $email, $username, $pwd, $typ, $status);
}



