<?php ob_start()?>


<div class="sideImg">
    <?= var_dump($thereIsAFile) ?>
    <img src="<?= ($thereIsAFile) ? ($pathFile[0]['image_film']) : "img/filmPlaceholder.jpg" ?>">
</div>
<div class="synopsisText">
    <h3><span class="yellow">Titre : </span><?= $filmData[0]["titre_film"] ?></h3>
    <h3><span class="yellow">Réalisateur : </span><?= $filmData[0]["prenom"] ?> <?= $filmData[0]["nom"] ?></h3>
    <p>
        <?= $synopsis[0]["synopsis"]?>
    </p>
    <h3 class="yellow">Dans les rôles de : </h3>
</div>
<p>
    
</p>
<?php 
$content = ob_get_clean();
require_once("views/templates/layoutAffiche.php"); ?>