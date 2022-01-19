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

function OnlyUidExists($conn, $username)
{
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailedOnlyUidExists");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_assoc($resultData))
    {
        return false;
    }
    else
    {
        return true;
    }

    mysqli_stmt_close($stmt);
}

function OnlyEmailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailedOnlyEmailExists");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_assoc($resultData))
    {
        return false;
    }
    else
    {
        return true;
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
            mysqli_stmt_close($stmt);
            header("location: ../index.php?error=none");
        }
        mysqli_stmt_close($stmt);

    }
    else{
        header("location: ../index.php?currPage=signup&error=userExists");
    }

}

function createUserByAdmin($conn, $anrede, $lastname, $firstname, $email, $username, $pwd, $typ, $status)
{
    $checkIfSame = uidExists($conn, $username, $email);
    if($checkIfSame === false){
        $sql = "INSERT INTO  users (usersAnrede, usersNachname, usersVorname, usersEmail, usersPassword, usersUid, usersTyp, usersStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"; 
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: ../index.php?currPage=create_user&error=stmtFailed");
            exit();
        }

        #Passwort wird gehashed
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssssssss", $anrede, $lastname, $firstname ,$email, $hashedPwd, $username, $typ, $status);
        
        if(mysqli_stmt_execute($stmt)){
            header("location: ../index.php?currPage=create_user&error=none");
        }
        mysqli_stmt_close($stmt);
        exit();    
    }
    else{
        header("location: ../index.php?currPage=create_user&error=userExists");
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
        $_SESSION["userid"  ] = $uidExists["usersId" ] ;
        $_SESSION["useruid" ] = $uidExists["usersUid"];
        $_SESSION["userRole"] = $uidExists["usersTyp"];
        header("location: ../index.php?login=success");
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

function getAllTickets($conn)
{
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, "SELECT * FROM tickets;"))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $resultTickets = mysqli_stmt_get_result($stmt);
    $allTickets = array();
    while($row = mysqli_fetch_assoc($resultTickets))
    {
        $ticket['id'            ] = $row["id"           ];
        $ticket['title'         ] = $row["title"        ];
        $ticket['img_path'      ] = $row["file_path"    ];
        $ticket['comment'       ] = $row["comment"      ];
        $ticket['user_id'       ] = $row["user_id"      ];
        $ticket['ticketStatus'  ] = $row["ticketStatus" ];
        $ticket['created'       ] = $row["created"      ];

        $allTickets[$ticket['id']] = $ticket;

    }

    mysqli_stmt_close($stmt);



    return $allTickets;
}

function userUid_by_userId($conn, $userId)
{
    $stmt = mysqli_stmt_init($conn);


    if(!mysqli_stmt_prepare($stmt, "SELECT usersUid FROM users WHERE usersId =" . $userId .";"))
    {
        header("location: ../index.php?currPage=edit_user&usersId=". $userId ."&error=stmtFaileduserUid_by_userId");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $result_userUid = mysqli_stmt_get_result($stmt);

    if($result_userUid === false )
    {
        return "unknown";
    }
    else
    {

        $row = mysqli_fetch_assoc($result_userUid);
        $userUid = $row["usersUid"];

    }
    mysqli_stmt_close($stmt);
    return $userUid;

}

function userEmail_by_userId($conn, $userId)
{
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, "SELECT usersEmail FROM users WHERE usersId =" . $userId .";"))
    {
        header("location: ../signup.php?error=stmtFaileduserEmail_by_userId");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $result_userEmail = mysqli_stmt_get_result($stmt);

    if($result_userEmail === false )
    {
        return "unknown";
    }
    else
    {

        $row = mysqli_fetch_assoc($result_userEmail);
        $userEmail = $row["usersEmail"];

    }
    mysqli_stmt_close($stmt);
    return $userEmail;

}


function editUserByAdmin($conn, $userId, $pwdChanged, $anrede, $lastname, $firstname, $email, $username, $pwd, $typ, $status)
{

    $sql = "UPDATE users SET usersAnrede = ?, usersNachname = ?, usersVorname = ?, usersEmail = ?, usersUid = ?, usersTyp = ?, usersStatus = ?
            WHERE usersId = $userId;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        // existingUsersId = userId check and change 
        header("location: ../edit_user.php?usersId=". $userId ."&error=stmtFailededitUserByAdmin");
        exit();
    }
    



    mysqli_stmt_bind_param($stmt, "sssssss", $anrede, $lastname, $firstname ,$email, $username, $typ, $status);
    
    if(mysqli_stmt_execute($stmt)){
        header("location: ../index.php?currPage=admin&error=none");
    }
    mysqli_stmt_close($stmt);
    //exit??
    if($pwdChanged){
        $sql = "UPDATE users SET usersPassword = ? WHERE usersId = $userId;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: ../index.php?currPage=edit_user&usersId=". $userId ."&error=stmtFailedPwd");
            exit();
        }
        #Passwort wird gehashed
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "s", $hashedPwd);

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            header("location: ../index.php?currPage=admin&error=none");
        }
        mysqli_stmt_close($stmt);
    }   
    exit();
}


