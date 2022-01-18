<?php

#Zeigt Details der Tickets an

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";

if(isset($_SESSION["userid"]) )
{
    if($_SESSION["userRole"] === "serviceTech" || $_SESSION["userRole"] === "admin")   #zeigt alle tickets an Titel Status Datum
    {
?>
        <div class="PageWrap">

            <h2>Tickets</h2>
            <div class="PageContent">

                <table class="table table-bordered table-dark">
                    <thead> <!-- Table head -->
                    <tr>

                        <th scope="col">Betreff</th>
                        <th scope="col">Ticketstatus</th>
                        <th scope="col">Erstellt</th>
                        <th scope="col">Bearbeiten</th>

                    </tr>
                    </thead>
                    <!-- Table content procedurally made from DB -->
                    <tbody>

                    <?php
                    $allTickets = getAllTickets($conn);
                    foreach($allTickets as $ticket)
                    {
                        echo '<tr>';
                        echo '<td>'. $ticket['title'] .'</td>';
                        echo '<td>'. $ticket['ticketStatus'] .'</td>';
                        echo '<td>'. $ticket['created'] .'</td>';

                        echo '<td>[ <a href="edit_user.php?user_id='. $ticket['user_id'] .'">bearbeiten</a> ]</td>';
                        echo '</tr>';

                    }
                    ?>

                    </tbody>
                </table>


            </div>


        </div>








<?php
    }
    else
    {
        echo "<p>Error</p>";
    }
}
?>
