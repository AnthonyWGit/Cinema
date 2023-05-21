<?php ob_start()?>

<div class="sideImg">
    <img src="<?=$pathFile[0]["image_film"]?>">;
</div>

<?php 
$content = ob_get_clean();
require_once("views/templates/layoutGlobal.php"); ?>