<?php

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, "SELECT * FROM tickets WHERE id = " . $_GET['id'] . ";"))
{
    header("location: index.php?currPage=allTickets?error=ticketError");
    exit();
}

mysqli_stmt_execute($stmt);

$resultTicket = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($resultTicket);

$ticket['id'            ] = $row["id"           ];
$ticket['title'         ] = $row["title"        ];
$ticket['img_path'      ] = $row["file_path"    ];
$ticket['comment'       ] = $row["comment"      ];
$ticket['user_id'       ] = $row["user_id"      ];
$ticket['ticketStatus'  ] = $row["ticketStatus" ];
$ticket['created'       ] = $row["created"      ];

mysqli_stmt_close($stmt);

$user_name = userUid_by_userId($conn, $ticket['user_id']);


if($serviceTech || $admin || ($guest && $ticket['user_id'] === $_SESSION['userid']))
{
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


                            <?php
                            if($serviceTech)
                            {
                                ?>

                                <th scope="col">Update</th>

                            <?php

                            }
                            elseif(($guest || $admin) && ($ticket['ticketStatus'] !== "open" ))
                            {
                                ?>
                                <th scope="col">Ticket wieder öffnen</th>
                            <?php
                            }
                            ?>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $user_name; ?></td>
                            <td><?php echo $ticket['created']; ?></td>



                                <?php

                                if($serviceTech)
                                {
                                ?>
                                    <td>
                                    <form action="include/updateTicket.inc.php" method="POST">
                                        <input type ="hidden" name="id" value=<?php echo $ticket['id']; ?>>
                                        <select name="status" size="1">

                                            <option value='open'
                                                <?php

                                                if($ticket['ticketStatus'] === 'open')
                                                {
                                                    echo "  selected";
                                                }
                                                ?>
                                            >open</option>

                                            <option value='successfully closed'
                                                <?php
                                                if($ticket['ticketStatus'] === 'successfully closed')
                                                {
                                                    echo "  selected";
                                                }
                                                ?>
                                            >successfully closed</option>

                                            <option value='unsuccessfully closed'
                                                <?php
                                                if($ticket['ticketStatus'] === 'unsuccessfully closed')
                                                {
                                                    echo "  selected";
                                                }
                                                ?>
                                            >unsuccessfully closed</option>

                                        </select>
                                    </form>
                                    </td>

                                        <td><button type="submit" name="submit">update</button></td>


                                <?php
                                }
                                else if(($guest || $admin) && ($ticket['ticketStatus'] !== 'open'))
                                {
                                    ?>
                                    <td><?php echo $ticket['ticketStatus']; ?></td>

                                    <td>
                                    <form action="include/updateTicket.inc.php" method="POST">
                                        <input type ="hidden" name="id" value=<?php echo $ticket['id']; ?>>
                                        <input type ="hidden" name="status" value="open">

                                        <button type="submit" name="submit">Bestätigen</button>

                                    </form>
                                    </td>

                                <?php
                                }
                                else
                                {
                                    ?>
                                    <td> <?php echo $ticket['ticketStatus'];?> </td>
                                <?php
                                }
                                ?>


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

<?php
}
?>



