<?php
   include_once "include/dbaccess.inc.php";
   include_once "include/functions.inc.php";
?>

<div class="PageWrap">

    <h1>Admin</h1>

    <p>ACHTUNG! Einige Änderungen die auf dieser Seite vorgenommen werden haben eventuell Folgen für die Benutzer!</p>
    <a href="index.php?currPage=create_user">Neuen User erstellen!</a>     
<!--    <div class="PageContent">
        <h2>Neuen User anlegen</h2>
    </div> -->

    <div class="PageContent">
        <h2>Liste aller registrierten User*innen</h2>
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
                 $allUsers = getAllUsers($conn);
		 foreach($allUsers as $user)
                 {
                    echo '<tr>';
                    echo '<td>'. $user['username'] .'</td>';
                    echo '<td>'. $user['firstname'] . ' ' . $user['lastname'] .'</td>';
                    echo '<td>'. $user['role'] .'</td>';
                    echo '<td>[ <a href="index.php?currPage=edit_user&usersId='. $user['usersId'] .'">bearbeiten</a> ]</td>';
                    echo '</tr>';
                 }
              ?>

            </tbody>
        </table>

    </div>


</div>