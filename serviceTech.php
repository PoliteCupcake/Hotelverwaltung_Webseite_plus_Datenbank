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
                <th scope="col">Username</th>
                <th scope="col">Vorname, Nachname</th>
                <th scope="col">Rolle</th>
                <th scope="col">Aktionen</th>
            </tr>
            </thead>
            <!-- Table content procedurally made from DB -->
            <tbody>

            <?php
            $allTickets = getAllTickets($conn);
            foreach($allTickets as $ticket)
            {
                echo '<tr>';
                echo '<td>'. $user['username'] .'</td>';
                echo '<td>'. $user['firstname'] . ' ' . $user['lastname'] .'</td>';
                echo '<td>'. $user['role'] .'</td>';
                echo '<td>[ <a href="edit_user.php?usersId='. $user['usersId'] .'">bearbeiten</a> ]</td>';
                echo '</tr>';
            }
            ?>

            </tbody>
        </table>


    </div>


</div>
