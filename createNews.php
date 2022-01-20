
<?php
if($admin)
{

$usersId = $_SESSION["userid"];
include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";

if(isset($_GET["error"])){
    switch($_GET["error"]){
        case "requiredMissing": echo '<p>Ihre Eingaben sind nicht korrekt oder unvollständig.</p>';
            break;
        case "POSTnotSent":echo '<p>POST Request ist schief gelaufen.</p>';
            break;
        default: echo '<p>Nicht spezifizierter Error.</p>';
    }
}
if(isset($_GET["success"])){
    if($_GET["success"] == 1){
        echo '<p>News erfolgreich gepostet.</p>';
    }
}

?>
<div class="PageContent">
<h2>News erstellen</h2>

<!-- Bildupload-->
<div id="TicketUploadContainer">
    <form action="include/createNews.inc.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="NewsTitle" class="form-label">Titel*:</label>
            <input type="text" name="NewsTitle" class="form-control" id="NewsTitle">
        </div>
        <div class="mb-3">
            <label for="NewsArtikel" class="form-label">Artikel*:</label>
            <textarea class="form-control" name="NewsArticle" id="NewsArtikel" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="NewsImageUpload" class="form-label">Bitte wählen Sie ein Bild zum uploaden:</label>
            <input class="form-control" type="file" name="NewsImageUpload" id="NewsImageUpload">
        </div>
        <div class="text-end">
            <button class="btn btn-primary" name="NewsSubmit" type="submit">Newsbeitrag posten</button>
        </div>
    </form>
</div>
<!-- Datum angeben-->
</div>

    <?php
}
else
{
    echo '<p class="text-center">Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}

?>