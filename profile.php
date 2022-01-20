
<?php



if(!isset($_SESSION)){
    session_start();
}


// check user role closed at the end of the page
if($guest || $serviceTech || $admin){

    $usersId = $_SESSION["userid"];

    include_once "include/dbaccess.inc.php";
    include_once "include/functions.inc.php";
?>

<div class="PageWrap">
    <h1>Profil</h1>
    <div class="PageContent">
        <h2>Persönliche Daten</h2>
        <p class="border-top mt-3">Name: <?php echo userFirstName_by_userId($conn, $usersId)." ".userLastName_by_userId($conn, $usersId); ?> </p>
        <div class="collapse" id="ChangeName">
            <div class="card card-body">
                <div>
                <form action="include/editProfileName.inc.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeFirstname">Neuer Vorname: </label>
                        <input class="col-md-6" type="text" name="ChangeFirstname">                        
                    </div>
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeLastname">Neuer Nachname: </label>
                        <input class="col-md-6" type="text" name="ChangeLastname">                        
                    </div>
                    <div class="text-end"> 
                        <button class="btn btn-primary btn-sm" name="ChangeNameSubmit" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeNameClose" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeName" aria-expanded="false" aria-controls="collapseExample">Schließen</button>
                    </div>                   
                </form>
                </div>
            </div>
        </div>
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeName" role="button">Bearbeiten</a>

        <p class="border-top mt-3">E-Mail: <?php echo userEmail_by_userId($conn, $usersId); ?> </p>
        <div class="collapse" id="ChangeEmail">
            <div class="card card-body">
                <div>
                <form action="include/editProfileEmail.inc.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeEmail">Neue E-Mail: </label>
                        <input class="col-md-6" type="text" name="ChangeEmail">                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm" name="ChangeEmailSubmit" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeEmailClose" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeEmail" aria-expanded="false" aria-controls="collapseExample">Schließen</button>                        
                    </div>
                </form>
                </div>
            </div>
        </div>
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeEmail" role="button">Bearbeiten</a>

        <p class="border-top mt-3">Benutzername: <?php echo userUid_by_userId($conn, $usersId); ?> </p>
        <div class="collapse" id="ChangeUsername">
            <div class="card card-body">
                <div>
                <form action="include/editProfileUsername.inc.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeUsername">Neuer Benutzername: </label>
                        <input class="col-md-6" type="text" name="ChangeUsername">                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm" name="ChangeUsernameSubmit" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeUsername" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeUsername" aria-expanded="false" aria-controls="collapseExample">Schließen</button>                        
                    </div>
                </form>
                </div>
            </div>
        </div>    
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeUsername" role="button">Bearbeiten</a>
    </div> 
</div>
<?php 
}
else
{
    echo '<p>Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}
?>