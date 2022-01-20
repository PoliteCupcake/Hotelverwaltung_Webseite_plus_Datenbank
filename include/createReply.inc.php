<?php

require_once 'role.inc.php';

// check if user is a serviceTech anyway
if(!$serviceTech)
{
    // user is not a serviceTech.
    // in this case, user is anyways not allowed to create replies. Therefore,
    // send user to our landing page
    header("location: ../index.php");
    exit();
}

// check if a POST from a form to this script has (not) occured
if (!isset($_POST["submit"]))
{
    // no form data has been POSTed to this script, therefore
    // send user to our landing page
    header("location: ../index.php");
    exit();
}

// form data has been POSTed to this script.
// now check if the required inputs are present
if (!isset($_POST["ticketId"]) || !isset($_POST["reply"]))
{
    // not all required inputs present.
    // in this case, script was invoked from external source, therefore:
    // send user to our landing page
    header("location: ../index.php");
    exit();
}

// all required inputs are present.
// extract these to local variables
$ticketId = $_POST["ticketId"];
$reply = $_POST["reply"];

// check if the reply is empty
/* TODO */

// check if ticket with this ticketId is actually existing in database
/* TODO */

// all good to go, insert reply into database!
require_once 'functions.inc.php';
require_once 'dbaccess.inc.php';
createReply($conn, $ticketId, $reply);
