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

if($serviceTech || $admin || $guest)
{
?>
    <div class="PageWrap">

        <h2><?php echo $ticket['title']; ?> </h2>
        <div class="PageContent">

            <?php echo $ticket['comment']; ?>
            <?php echo $ticket['img_path']; ?>
            <?php echo $ticket['created']; ?>



        </div>
    </div>

<?php
}
?>



