<?php
    include_once "include/functions.inc.php";
    include_once "include/dbaccess.inc.php";
?>
<div class="PageWrap">
    <h1>News</h1>
    <?php
    //limits how many news entries
    //are displayed
    $limitednews = getNews($conn, 2);
    foreach($limitednews as $news){
        //news without image
        if($news["img_path"] == "NOIMAGE"){
            echo '<div class="PageContent NewsContent">';
            echo    '<h2 class="display-5">' . $news["title"] . '</h2>';
            echo    '<p>' . $news["article"] . '</p>';
            echo    '<p><i>gepostet: </i>' . $news["date"] . '</p>';
            echo '</div>';
        }
        else{
            echo '<div class="PageContent NewsContent">';
            echo    '<div class="row">';
            echo        '<div class="col-md-4">';
            echo            '<img class="img-fluid" src="' . $news["img_path"] . '" alt="mountains">';
            echo             '<p> <i>gepostet: </i>' . $news["date"] . '</p>';
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
</div>