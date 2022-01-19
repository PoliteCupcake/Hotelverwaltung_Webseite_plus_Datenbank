
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
                <form action="index.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="Vorname">Neuer Vorname: </label>
                        <input class="col-md-6" type="text" name="Vorname">                        
                    </div>
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="Nachname">Neuer Nachname: </label>
                        <input class="col-md-6" type="text" name="Nachname">                        
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
                <form action="index.php" method="post">
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

        <p class="border-top mt-3">Adresse:</p>
        <div class="collapse" id="ChangeAdress">
            <div class="card card-body">
                <div>
                <form action="index.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="Strasse">Straße: </label>
                        <input class="col-md-6" type="text" name="Strasse">                        
                    </div>
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="Ort">Ort: </label>
                        <input class="col-md-6" type="text" name="Ort">                        
                    </div>
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="Plz">Plz: </label>
                        <input class="col-md-6" type="text" name="Plz">                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm" name="ChangeAdress" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangeAdressClose" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangeAdress" aria-expanded="false" aria-controls="collapseExample">Schließen</button>                        
                    </div>
                </form>
                </div>
            </div>
        </div>    
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangeAdress" role="button">Bearbeiten</a>
        
        <p class="border-top mt-3">Passwort ändern...</p>
        <div class="collapse" id="ChangePassword">
            <div class="card card-body">
                <div>
                <form action="index.php" method="post">
                    <div class="container row pb-2">
                        <label class="col-md-4 text-md-end" for="Password">Neues Passwort: </label>
                        <input class="col-md-6" type="password" name="Passwort">                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm" name="ChangePassword" type="submit">Ändern</button>
                        <button class="btn btn-secondary btn-sm" name="ChangePasswordClose" type="reset" data-bs-toggle="collapse" data-bs-target="#ChangePassword" aria-expanded="false" aria-controls="collapseExample">Schließen</button>                        
                    </div>
                </form>
                </div>
            </div>
        </div>
        <a class="nav-link" data-bs-toggle="collapse" href="#ChangePassword" role="button">Bearbeiten</a>

    </div>
    
</div>