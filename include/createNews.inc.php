<?php
include_once "role.inc.php";
if($admin){
    /* not needed since only logged in admin can get here
    if(!isset($_SESSION)){
        session_start();
    }
    */

    //Including functions and database access
    include_once "functions.inc.php";
    include_once "dbaccess.inc.php";

    //Checks if input is an image
    //possible to post news without a picture
    if(is_uploaded_file($_FILES["NewsImageUpload"]["tmp_name"])){
        $InputArr = array("file_path", "title", "article");
        $uploadOk = 1;
        $uuid = guidv4();
        $imageFileType = strtolower(pathinfo(basename($_FILES["NewsImageUpload"]["name"]),PATHINFO_EXTENSION));
        $target_dir = "..\\NewsImages\\";
        $target_file = $target_dir . $uuid. "." . $imageFileType;

        // Checks if fileformat is an image
        if(isset($_POST["NewsSubmit"]))
        {
            $check = getimagesize($_FILES["NewsImageUpload"]["tmp_name"]);
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

            if (move_uploaded_file($_FILES["NewsImageUpload"]["tmp_name"], $target_file)) {
                echo "<p>The file ". htmlspecialchars( basename( $_FILES["NewsImageUpload"]["name"])). " has been uploaded.</p>";
                //echo "<p><img src='". "../NewsImageUpload/". $uuid. $imageFileType . "' height=200></p>";
                $filepath = "NewsImages/". $uuid. "." . $imageFileType;
                if(isset($_POST["NewsSubmit"])){
                    if(!empty($_POST["NewsTitle"]) || !empty($_POST["NewsArticle"])){   
                        $newstitle = $_POST["NewsTitle"];
                        $article = $_POST["NewsArticle"];
                        createNewsArticle($conn, $filepath, $newstitle, $article);
                        header("location: ../index.php?currPage=createNews&success=1");  
                    }
                    else{
                        header("location: ../index.php?currPage=createNews&error=requiredMissing");
                    }
 
                }

                else{
                    header("location: ../index.php?currPage=createNews&error=POSTnotSent");
                }
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }    
    }
    else{
        if(isset($_POST["NewsSubmit"])){
            if(!empty($_POST["NewsTitle"]) || !empty($_POST["NewsArticle"])){
                $filepath = "NOIMAGE";
                $newstitle = $_POST["NewsTitle"];
                $article = $_POST["NewsArticle"];
                createNewsArticle($conn, $filepath, $newstitle, $article);
                header("location: ../index.php?currPage=createNews&success=1");
            }
            else{
                header("location: ../index.php?currPage=createNews&error=requiredMissing");
                //echo "Bitte Titel und Artikel ausfüllen!";
            }
        }
        echo "no image";
    }
}
else{
    header("location: ../index.php?access=denied");
    echo '<p>Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}
