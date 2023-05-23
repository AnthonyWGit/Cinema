<?php ob_start()?>

<div class="statsFlex">
    <p>
        Il n'y a aucun contenu à afficher.
    </p>
</div>
<?php 
$content = ob_get_clean();
require_once("views/templates/layoutStats.php");
?>
