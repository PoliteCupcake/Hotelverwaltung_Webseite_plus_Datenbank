<?php

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";
/*
Rolle: Anon kann diese seite nicht erreichen;
Rolle: Guest sieht eigene Tickets;
Rolle: service alle Ticket (inkl. eigene);
Rolle: Admin alle Ticket (inkl. eigene);
*/
?>

<?php
#session_start();
if(isset($_SESSION["userid"])  )
{
    ?>

    <div class="PageContent">
        <h2>Tickets</h2>

        <table class="table table-bordered table-dark">
            <thead> <!-- Table head -->
            <tr>

                <th scope="col">Betreff</th>
                <th scope="col">Erstellt von</th>
                <th scope="col">Ticketstatus</th>

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
                    echo '<td>' . $ticket['title'] . '</td>';
                    echo '<td>' . userUid_by_userId($conn, $ticket['user_id']) . '</td>';
                    echo '<td>' . $ticket['ticketStatus'] . '</td>';
                    #   echo '<td>[ <a href="edit_user.php?user_id='. $ticket['user_id'] .'">bearbeiten</a> ]</td>';
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
    echo "<p>Error</p>";
}
?>




