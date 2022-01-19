
<?php
include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";
?>

<div class="PageWrap">
    <h1>Profil</h1>

    <div class="PageContent">
        <h2>Persönliche Daten</h2>
        <p class="border-top mt-3">Name:</p>
        <div class="collapse" id="ChangeName">
            <div class="card card-body">
                <div>
                <form action="include/editProfile.inc.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeFirstname">Neuer Vorname: </label>
                        <input class="col-md-6" type="text" name="ChangeFirstname">                        
                    </div>
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeLastname">Neuer Nachname: </label>
                        <input class="col-md-6" type="text" name="ChangeLastname">                        
                    </div>
                    <div class="text-end"> 
                        <button class="btn btn-primary btn-sm" name="ChangeName" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeNameClose" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeName" aria-expanded="false" aria-controls="collapseExample">Schließen</button>
                    </div>                   
                </form>
                </div>
            </div>
        </div>
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeName" role="button">Bearbeiten</a>

        <p class="border-top mt-3">E-Mail:</p>
        <div class="collapse" id="ChangeEmail">
            <div class="card card-body">
                <div>
                <form action="include/editProfile.inc.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="email">Neue E-Mail: </label>
                        <input class="col-md-6" type="text" name="email">                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm" name="ChangeEmail" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeEmailClose" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeEmail" aria-expanded="false" aria-controls="collapseExample">Schließen</button>                        
                    </div>
                </form>
                </div>
            </div>
        </div>
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeEmail" role="button">Bearbeiten</a>

        <p class="border-top mt-3">Benutzername:</p>
        <div class="collapse" id="ChangeUsername">
            <div class="card card-body">
                <div>
                <form action="include/editProfile.inc.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="ChangeUsername">Neuer Benutzername: </label>
                        <input class="col-md-6" type="text" name="ChangeUsername">                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm" name="ChangeUsername" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeUsername" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeUsername" aria-expanded="false" aria-controls="collapseExample">Schließen</button>                        
                    </div>
                </form>
                </div>
            </div>
        </div>    
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeUsername" role="button">Bearbeiten</a>
    </div>
    
</div>