/*
Rolle: Anon kann diese seite nicht erreichen;
Rolle: Guest kann TIcket erstellen;
Rolle: service kann Ticket erstellenl;
Rolle: Admin kann Ticket erstellen;
*/

<?php
include_once "imagehandling.inc.php";
//include_once "functions.inc.php";
include_once "dbaccess.inc.php";

$InputArr = array("file_path", "title", "comment");
$uploadOk = 1;
$uuid = guidv4();
$imageFileType = strtolower(pathinfo(basename($_FILES["TicketUpload"]["name"]),PATHINFO_EXTENSION));
$target_dir = "..\\ticketUploads\\";
$target_file = $target_dir . $uuid. $imageFileType; 




// Überprüfung ob Bild echtes Bild ist
if(isset($_POST["submit"]))
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
    var_dump($_FILES);
    if (move_uploaded_file($_FILES["TicketUpload"]["tmp_name"], $target_file)) {
        echo "<p>The file ". htmlspecialchars( basename( $_FILES["TicketUpload"]["name"])). " has been uploaded.</p>";
        echo "<p><img src='". "../ticketUploads/". $uuid. $imageFileType . "' height=200></p>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}







