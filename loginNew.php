


<?php
/*
kann nur von Rolle: Anon gesehen werden

*/

if(!isset($_SESSION)){
    session_start();
}


?>

<div class="PageWrap">


<div class="PageContent">

    <H1>Login</H1>

        <form action="include/login.inc.php" method="post">
            <p><input type="text" name="username" placeholder="Username"></p>
            <p><input type="password" name="password" placeholder="Password"></p>

            <?php
            if( isset($_GET["error"]) )
            {
                if( $_GET["error"] == "emptyinput" )
                {
                    echo "<p>Fill in all fields!</p>";
                }
                if( $_GET["error"] == "wronglogin" )
                {
                    echo "<p>Invalid login credentials!</p>";
                }
            }
            ?>

            <p><button type="submit" name="submit">Log me in</button></p>
        </form>

</div>


</div>





