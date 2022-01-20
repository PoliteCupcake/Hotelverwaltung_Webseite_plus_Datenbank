<div class="PageWrap">

<?php

//All logged in users can created a ticket

if($guest || $admin || $serviceTech)
{

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";
?>
    <div class="PageContent">
        <h2>Bildupload</h2>

        <p>Hier können Sie Bilder hochladen über Mängel oder Schäden die Sie melden möchten. Zusätzlich können Sie ein Datum und eine Uhrzeit wählen, zu welcher einer unsererer Servicetechniker vorbeikommen kann.</p>

        <div id="TicketUploadContainer">

            <form action="include/createTicket.inc.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="TicketBetreff" class="form-label">Betreffend...</label>
                    <input type="text" name="TicketTitle" class="form-control" id="TicketBetreff">
                </div>
                <div class="mb-3">
                    <label for="TicketBeschreibung" class="form-label">Beschreibung:</label>
                    <textarea class="form-control" name="TicketComment" id="TicketBeschreibung" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="TicketUpload" class="form-label">Bitte wählen Sie ein Bild zum uploaden:</label>
                    <input class="form-control" type="file" name="TicketUpload" id="TicketUpload">
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" name="TicketSubmit" type="submit">Ticket senden</button>
                </div>
            </form>

        </div>

    </div>
<?php
}
else
{
    echo '<p class="text-center">Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen um Tickets zu erstellen.</p>';
}
?>
</div>
