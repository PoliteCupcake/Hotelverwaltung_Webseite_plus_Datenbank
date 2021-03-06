<!--Checks roles in order to display the right options -->
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
            
            <!--- NEWS -->
            <?php if(true) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=news">News</a>
				</li>
            <?php } ?>

            <!--- Impressum -->
            <?php if(true) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=impressum">Impressum</a>
				</li>
            <?php } ?>

            <!--- Hilfe -->
            <?php if(true) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=help">Hilfe</a>
				</li>
            <?php } ?>

            <!--- Profil -->
            <?php if($guest||$serviceTech||$admin) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=profile">Profil</a>
				</li>
            <?php } ?>

            <!--- Meine Tickets -->
            <?php if($guest||$serviceTech||$admin) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=myTickets">Meine Tickets</a>
				</li>
            <?php } ?>

            <!--- Alle Tickets -->
            <?php if($serviceTech||$admin) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=allTickets">Alle Tickets</a>
				</li>
            <?php } ?>

            <!--- Adminpanel -->
            <?php if($admin) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=admin">Adminpanel</a>
				</li>
            <?php } ?>
        </ul>

        <ul class="navbar-nav d-flex justify-content-end">

            <!--- Login -->
            <?php if($anon) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=loginNew">Login</a>
				</li>
            <?php } ?>

            <!--- Registrieren -->
            <?php if($anon) { ?>
				<li class="nav-item">
				<a class="nav-link active" href="index.php?currPage=signup">Registrieren</a>
				</li>
            <?php } ?>

	    <!--- Logout -->
            <?php if($guest||$serviceTech||$admin)
            {
				echo $_SESSION["useruid"]." (<i>".$_SESSION["userRole"].")</i><p><a href='index.php?currPage=logout'>Logout</a></p>";
            }
            ?>

        </ul>

        </div>
    </div>
</nav>



