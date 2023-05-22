<?php ob_start()?>

<div class="statsFlex">
    <div class="col">
        <p>
            <span class="yellow">Nombre de films par genre</span>
            <ul>
                <?php
                foreach ($filmsLenght as $filmLenght)
                {?>

                <li><?= $filmLenght["titre_film"] ?></li>

                <?php
                }
                ?>

            </ul>
        </p>
    </div>
</div>
<?php 
$content = ob_get_clean();
require_once("views/templates/layoutStats.php");
?>
