<header class="header">
    <div class="container">

        <!-- button burger -->
        <div class="nav-burger" id="js-nav-toggle">
            <p class="burger-text"><span>Menu</span><span>Fermer</span></p>
            <div class="burger-icon">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>

        <!-- nav -->
        <nav class="nav" id="js-nav">
            <ul>
                <li><a href="/index.php" class="text-md">Accueil.</a></li>
                <li><a href="#" class="text-md">Contact.</a></li>

                <?php if ($this->session->get('pseudo')) { ?>
                <li><a class="text-md" href="/index.php?route=logout">Se déconnecter</a></li>
                <?php } else {  ?>
                <li><a class="text-md" href="/index.php?route=login">Se connecter</a></li>
                <li><a class="text-md" href="/index.php?route=register">S'inscrire.</a></li>
                <?php } ?>
            </ul>
            <p class="social"><a class="link-alt" href="#">GitHub</a> / <a class="link-alt" href="#">Instagram</a></p>
        </nav>

    </div>
</header>