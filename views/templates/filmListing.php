<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
        <tr>
            <th></th>
            <th>Affiche</th>
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
                
                <button class="deleteButton"><a href="index.php?action=deleteFilm&id_film=<?=$film["id_film"]?>">DELETE</button>   
                         
            </td>
            <td>
                <div class="buttonHover">
                    <button class="updateButton"><a href="index.php?action=goToAffiche&id=<?=$film["id_film"]?>">Voir affiche</button>    
                </div>                    
            </td>
            <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">           
                <td>
        
                    <?= $film["titre_film"]?>
                    <div class="buttonHover">
                        <button type="submit" class="updateButton">Envoyer</button>
                    </div>

                        <input name="titre_film" type="text" id="titre_film_<?=$film["id_film"]?>" value="<?= $film["titre_film"]?>">

                </td>

            </form>  


                <td>
                    <div class="buttonHover">
                        <a href="index.php?action=goToSynopsis&id=<?=$film["id_film"]?>"><button class="updateButton">Modifier</button></a>
                    </div>
                </td>


            <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">
                <td>
                    <?= $film["dureeFormat"]?>

                    <div class="buttonHover">
                        <button type="submit" class="updateButton">Envoyer</button>
                    </div>

                        <input name="duree_film" type="text" id="duree_film_<?=$film["id_film"]?>" value="<?= $film["dureeFormat"]?>">
                </td>
            </form>

            <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">

                <td>
                    <?= $film["dateSortie_film"]?>
                    <div class="buttonHover">
                        <button type="submit" class="updateButton">Envoyer</button>
                    </div>

                    <input name="dateSortie_film" type="text" id="dateSortie_<?=$film["id_film"]?>" value="<?= $film["dateSortie_film"]?>">

                </td>

            </form>

            <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">
                <td>

                    <?= $film["nom"]?> <?= $film["prenom"]?>
                    <div class="buttonHover">
                        <button type="submit" class="updateButton">Envoyer</button>
                    </div>

                    <input name="nom" type="text" id="nom_<?=$film["id_film"]?>" value="<?= $film["nom"]?>">
                    <input name="prenom" type="text" id="prenom_<?=$film["id_film"]?>" value="<?= $film["prenom"]?>">

                </td>
            </form>

            <form method="post" action="index.php?action=updateFilms&id_film=<?=$film["id_film"] ?>">
                <td>

                    <?= $film["nom"]?> <?= $film["prenom"]?>
                    <div class="buttonHover">
                        <button type="submit" class="updateButton">Envoyer</button>
                    </div>

                    <input name="nom" type="text" id="nom_<?=$film["id_film"]?>" value="<?= $film["nom"]?>">
                    <input name="prenom" type="text" id="prenom_<?=$film["id_film"]?>" value="<?= $film["prenom"]?>">

                </td>
            </form>


            <form method="post" action="index.php?action=uploadFile&id_film=<?=$film["id_film"] ?>" enctype="multipart/form-data">
                <td>
                    <?= $film["image_film"]?>

                    <label for="file">Fichier à héberger :</label>
                    <input type="file" name="file" id="file" required />

                    <div class="buttonHoverUpload">
                        <button type="submit" class="updateButton">Upload</button>
                    </div>

                </td>
            </form>
        </tr>

        <?php
        }
        ?>
        <!-- LAST LINE OF TABLE -->
        <form method="post" action="index.php?action=addFilm"  enctype="multipart/form-data">
            <tr>
                <td>
                        <button type="submit" class="updateButton"> Ajouter un film</button>
                </td>
                <td>
                    
                </td>
                <td>
                    <?= $film["titre_film"]?>
                        <input name="titre_film" type="text" id="titre_film_<?=$film["id_film"]?>" value="<?= $film["titre_film"]?>">
                </td>
                <td>
                </td>
                <td>
                        <input name="duree_film" type="text" id="duree_film_"<?=$film["id_film"]?>" value="<?= $film["dureeFormat"]?>">
                </td>
                <td>
                    <?= $film["dateSortie_film"]?>
                    <input name="dateSortie_film" type="text" id="dateSortie_<?=$film["id_film"]?>" value="<?= $film["dateSortie_film"]?>">
                </td>
                <td>
                    <select name="id_realisateur" id="real-select">
                        <?php 
                        foreach($realisateursList as $real)
                        { var_dump($filmsList);
                        ?>
            <option value="<?=$real["id"]?>"><?=$real["forename"]?> <?=$real["name"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <?= $film["image_film"]?>
                    <label for="file">Fichier à héberger :</label>
                    <input type="file" name="fileNew" id="fileNew" />
                </td>
            </tr>
        </form>

    </table>
<!-- END OF TABLE -->
</div>

<?php 
$content = ob_get_clean(); 
require "views/templates/layoutTable.php";?>