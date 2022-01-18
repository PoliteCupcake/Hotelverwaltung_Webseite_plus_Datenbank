
<?php

/*
durch rollen iterieren
nur guest, service, admin können die funktionen sehen und nutzen
*/



  if(isset($_GET["UserStatus"])){
    if($_GET["UserStatus"] == "logout"){
        session_unset();
        header("Location: https://127.0.0.1/Biegler_Semesterprojektv2/index.php");
        $status = "Your logged out!";
        exit($status);
    }

} 


