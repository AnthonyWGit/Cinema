<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
        <tr>
            <th></th>
            <th>Film</th>
            <th>Genre de film</th>
        </tr>
    
        <?php 
        foreach($filmsGenres as $filmGenre)
        { 
        ?>

        <tr>

            <td>
                <button class="deleteButton"><a href="index.php?action=deleteGenre&id_genre=<?=$genre["id_genre"]?>">Supprimer</a></button>
            </td>

            <td>  
                <?=$filmGenre["titre_film"]?>
            </td>


            <form method="post" action="index.php?action=updateFilmGenre&id=<?=$filmGenre["id_film"]?>&oldID=<?=$filmGenre["id_genre"]?>">
                <td>  
                <label><?= $filmGenre["nom_genre"]?></label>
                    <select name="id_genre" id="real-select">
                        <?php 
                        foreach($genresFilmsList as $stuff)
                        { var_dump($filmsList);
                        ?>
            <option value="<?=$stuff["id"]?>"><?=$stuff["nom_genre"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button type="submit" class="updateButton" class="updateButton">Envoyer</button>
                </td>
            </form>

        </tr>

        <?php
        }
        ?>
        <!-- LAST LINE OF TABLE -->
        <form method="post" action="index.php?action=addGenre">
            <tr>
                <td>
                    <button type="submit" class="updateButton" class="updateButton">Ajouter un genre</button>
                </td>

                <td>
                </td>

                <td>
                    <label>Nom du genre</label>
                    <select name="id_realisateur" id="real-select">
                        <?php 
                        foreach($genresFilmsList as $stuff)
                        { var_dump($filmsList);
                        ?>
            <option value="<?=$stuff["id"]?>"><?=$stuff["nom_genre"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>

            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>