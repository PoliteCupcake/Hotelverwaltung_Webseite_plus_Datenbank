/*
Rolle: Anon kann diese seite nicht erreichen;
Rolle: Guest kann TIcket erstellen;
Rolle: service kann Ticket erstellenl;
Rolle: Admin kann Ticket erstellen;
*/

<?php
include_once "role.inc.php";

if($guest || $serviceTech || $admin){
    /* nicht notwendig
    if(!isset($_SESSION)){
        session_start();
    }
    */
    include_once "functions.inc.php";
    include_once "dbaccess.inc.php";

    //guidV4() generates a unique id for the uploaded image
    //uploadOk flag set to 1
    $InputArr = array("file_path", "title", "comment");
    $uploadOk = 1;
    $uuid = guidv4();
    $imageFileType = strtolower(pathinfo(basename($_FILES["TicketUpload"]["name"]),PATHINFO_EXTENSION));
    $target_dir = "..\\ticketUploads\\";
    $target_file = $target_dir . $uuid. "." . $imageFileType;




    // Check if file is an image
    if(isset($_POST["TicketSubmit"])) //submit to TicketSubmit
    {
        $check = getimagesize($_FILES["TicketUpload"]["tmp_name"]);
        if($check !== false)
        {
            echo " Datei ist ein Bild - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else
        {
            echo "Datei ist kein Bild.";
            $uploadOk = 0;
        }
    }
    else{
        header("location: ../index.php?currPage=createTicket&error=POSTnotSent");
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["TicketUpload"]["tmp_name"], $target_file)) {
            echo "<p>The file ". htmlspecialchars( basename( $_FILES["TicketUpload"]["name"])). " has been uploaded.</p>";
            //echo "<p><img src='". "../ticketUploads/". $uuid. $imageFileType . "' height=200></p>";
            $filepath = "ticketUploads/". $uuid. "." . $imageFileType;
            if(isset($_POST["TicketSubmit"])){
                $title = $_POST["TicketTitle"];
                $comment = $_POST["TicketComment"];
                $userid = $_SESSION["userid"];
                $ticketStatus = "open";
                createTicket($conn, $filepath, $title, $comment, $userid, $ticketStatus);                           //createTicket sends a sql-query to DB
                header("location: ../index.php?currPage=createTicket&success");
            }
            else{
                header("location: ../index.php?currPage=createTicket&error=POSTnotSent");
            }
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
else{
    header("location: ../index.php?access=denied");
    echo '<p>Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}







