<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    function SetGet($page){
        if(isset($_GET["currPage"])){
            return ($_GET["currPage"] == $page) ? TRUE : FALSE;
        }
    }
?>

<header class="text-center bg-gradient">
    <img id="headerImg" class="img-fluid " src="images/header_img.jpg" alt="Picture of a big pool with little huts">
</header>

<nav class="navbar navbar-expand-md navbar-light bg-light bg-gradient sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/Hotel__Logo_transparent.png" alt="" width="30" height="24">
        </a>              
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <!-- php script for setting links active for current page -->
                <a class="nav-link <?php echo (!isset($_GET["currPage"]) or (SetGet("home"))) ? " active "  : ""; ?>" href="index.php?currPage=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (SetGet("help")) ? " active" : ""; ?>" href="index.php?currPage=help">Hilfe/FAQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (SetGet("impressum")) ? " active" : ""; ?>" href="index.php?currPage=impressum">Impressum</a>
            </li>
        </ul>
        <!-- Login, registry change to log out if logged in  -->
        <ul class="navbar-nav d-flex justify-content-end">
            <?php if(isset($_SESSION["Username"])) : ?>
                <li class="nav-item">
                <a class="nav-link <?php echo  (SetGet("profile")) ? " active "  : ""; ?>" href="index.php?currPage=profile">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?UserStatus=logout">Log Out!</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo (SetGet("help")) ? " active" : ""; ?>" href="index.php?currPage=signup">Jetzt registrieren!</a> <!--target blank deleted-->
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#LoginField" role="button">Oder Login!</a>
                </li> 
            <?php endif; ?>
        </ul>
        </div>
    </div>
</nav>



