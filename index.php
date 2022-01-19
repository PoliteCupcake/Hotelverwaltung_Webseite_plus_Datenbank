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
        include_once 'header.php';

        // Login status if else 
        // echos content of the current page
        if(isset($_GET["currPage"])){
            switch($_GET["currPage"]){
                case "home": include "news.php";
                    break;
                case "news": include "news.php";
                    break;
                case "impressum": include "impressum.php";
                    break;
                case "help": include "help.php";
                    break;
                case "signup": include "signup.php";
                    break;
                case "profile": include 'profile.php';
                    break;
                //DO NOT leave that in 
                case "admin": include "admin.php";
                    break;
                case "loginNew": include "loginNew.php";
                    break;
                case "createUser": include "createUser.php";
                    break;
                case "edit_user": include "edit_user.php"; // case: edit_user&
                    break;
                case "myTickets" : include "myTickets.php";
                    break;
                case "allTickets": include "allTickets.php";
                case "allUsers": include "allUsers.php";
                case "createTicket": include "createTicket.php";
                    break;
                case "createNews": include "createNews.php";
                    break;
                case "logout": include "logout.php"; break;
                case "ticket": include "ticket.php"; break;


                default: include "news.php";

            }
        }
        else{
            include "news.php";
        }

        ?>


        <?php 
            include_once 'footer.php';
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
