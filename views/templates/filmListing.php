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

        </td>
        <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">           
            <td>
    
                <?= $film["titre_film"]?>
                <button type="submit">Envoyer</button>

                    <input name="titre_film" type="text" id="titre_film_<?=$film["id_film"]?>" value="<?= $film["titre_film"]?>">

            </td>

        </form>  

        <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">
            <td>
                <?= $film["synopsis"]?>

                <button><a href="index.php?action=synopsis&id=<?=$film["id_film"]?>">Go to Example</a></button>

            </td>
        </form>

        <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">
            <td>
                <?= $film["dureeFormat"]?>
                <button type="submit">Envoyer</button>

                    <input name="duree_film" type="text" id="duree_film_"<?=$film["id_film"]?>" value="<?= $film["dureeFormat"]?>">
            </td>
        </form>

        <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">

            <td>
                <?= $film["dateSortie_film"]?>
                <button type="submit">Envoyer</button>

                <input name="dateSortie_film" type="text" id="dateSortie_<?=$film["id_film"]?>" value="<?= $film["dateSortie_film"]?>">

            </td>

        </form>

        <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">
            <td>

                <?= $film["nom"]?> <?= $film["prenom"]?>
                <button type="submit">Envoyer</button>

                <input name="nom" type="text" id="nom_<?=$film["id_film"]?>" value="<?= $film["nom"]?>">
                <input name="prenom" type="text" id="prenom_<?=$film["id_film"]?>" value="<?= $film["prenom"]?>">

            </td>
        </form>

        <form method="post" action="index.php?action=uploadFile&id_film=<?=$film["id_film"] ?>" enctype="multipart/form-data">
            <td>
                <?= $film["image_film"]?>

                <label for="file">Fichier à héberger :</label>
                <input type="file" name="file" id="file" required />
                <button type="submit">Upload</button>

            </td>
        </form>
    </tr>
    <?php
    }
    ?>
    </table>

</div>

<?php 
$content = ob_get_clean(); 
require "views/templates/layoutTable.php";?>