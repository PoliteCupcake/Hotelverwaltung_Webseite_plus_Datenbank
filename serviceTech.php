<?php
include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";
?>

<div class="PageWrap">

    <h2>Tickets</h2>
    <div class="PageContent">

        <table class="table table-bordered table-dark">
            <thead> <!-- Table head -->
            <tr>
                <th scope="col">Tickenummer</th>
                <th scope="col">Betreff</th>
                <th scope="col">Bild</th>
                <th scope="col">Text</th>
                <th scope="col">Erstellt von</th>
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
                echo '<td>'. $ticket['id'] .'</td>';
                echo '<td>[ <a href="index.php?currPage=ticket&id='. $ticket['id'] .'">'. $ticket['title'] .'</a> ]</td>';
                echo '<td><img src="./' . $ticket['img_path'] . '" height=30></td>';
                echo '<td>'. $ticket['comment'] .'</td>';
                echo '<td>'. userUid_by_userId($conn,$ticket['user_id']) .'</td>';
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
