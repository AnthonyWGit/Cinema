<?php ob_start()?>

<div class="sideImg">
    <img src="<?=$pathFile[0]["image_film"]?>">
</div>
<div class="synopsisText">
    <p>
        <?= $synopsis[0]["synopsis"]?>
    </p>
</div>

<?php 
$content = ob_get_clean();
require_once("views/templates/layoutAffiche.php"); ?>