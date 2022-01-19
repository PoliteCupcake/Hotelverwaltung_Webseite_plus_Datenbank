<?php
include_once "role.inc.php";
if($anon){

    if (isset($_POST["submit"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once 'dbaccess.inc.php';
        require_once 'functions.inc.php';

        if( emptyInputLogin($username, $password) )
        {
            header("location: ../index.php?currPage=loginNew&error=emptyinput");
            exit();
        }

        loginUser($conn, $username, $password);
    }
    else
    {
        header("location: ../index.php?currPage=loginNew");
        exit();
    }
}
else{
    echo '<p>Sie sind bereits eingeloggt.</p>';
}