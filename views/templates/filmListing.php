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
        <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">    
            <?= $film["titre_film"]?>
            <button type="submit">Envoyer</button>

                <input name="titre_film" type="text" id="titre_film_<?=$film["id_film"]?>" value="<?= $film["titre_film"]?>">
        </form>
        </td>
        <td>
            <?= $film["synopsis"]?>
        </td>
        <td>
            <?= $film["duree_film"]?>

                <input name="duree_film[]" type="text" id="duree_film_"<?=$film["id_film"]?>" value="<?= $film["duree_film"]?>">
        </td>
        <td>
            <?= $film["dateSortie_film"]?>

            <input name="dateSortie_film[]" type="text" id="dateSortie_<?=$film["id_film"]?>" value="<?= $film["dateSortie_film"]?>">

        </td>
        <td>

            <?= $film["nom"]?> <?= $film["prenom"]?>

            <input name="nom[]" type="text" id="nom_<?=$film["id_film"]?>" value="<?= $film["nom"]?>">
            <input name="prenom[]" type="text" id="prenom_<?=$film["id_film"]?>" value="<?= $film["prenom"]?>">

        </td>

        <td>
            <?= $film["image_film"]?>

        </td>
    </tr>
    <?php
    }
    ?>
    </table>

</div>

<?php 
$content = ob_get_clean(); 
require "views/templates/layoutTable.php";?>