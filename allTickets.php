<?php

// Shows all tickets only accessible by servicetechs and admins

include_once "include/dbaccess.inc.php";
include_once "include/functions.inc.php";

if(isset($_SESSION["userid"]) )
{
    if($serviceTech || $admin)
    {
?>
        <div class="PageWrap">

            <h2>Tickets</h2>
            <div class="PageContent">

                <table class="table table-bordered table-striped">
                    <thead> <!-- Table head -->
                    <tr>

                        <th scope="col">Betreff</th>
                        <th scope="col">
                            Ticketstatus
                            <?php if($serviceTech) { ?>
                            <form action="index.php" method="GET">
                                <input type="hidden" name="currPage" value="allTickets">
                                <select name="filter" size="1">
                                    <option value='none'                  <?php if(!isset($_GET["filter"]) || (isset($_GET["filter"]) &&  $_GET["filter"] === 'none' )) echo " selected"; ?> >                     </option>
                                    <option value='open'                  <?php if( isset($_GET["filter"]) &&  $_GET["filter"] === 'open'                              ) echo " selected"; ?> >open                 </option>
                                    <option value='successfullyclosed'    <?php if( isset($_GET["filter"]) &&  $_GET["filter"] === 'successfullyclosed'                ) echo " selected"; ?> >successfully closed  </option>
                                    <option value='unsuccessfullyclosed'  <?php if( isset($_GET["filter"]) &&  $_GET["filter"] === 'unsuccessfullyclosed'              ) echo " selected"; ?> >unsuccessfully closed</option>
                                </select>
                            <button type="submit">filtern</button>
                            </form>
                            <?php } ?>
                        </th>
                        <th scope="col">Erstellt</th>
                     <!--   <th scope="col">Bearbeiten</th> -->

                    </tr>
                    </thead>
                    <!-- Table content procedurally made from DB -->
                    <tbody>

                    <?php
                    $filter = "none";
                    if($serviceTech)
                    {
                        if( isset($_GET["filter"]) )
                        {
                            switch ($_GET["filter"])
                            {
                                case 'open'                : $filter = "open"                 ; break;
                                case 'successfullyclosed'  : $filter = "successfully closed"  ; break;
                                case 'unsuccessfullyclosed': $filter = "unsuccessfully closed"; break;
                            }
                        }
                    }

                    $allTickets = getAllTickets($conn);
                    foreach($allTickets as $ticket)
                    {
                        if($filter==="none" || $filter===$ticket['ticketStatus'])
                        {
                            echo '<tr>';
                            echo '<td><a href="index.php?currPage=ticket&id=' . $ticket['id'] . '">' . $ticket['title'] . '</a></td>';
                            echo '<td>' . $ticket['ticketStatus'] . '</td>';
                            echo '<td>' . $ticket['created'] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>

                    </tbody>
                </table>


            </div>


        </div>


<?php
    }
else
{
    echo '<p class="text-center">Unberechtigter Zugriff. Bitte anmelden oder Zugriffsrechte prüfen.</p>';
}

}
?>