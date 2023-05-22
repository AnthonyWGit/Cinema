<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
        <tr>
            <th></th>
            <th>Numéro</th>
            <th>Genre de film</th>
        </tr>
    
        <?php 
        foreach($genres as $genre)
        { 
        ?>

        <tr>

            <td>
                <button class="deleteButton"><a href="index.php?action=deleteGenre&id_genre=<?=$genre["id_genre"]?>">Supprimer</a></button>
            </td>

            <td>  
                <?=$genre["id_genre"]?>
            </td>


            <form method="post" action="index.php?action=updateGenre&id_genre=<?=$genre["id_genre"]?>">
                <td>  
                    <?=$genre["nom_genre"]?>
                    <input type="text" name="nom_genre" value="Titre du rôle">
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
                    <label>Nom du rôle</label>
                    <input type="text" name="nom_genre" id="genre-nom-genre" value="Insérez genre">
                </td>

            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>