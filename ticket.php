<?php

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";

//Error handling for id and Role check
//Displays ticket detail
//Guest: sees own tickets can reopen them
//Servicetech: can change to status, replies
//Admin: can reopen tickets

if (isset($_GET['id']) && ticketIdexists($conn,$_GET['id']))
    {

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, "SELECT * FROM tickets WHERE id = " . $_GET['id'] . ";")) {
        header("location: index.php?currPage=allTickets?error=ticketError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultTicket = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultTicket);

    $ticket['id'] = $row["id"];
    $ticket['title'] = $row["title"];
    $ticket['img_path'] = $row["file_path"];
    $ticket['comment'] = $row["comment"];
    $ticket['user_id'] = $row["user_id"];
    $ticket['ticketStatus'] = $row["ticketStatus"];
    $ticket['created'] = $row["created"];

    mysqli_stmt_close($stmt);

if($serviceTech || $admin || ($guest && $ticket['user_id'] === $_SESSION['userid']))
{
    $user_name = userUid_by_userId($conn, $ticket['user_id']);
?>
    <div class="PageWrap">
        <h2><?php echo $ticket['title']; ?> </h2>
        <div class="PageContent">
            <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Erstellt von</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Status</th>
                            <?php if($serviceTech) { ?>
                                <th scope="col">Update</th>
                            <?php } elseif(($guest || $admin) && ($ticket['ticketStatus'] !== "open" )) { ?>
                                <th scope="col">Ticket wieder öffnen</th>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $ticket['created']; ?></td>
                            <?php if($serviceTech) { ?>
                                <td>
                                    <form action="include/updateTicket.inc.php" method="POST">
                                        <input type ="hidden" name="id" value=<?php echo $ticket['id']; ?>>
                                            <select name="status" size="1">
                                                <option value='open'                  <?php if($ticket['ticketStatus'] === 'open'                 ) echo " selected"; ?> >open                 </option>
                                                <option value='successfully closed'   <?php if($ticket['ticketStatus'] === 'successfully closed'  ) echo " selected"; ?> >successfully closed  </option>
                                                <option value='unsuccessfully closed' <?php if($ticket['ticketStatus'] === 'unsuccessfully closed') echo " selected"; ?> >unsuccessfully closed</option>
                                            </select>
                                </td>
                                <td>
                                        <button type="submit" name="submit">update</button>
                                    </form>
                                </td>
                            <?php } else if(($guest || $admin) && ($ticket['ticketStatus'] !== 'open')) { ?>
                                <td><?php echo $ticket['ticketStatus']; ?></td>
                                <td>
                                    <form action="include/updateTicket.inc.php" method="POST">
                                        <input type ="hidden" name="id" value=<?php echo $ticket['id']; ?>>
                                        <input type ="hidden" name="status" value="open">
                                        <button type="submit" name="submit">Bestätigen</button>
                                    </form>
                                </td>
                            <?php } else { ?>
                                <td><?php echo $ticket['ticketStatus'];?></td>
                            <?php } ?>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="PageContent">
            <img src="<?php echo $ticket['img_path']; ?>" class="img-fluid">
        </div>
        <div class="PageContent">
            <div class="col"><?php echo $ticket['comment']; ?></div>
        </div>
    </div>
    <div class="PageWrap">
        <h2>Antworten auf dieses Ticket</h2>
        <?php
            $allReplies = getTicketReplies($conn, $ticket['id']);
            if(!$allReplies)
            {
                echo '<div class="PageContent"><p>Bisher keine Antworten.</p></div>';
            }
            else
            {
                foreach ($allReplies as $reply)
                {
                    echo '<div class="PageContent">';
                    echo '<p>' . $reply["reply"] . '</p>';
                    echo '<p><i>geschrieben am:</i> ' . $reply["created"] . '</p>';
                    echo '</div>';
                }
            }
        ?>
    </div>

<?php if($serviceTech) { ?>
<div class="PageWrap">
    <h2>Auf dieses Ticket antworten?</h2>
    <div class="PageContent">
        <form action="include/createReply.inc.php" method="post">
            <div class="mb-3">
                <label for="reply" class="form-label">Antwort schreiben:</label>
                <textarea class="form-control" name="reply" id="reply" rows="5"></textarea>
            </div>
            <input type="hidden" id="ticketId" name="ticketId" value="<?php echo $ticket['id'] ?>">
            <p><button type="submit" name="submit">Antwort senden</button></p>
        </form>
    </div>
</div>
<?php } } else { ?>
    <p class="text-center">Unberechtigter Zugriff! Bitte anmelden oder Zugriffsrechte prüfen um Tickets zu sehen</p>
<?php }
    }
    else
    {
      echo '<p class="text-center">Ticket wurde in der Datenbank nicht gefunden</p>';
    }


?>

