<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
        <tr>
            <th></th>
            <th>Titre du film</th>
            <th>Acteurs et actrives</th>
            <th>Rôles joués</th>
        </tr>
    
        <?php 
        foreach($castings as $casting)
        { 
        ?>

        <tr>

            <td>
                <button><a href="index.php?action=deleteCasting&id_film=<?=$casting["id_film"]?>">Supprimer</a></button>
            </td>
            
            
            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&champ_casting=<?=$casting["titre_film"]?>">
                <td>  
                    <?=$casting["titre_film"]?>
                    <input type="text" name="titre_film" value="Titre du film">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&champ_casting=<?=$casting["nom"]?>">
                <td>  
                    <?=$casting["nom"]?> 
                    <input type="text" name="nom" value="Titre du rôle">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&champ_casting=<?=$casting["prenom"]?>">
                <td>  
                    <?=$casting["prenom"]?> 
                    <input type="text" name="prenom" value="Titre du rôle">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&champ_casting=<?=$casting["nom_role"]?>">
                <td>  
                    <?=$casting["nom_role"]?> 
                    <input type="text" name="nom_role" value="Titre du rôle">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

        </tr>

        <?php
        }
        ?>
        <!-- LAST LINE OF TABLE -->
        <form method="post" action="index.php?action=addCasting">
            <tr>
                <td>
                    <button type="submit">Ajouter un casting</button>
                </td>

                <td>
                </td>

                <td>
                    <label>Nom du rôle</label>
                    <input type="text" name="casting" id="casting-nom-casting" value="Insérez casting">
                </td>

            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>