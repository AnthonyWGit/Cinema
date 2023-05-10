<?php ob_start(); ?>

<!DOCTYPE html>
<div class="listFilms">
    <table>
    <tr>
        <th>Numéro</th>
        <th>Titre du film</th>
        <th>Synopsis</th>
        <th>Durée du film</th>
        <th>Année de sortie</th>
        <th>Réalisateur</th>
        <th>Image</th>
    </tr>
    <?php 
    foreach($filmsList as $film)
    { 
    ?>
    <tr>
        <td><?= $film["id_film"]?></td>
        <td>
            <?= $film["titre_film"]?>
            <form method="post" action="index.php?action=updateFilms">
                <input name="test" value="<?= $film["titre_film"]?>">
            </form>
        </td>
        <td><?= $film["synopsis"]?></td>
        <td><?= $film["duree_film"]?></td>
        <td><?= $film["dateSortie_film"]?></td>
        <td><?= $film["nom"]?> <?= $film["prenom"]?></td>
        <td><?= $film["image_film"]?></td>
    </tr>
    <?php
    }
    ?>
    </table>
</div>

<?php 
$content = ob_get_clean(); 
require "views/templates/layoutTable.php";?>