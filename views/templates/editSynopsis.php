<?php ob_start() ?>
<div class="alignCol">
    <div class="alignRow">

        <form method="post" action="index.php?action=editSynopsis&id=<?=$_GET["id"]?>">

            <textarea name="textSynopsis" placeholder="<?= $synopsisIsEmpty == true ? "Créez un synopsis" : $film[$id]["synopsis"]?>"></textarea>

            <button type="submit">Mettre à jour</button>

        </form>
    </div>
</div>
<?php 
$content = ob_get_clean();
require ("layoutSynopsis.php");