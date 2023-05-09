<?php ob_start() ;?>

<!DOCTYPE html>
<div class="listeFilm">
    <table>
    <tr>
        <th>Numéro</th>
        <th>Titre du film</th>
        <th>Synopsis</th>
        <th>Durée du film</th>
        <th><?= $_GET ?></th>
        <th>Année de sortie</th>
        <th>Réalisateur</th>
        <th>Image</th>
    </tr>
    <?php 
    foreach($filmsList as $film)
    { 
    ?>
    <tr>
        <td><?= $film["id_film"]?></td>;
        <td><?= $film["titre_film"]?></td>;
    </tr>
    <?php
    }
    ?>
    </table>
</div>

<?php $content = ob_get_clean(); ?>
<?php
var_dump($_GET);
require "views/templates/layout.php";?>