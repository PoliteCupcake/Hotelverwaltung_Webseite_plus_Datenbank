<?php
// Sign up checks and value setting--------------------------------------------------
// ----------------------------------------------------------------------------------
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

function pwdMatch($pwd, $pwdRepeat)
{
    $result;
    if($pwd === $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function SetValue($input, $error){
    if($error == ""){
        echo $input;
    }
    else{
        echo $input = "";
    }
}

function signUpError($inputArr, $ErrorArr){
    foreach($inputArr as $input){
        if($ErrorArr[$input] != ""){
            return true;
        }
    }
}

// Server functions signup page -----------------------------------------------------
// ----------------------------------------------------------------------------------
function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return  $row;
    }
    else
    {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function createUser($conn, $anrede, $lastname, $firstname, $email, $username, $pwd, $typ, $status)
{
    $checkIfSame = uidExists($conn, $username, $email);
    if($checkIfSame === false){
        $sql = "INSERT INTO  users (usersAnrede, usersNachname, usersVorname, usersEmail, usersPassword, usersUid, usersTyp, usersStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"; 
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: ../index.php?currPage=signup&error=stmtFailed");
            exit();
        }

        #Passwort wird gehashed
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssssssss", $anrede, $lastname, $firstname ,$email, $hashedPwd, $username, $typ, $status);
        
        if(mysqli_stmt_execute($stmt)){
            header("location: ../index.php?error=none");
        }
        mysqli_stmt_close($stmt);
        exit();    
    }
    else{
        header("location: ../index.php?currPage=signup&error=userExists");
    }

}

// Login function  ------------------------------------------------------------------
// ----------------------------------------------------------------------------------

function emptyInputLogin($username, $pwd)
{
    $result;

    if(empty($username) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}


function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);




    if($uidExists === false)
    {
        header("location: ../index.php?currPage=loginNew&error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPassword"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($uidExists['usersStatus'] == 'active')
    {
        $checkActive = true;
    }
    else
    {
        $checkActive = false;
    }



    if($checkPwd === false)
    {
        header("location: ../index.php?currPage=loginNew&error=wronglogin");
        exit();
    }
    else if($checkActive !== true)
    {
        header('location: ../index.php?currPage=loginNew&error=inactive');
        exit();
    }
    else if($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"] ;
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
       
    }
}


function getAllUsers($conn)
{
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, "SELECT * FROM users;"))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }
    
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
  /* fetch associative array */
  $allUsers = array();
  while ($row = mysqli_fetch_assoc($resultData))
  {
     $user['usersId'  ] = $row["usersId"      ];
     $user['anrede'   ] = $row["usersAnrede"  ];
     $user['lastname' ] = $row["usersNachname"];
     $user['firstname'] = $row["usersVorname" ];
     $user['email'    ] = $row["usersEmail"   ];
     $user['pwd'      ] = $row["usersPassword"];
     $user['username' ] = $row["usersUid"     ];
     $user['role'     ] = $row["usersTyp"     ];
     $user['status'   ] = $row["usersStatus"  ];
     
     $allUsers[$user['usersId']] = $user;
  }

    mysqli_stmt_close($stmt);

    return $allUsers;
}




