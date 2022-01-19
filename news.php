<?php
    include_once "include/functions.inc.php";
    include_once "include/dbaccess.inc.php";
?>
<div class="PageWrap">
    <h1>News</h1>
    <?php
    $limitednews = getNews($conn, 2);
    foreach($limitednews as $news){
        if($news["img_path"] == "NOIMAGE"){
            echo '<div class="PageContent NewsContent">';
            echo    '<h2 class="display-5">' . $news["title"] . '</h2>';
            echo    '<p>' . $news["article"] . '</p>';
            echo    '<p>' . $news["date"] . '</p>';
            echo '</div>';
        }
        else{
            echo '<div class="PageContent NewsContent">';
            echo    '<div class="row">';
            echo        '<div class="col-md-4">';
            echo            '<img class="img-fluid" src="' . $news["img_path"] . '" alt="mountains">';
            echo             '<p>' . $news["date"] . '</p>';
            echo        '</div>';
            echo        '<div class="col-md-8 border-start">';
            echo            '<h2 class="display-5">' . $news["title"] . '</h2>';
            echo            '<p>' . $news["article"] . '</p>'; 
            echo        '</div>';
            echo    '</div>';
            echo '</div>';
        }
    }

    ?>

    <!--
    <div class="PageContent NewsContent">
        <div class="row flex-column-reverse flex-md-row">
            <div class="col-md-8 border-end">
                <h2 class="display-5">Wandern!</h2>
                <p>Ein kleiner Paragraph über die tollen Wanderrouten! Es gibt viele tolle Wanderrouten in der Umgebung. Ob zu Fuß oder mit dem Rad es ist für jeden etwas dabei!</p>
            </div>
            <div class="col-md-4">
                <img class="img-fluid" src="images/mountains_news.jpg" alt="mountains">
            </div>
        </div>
    </div>
    <div class="PageContent NewsContent">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid" src="images/mountains_news.jpg" alt="mountains">
            </div>
            <div class="col-md-8 border-start">
                <h2 class="display-5">Wandern!</h2>
                <p>Ein kleiner Paragraph über die tollen Wanderrouten! Es gibt viele tolle Wanderrouten in der Umgebung. Ob zu Fuß oder mit dem Rad es ist für jeden etwas dabei!</p>
            </div>
        </div>
    </div>
    <div class="PageContent NewsContent">
        <div class="row flex-column-reverse flex-md-row">
            <div class="col-md-8 border-end">
                <h2 class="display-5">Wandern!</h2>
                <p>Ein kleiner Paragraph über die tollen Wanderrouten! Es gibt viele tolle Wanderrouten in der Umgebung. Ob zu Fuß oder mit dem Rad es ist für jeden etwas dabei!</p>
            </div>
            <div class="col-md-4">
                <img class="img-fluid" src="images/mountains_news.jpg" alt="mountains">
            </div>
        </div>
    </div>
-->
</div>