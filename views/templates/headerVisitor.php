<header class="header">
    <div class="banner">
        <div class="logo">
            <h2>LOGO</h2>
        </div>
        <ul>
            <li><a href="index.php?action=displayVisitorFilm">Menu</a></li>
            <li><a href="index.php?action=Homepage">Admin interface</a></li>
        </ul>
            <button id="mode-select" class="toggleBtn" onclick='myFunction()'><i class="bi bi-sun" id="sun-moon"></i></button>
            <div class="div">
                <?= (!isset($_SESSION["session"])) ? '<h5><a href="index.php?action=goToLogin">Login</a></h5>' : '' ?>
            </div>
            <div class="div">
                <h5><a href="index.php?action=goToRegister">S'inscrire</a></h5>
            </div>
                <?= (isset($_SESSION["session"]) && $_SESSION["session"]) ? "<h5><a href='index.php?action=disconnect'>Déconnexion</a></h5>" : "" ?>            
        <div class="lang">
            <h2>FR</h2>
        </div>
    </div>    
</header>