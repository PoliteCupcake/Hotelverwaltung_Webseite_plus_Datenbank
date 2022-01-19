<?php

require_once 'dbaccess.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"]))
{
    $status = $_POST["status"];
    updateTicket($conn, $status);
}
else
{
    header("location: ../index.php?currPage=ticket");
    exit();
}