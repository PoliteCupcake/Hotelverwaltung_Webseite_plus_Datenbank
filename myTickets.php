<?php

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";

?>

<?php
#session_start();
if(isset($_SESSION["userid"])  )
{
    ?>

    <div class="PageContent">
        <h2>Tickets</h2>
        <a href="index.php?currPage=createTicket">Neues Ticket anlegen!</a>
        <table class="table table-bordered table-striped">
            <thead> <!-- Table head -->
            <tr>

                <th scope="col">Betreff</th>
                <th scope="col">Ticketstatus</th>
                <th scope="col">Erstellt</th>

            </tr>
            </thead>
            <!-- Table content procedurally made from DB -->
            <tbody>

            <?php
            $allTickets = getAllTickets($conn);
            foreach ($allTickets as $ticket)
            {
                if($_SESSION["userid"] === $ticket["user_id"])
                {
                    echo '<tr>';
                    echo '<td><a href="index.php?currPage=ticket&id='. $ticket['id'] .'">'. $ticket['title'] .'</a></td>';
                 #   echo '<td>' . userUid_by_userId($conn, $ticket['user_id']) . '</td>';
                    echo '<td>' . $ticket['ticketStatus'] . '</td>';
                    echo '<td>' . $ticket['created'] . '</td>';

                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>


    </div>

    <?php
}
else
{
    echo '<p class="text-center">Unberechtigter Zugriff! Bitte anmelden oder Zugriffsrechte prüfen um Tickets zu sehen</p>';
}
?>