function createTicket($conn, $filepath, $title, $comment, $userid, $ticketStatus)
{

    $sql = "INSERT INTO  tickets (file_path, title, comment, user_id, ticketStatus) VALUES ( ?, ?, ?, ?, ? );"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=createTicket&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $filepath, $title, $comment, $userid, $ticketStatus);
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("location: ../index.php?currPage=myTicket&error=none");
    }
    mysqli_stmt_close($stmt);

}

function updateTicket($conn,$status, $id)
{

    $sql = "UPDATE tickets SET ticketStatus = ? WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=ticket&id=" . "$id" ."&error=stmtFailedNoUpdate");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    if(!mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_close($stmt);
        header("location: ../index.php?currPage=ticket&id=" . "$id" . "&error=unsuccessfullUpdate");
    }

    mysqli_stmt_close($stmt);
    header("location: ../index.php?currPage=ticket&id=" . "$id" ."&error=noneSuccessfullyUpdated");
    exit();

}

/*

function createTicket($conn, $file_path, $title, $comment, $user_id)
{
    $sql = "INSERT INTO tickets(file_path, title, comment, user_id) VALUES (?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=profile&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssss",$file_path, $title,$comment, $user_id);

    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_close($stmt);
        header("location: ../index.php?currPage=profile&error=none");
    }

    mysqli_stmt_close($stmt);

}
*/

function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


function createNewsArticle($conn, $filepath, $newstitle, $article)
{

    $sql = "INSERT INTO  news (newsfile_path, newstitle, newsarticle) VALUES ( ?, ?, ? );"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=createNews&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $filepath, $newstitle, $article);
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("location: ../index.php?currPage=createNews&error=none");
    }
    mysqli_stmt_close($stmt);
    
}


function getNews($conn, $limit)
{
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT * FROM news ORDER BY newsdate desc LIMIT ? ;";
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: index.php?currPage=news&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $limit );

    mysqli_stmt_execute($stmt);

    $resultNews = mysqli_stmt_get_result($stmt);
    $limitedNews = array();
    while($row = mysqli_fetch_assoc($resultNews))
    {
        $news['id'          ] = $row["newsid"       ];
        $news['img_path'    ] = $row["newsfile_path"];
        $news['title'       ] = $row["newstitle"    ];
        $news['article'     ] = $row["newsarticle"  ];
        $news['date'        ] = $row["newsdate"     ];
  

        $limitedNews[$news['id']] = $news;

    }

    mysqli_stmt_close($stmt);

    return $limitedNews;
}


function updateNames($conn, $userId,  $lastname, $firstname)
{

    $sql = "UPDATE users SET usersNachname = ?, usersVorname = ? WHERE usersId = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=profile&error=stmtFailedUpdNames");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss",  $lastname, $firstname, $userId);
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("location: ../index.php?currPage=profile&nameChangeSuccess");
    }
    mysqli_stmt_close($stmt);
}

function updateEmail($conn, $userId,  $email)
{

    $sql = "UPDATE users SET usersEmail = ? WHERE usersId = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=profile&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss",  $email, $userId);
    
    if(mysqli_stmt_execute($stmt)){
        header("location: ../index.php?currPage=profile&success");
    }
    mysqli_stmt_close($stmt);
}


function updateUsername($conn, $userId,  $username)
{

    $sql = "UPDATE users SET usersUid = ? WHERE usersId = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=profile&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss",  $username, $userId);
    
    if(mysqli_stmt_execute($stmt)){
        header("location: ../index.php?currPage=profile&success");
    }
    mysqli_stmt_close($stmt);
}

function userFirstName_by_userId($conn, $userId)
{
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, "SELECT usersVorname FROM users WHERE usersId =" . $userId .";"))
    {
        header("location: .../index.php?currPage=profile&error=stmtFailedFirstname");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $result_userFirstname = mysqli_stmt_get_result($stmt);

    if($result_userFirstname === false ){
        return "unknown";
    }
    else{
        $row = mysqli_fetch_assoc($result_userFirstname);
        $firstname = $row["usersVorname"];
    }
    mysqli_stmt_close($stmt);
    return $firstname;
}

function userLastName_by_userId($conn, $userId)
{
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, "SELECT usersNachname FROM users WHERE usersId =" . $userId .";"))
    {
        header("location: .../index.php?currPage=profile&error=stmtFailedFirstname");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $result_userLastname = mysqli_stmt_get_result($stmt);

    if($result_userLastname === false ){
        return "unknown";
    }
    else{
        $row = mysqli_fetch_assoc($result_userLastname);
        $lastname = $row["usersNachname"];
    }
    mysqli_stmt_close($stmt);
    return $lastname;
}