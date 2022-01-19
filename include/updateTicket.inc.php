<?php

require_once 'dbaccess.inc.php';
require_once 'functions.inc.php';


if(isset($_POST["submit"]))
{


    $status = $_POST["status"];
    $id     = $_POST["id"];
    updateTicket($conn, $status, $id);

}
else
{
    header("location: ../index.phh?currPage=ticket&" . "$id" ."error=notUpdated");
    exit();
}