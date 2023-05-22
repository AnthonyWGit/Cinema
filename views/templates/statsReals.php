<?php ob_start();?>

<div class="statsFlex">
    <div class="col">
        <p>
            Choisissez le réalisateur dont vous voulez voir le nombre de films.
            <form method="post" action="index.php?action=getRealsStats">
                <select name="id_realisateur" id="real-select">
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

        <?= !empty($dataReal[0]["Nombre films"]) ? $dataReal[0]["nom"]." a réalisé ".$dataReal[0]["Nombre films"]." films." : "" ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once("views/templates/layoutStats.php");
?>
