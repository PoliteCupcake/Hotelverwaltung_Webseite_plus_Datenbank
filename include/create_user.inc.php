<?php
session_start();

include_once "role.inc.php";

if($admin){

    include_once "functions.inc.php";
    include_once "dbaccess.inc.php";

    //$inputArr = array($anrede, $firstname, $lastname, $email, $username, $pwd, $pwdRepeat);
    $stringInputArr = array("firstname", "lastname", "email", "username", "pwd", "pwdRepeat");
    $inputAlph = array("lastname", "firstname");

    $UserData = array();
    $ErrorArr = array();

    foreach($stringInputArr as $input){
        $UserData[$input] = "";
        $ErrorArr[$input] = ""; 
    } 



    if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        if(pwdMatch($UserData["pwd"], $UserData["pwdRepeat"])){
            $ErrorArr["pwdRepeat"]= "";
        }
        else{
            $ErrorArr["pwd"]= "Passwort beim wiederholen gescheitert";
            $ErrorArr["pwdRepeat"]= "Passwort beim wiederholen gescheitert";
        }
    }
    $_SESSION["signUpErrors"] = $ErrorArr;

    if(signUpError($stringInputArr, $ErrorArr)){
        header("location: ../index.php?currPage=create_user&inputError=wrongInputs");
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
        $typ = $_POST["role"];          //Options: anonym, guest, serviceTech, admin

        if($_POST["status"]){           //Options: active, inactive
            $status = "active";
        }
        else{
            $status = "inactive";
        }
        

        createUserByAdmin($conn, $anrede, $firstname, $lastname, $email, $username, $pwd, $typ, $status);
    }
    else{
        header("location: ../index.php?currPage=create_user&Error=POSTnotSent");
    }

    }
else{
    echo '<p>Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}
