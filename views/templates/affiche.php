<?php ob_start()?>

<div class="sideImg">
    <?= var_dump($thereIsAFile) ?>
    <img src="<?= ($thereIsAFile) ? ($pathFile[0]['image_film']) : "img/filmPlaceholder.jpg" ?>">
</div>
<div class="synopsisText">
    <p>
        <?= $synopsis[0]["synopsis"]?>
    </p>
</div>

<?php 
$content = ob_get_clean();
require_once("views/templates/layoutAffiche.php"); ?>