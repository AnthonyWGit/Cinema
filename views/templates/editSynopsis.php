<?php ob_start() ?>
<div class="alignCol">

    <form method="post" action="index.php?action=editSynopsis&id=<?=$_GET["id"]?>">

        <textarea name="textSynopsis" placeholder="<?= $synopsisIsEmpty == true ? "Créez un synopsis" : $film[$id]["synopsis"]?>"></textarea>
        
        <div class="sendbutton">
            <button type="submit">Mettre à jour</button>
        </div>

    </form>
</div>
<?php 
$content = ob_get_clean();
require ("layoutSynopsis.php");