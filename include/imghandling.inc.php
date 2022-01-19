<?php

function createTicket($conn, $filepath, $title, $comment, $userid, $ticketStatus)
{

    $sql = "INSERT INTO  tickets (id, file_path, title, comment, user_id, ticketStatus) VALUES (?, ?, ?, ?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?currPage=createTicket&error=stmtFailed");
        exit();
    }

    #Passwort wird gehashed
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($conn, "ssssss", $filepath, $title, $comment, $userid, $ticketStatus);
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("location: ../index.php?currPage=myTicket&error=none");
    }
    mysqli_stmt_close($stmt);
    
}