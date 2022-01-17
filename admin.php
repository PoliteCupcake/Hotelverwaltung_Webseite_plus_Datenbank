<?php


?>

<div class="PageWrap">
    <h1>Admin</h1>
    <p>ACHTUNG! Einige Änderungen die auf dieser Seite vorgenommen werden haben eventuell Folgen für die Benutzer!</p>
    <div class="PageContent">
        <h2>Neuen User anlegen</h2>
        <?php include_once "signup.php"; ?>
    </div>
    <div class="PageContent">
        <h2>Usertyp: Gast</h2>
        <table class="table table-bordered table-dark">
            <thead> <!-- Table head -->
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <!-- Table content procedurally made from DB -->
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><a href="#">Bearbeiten</a></td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><a href="#">Bearbeiten</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="PageContent">
        <h2>Usertyp: Servicetechniker</h2>
        <table class="table table-striped table-dark">
            <thead> <!-- Table head -->
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-Mail</th>
                </tr>
            </thead>
            <!-- Table content procedurally made from DB -->
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>