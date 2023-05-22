<?php ob_start()?>

<div class="statsFlex">
    <div class="col">
        <p>
            <span class="yellow">Films de plus de 2h15 :</span>
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
    <div class="col">
        <p>
            <span class="yellow">Films sortis ces 5 dernières années : </span>
            <ul>

            <?php
                foreach ($filmsFiveYears as $film)
                {?>

                <li><?= $film["titre_film"] ?></li>

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
