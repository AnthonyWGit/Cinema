<?php ob_start();?>

<div class="statsFlex">
    <div class="col">
        <p>
            Choisissez le réalisateur dont vous voulez voir le nombre de films.
            <form method="post" action="index.php?action=getRealsStats">
                <select name="id_realisateur" id="real-select-number-films">
                <?php 
                foreach($realisateursList as $real)
                {?>

                    <option value="<?=$real["id"]?>"><?=$real["forename"]?> <?=$real["name"]?></option>
                    
                <?php
                }
                ?>
                </select>
                <button type="submit"> Allons voir ! </button>
            </form>
        </p>
        <p>
            Choisissez le réalisateur dont vous vérifier s'il a joué dans ses propres films.
            <form method="post" action="index.php?action=getRealsStatsActorCheck">
                <select name="id_realisateur" id="real-select-actor-check">
                <?php 
                foreach($realisateursList as $real)
                {?>

                    <option value="<?=$real["id"]?>"><?=$real["forename"]?> <?=$real["name"]?></option>
                    
                <?php
                }
                ?>
                </select>
                <button type="submit"> Allons voir ! </button>
            </form>
        </p>

        <?= !empty($numberOfMovies[0]["Nombre films"]) ? $numberOfMovies[0]["nom"]." a réalisé ".$numberOfMovies[0]["Nombre films"]." films." : "" ?>
        <?=  $infosIsActor?>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once("views/templates/layoutStats.php");
?>
