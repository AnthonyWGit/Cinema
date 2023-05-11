<?php ob_start(); ?>

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
    <form method="post" action="index.php?action=updateFilms">    
    <?php 
    foreach($filmsList as $film)
    { 
    ?>

    <tr>
        <td>
            <?= $film["id_film"]?>
        <input name="id_film[]" type="hidden" value="<?=$film["id_film"]?>">
    
        </td>
        
        <td>
            <?= $film["titre_film"]?>

                <input name="titre_film[]" type="text" id="<?=$film["id_film"]?>" value="<?= $film["titre_film"]?>">

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
        <button type="submit">Envoyer</button>
    </form>   


</div>

<?php 
$content = ob_get_clean(); 
require "views/templates/layoutTable.php";?>