<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/style.css" type="text/css">
        <title>Hotel Website</title>
        <link rel="icon" href="images/Hotel__Logo_transparent.png">
    </head>

    <body>
        
        <?php

            // check input for errors, whitespaces, slashes and change html-entities to strings 
            function checkInput($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            function checkForAlph($input){
                return preg_match("/^[a-zA-Z]*$/", $input) ? "" : "Nur Buchstaben!";
            }
            function checkForNum($input){
                return preg_match("/^[0-9]*$/", $input) ? "" : "Nur Zahlen!";
            }
            function checkForAlphNum($input){
                return preg_match("/^[a-zA-Z0-9]*$/", $input) ? "" : "Keine Sonderzeichen!";
            }
            function checkEmail($input){
                return filter_var($input, FILTER_VALIDATE_EMAIL) ? "" : "Adresse ungültig!";
            }

            // initialising variables and arrays
            $UserInputs = array("User_Anrede", "User_Lastname", "User_Firstname", "User_Email", "User_Uid", "User_Password");
            $inputAlph = array("User_Lastname", "User_Firstname");
            $Errors = array();
            $UserData = array();
            // filling arrays with empty strings
            foreach($UserInputs as $input){
               $UserData[$input] = "";
               $Errors[$input] = ""; 
            } 
            
            
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                foreach($UserInputs as $input){
                    $UserData[$input] = checkInput($_POST[$input]);

                    if($UserData[$input] == ""){
                        $Errors[$input] = 'Bitte ausfüllen!'; 
                    }
                }
                foreach($inputAlph as $input){
                    $Errors[$input] = checkForAlph($UserData[$input]);
                }
                
                $Errors["User_Email"] = checkEmail($UserData["User_Email"]);
                /*
                $Errors["User_Plz"] = checkForNum($UserData["User_Plz"]);
                $Errors["User_Hausnummer"] = checkForAlphNum($UserData["User_Hausnummer"]); 
                */
                foreach($UserInputs as $input){
                    if($UserData[$input] == ""){
                        $Errors[$input] = 'Bitte ausfüllen!'; 
                    }
                }
            }
            // Visual Error indication
            function ErrorCoat($error){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if($error == ""){
                        echo 'bg-success bg-gradient';
                    }
                    else{
                        echo 'bg-danger bg-gradient';
                    }
                }                    
            }

            // sets or resets the UserData input and value of html tag
            function SetValue($input, $error){
                if($error == ""){
                    echo $input;
                }
                else{
                    echo $input = "";
                }
            }
        
        
        ?>
        <div class="PageWrap">
            <h1>Registrierungsform</h1>
            <p>Bitte füllen Sie alle Felder aus die mit (*) markiert sind</p>
         
            <div class="PageContent">
                <form id="registryForm" class="" action="User_Registry.php" method="post">
                <div id="OrderForms" class="container">
                    <div class="row">
                        <div class="col <?php ErrorCoat($Errors["User_Email"])?>">
                            <label for="User_Email">E-Mail*: </label>
                            <input type="email" name="User_Email" id="User_Email" placeholder="<?php echo $Errors["User_Email"]; ?>" value="<?php SetValue($UserData["User_Email"], $Errors["User_Email"]) ?>">  
                        </div>

                        <div class="col">
                            <label for="Anrede">Anrede: </label>
                            <select name="User_Anrede" id="User_Anrede">
                                <option selected name="User_Anrede" value="">Keine Angabe</option>
                                <option name="User_Anrede" value="Herr">Herr</option>
                                <option name="User_Anrede" value="Frau">Frau</option>
                                <option name="User_Anrede" value="Enby">Enby</option> 
                            </select>                
                        </div>
                    </div>

                    <div class="row">         
                        <div class="col <?php ErrorCoat($Errors["User_Vorname"])?>">
                            <label for="User_Vorname">Vorname*: </label>
                            <input type="text" name="User_Vorname" placeholder="<?php echo $Errors["User_Vorname"]; ?>" value="<?php SetValue($UserData["User_Vorname"], $Errors["User_Vorname"]) ?>">
                        </div>

                        <div class="col <?php ErrorCoat($Errors["User_Nachname"])?>">
                            <label for="User_Lastname">Nachname*: </label>
                            <input type="text" name="User_Lastname" id="User_Lastname" placeholder="<?php echo $Errors["User_Lastname"]; ?>" value="<?php SetValue($UserData["User_Lastname"], $Errors["User_Lastname"]) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col <?php ErrorCoat($Errors["User_Plz"])?>">
                            <label for="User_Plz">PLZ*: </label>
                            <input type="text" name="User_Plz" id="User_Plz" placeholder="<?php echo $Errors["User_Plz"]; ?>" value="<?php SetValue($UserData["User_Plz"], $Errors["User_Plz"]) ?>">
                        </div>

                        <div class="col <?php ErrorCoat($Errors["User_Ort"])?>">
                            <label  for="User_Ort" >Ort*: </label>
                            <input type="text" name="User_Ort" id="User_Ort" placeholder="<?php echo $Errors["User_Ort"]; ?>" value="<?php SetValue($UserData["User_Ort"], $Errors["User_Ort"]) ?>">        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col <?php ErrorCoat($Errors["User_Strasse"])?>">
                            <label for="User_Strasse">Straße*: </label>
                            <input type="text" name="User_Strasse" id="User_Strasse" placeholder="<?php echo $Errors["User_Strasse"]; ?>" value="<?php SetValue($UserData["User_Strasse"], $Errors["User_Strasse"]) ?>">
                        </div>

                        <div class="col <?php ErrorCoat($Errors["User_Hausnummer"])?>">
                            <label for="User_Hausnummer">Hausnummer*: </label>
                            <input type="text" name="User_Hausnummer" id="User_Hausnummer" placeholder="<?php echo $Errors["User_Hausnummer"]; ?>" value="<?php SetValue($UserData["User_Hausnummer"], $Errors["User_Hausnummer"]) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col <?php ErrorCoat($Errors["User_Strasse"])?>">
                            <label for="User_Strasse">Passwort*: </label>
                            <input type="password" name="User_Passwort" id="User_Passwort" placeholder="<?php // echo $Errors["User_Passwort"]; ?>">
                        </div>

                        <div class="col <?php ErrorCoat($Errors["User_Hausnummer"])?>">
                            <label for="User_Hausnummer">Passwort wiederholen*: </label>
                            <input type="text" name="User_Passwort_wieder" id="User_Passwort_wieder" placeholder="<?php // echo $Errors["User_Passwort_wieder"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button class="wd-100" name="RegistryPost" type="submit">Registrieren...</button>
                        </div>

                </div> 
                </div>
                    
                </form>
            </div>
            
            </div>

        <?php 
            include 'footer.php'
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>