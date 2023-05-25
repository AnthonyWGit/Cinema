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
                <button class="deleteButton"><a href="index.php?action=deleteCasting&id_film=<?=$casting["id_film"]?>&id_acteur=<?=$casting["id_acteur"]?>&id_role=<?=$casting["id_role"]?>">Supprimer</a></button>
            </td>
            
            
            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&champ_casting=<?=$casting["titre_film"]?>">
                <td>  
                    <label><?=$casting["titre_film"]?></label>
                    <input type="text" name="titre_film" value="Titre du film">
                    <button type="submit" class="updateButton" class="updateButton">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&id_acteur=<?=$casting["id_acteur"]?>">
                <td>  
                    <label><?=$casting["nom"]?></label>
                    <input type="text" name="nom" value="nom">

                </td>

                <td>  
                    <label><?=$casting["prenom"]?></label>
                    <input type="text" name="prenom" value="prénom">
                    <button type="submit" class="updateButton" class="updateButton">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateCasting&id_film=<?=$casting["id_film"]?>&champ_casting=<?=$casting["nom_role"]?>">
                <td>  
                    <label><?=$casting["nom_role"]?></label>
                    <input type="text" name="nom_role" value="nom du rôle">
                    <button type="submit" class="updateButton" class="updateButton">Envoyer</button>
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
                    <button type="submit" class="updateButton" class="updateButton">Ajouter un casting</button>
                </td>
                <td>
                
                    <label><?=$casting["titre_film"]?></label>
                    <input type="text" name="titre_film" value="Titre du film">
                    
                </td>
                <td>  
                    <label><?=$casting["nom"]?></label>
                    <input type="text" name="nom" value="nom">
                </td>
                <td>
                    <label><?=$casting["prenom"]?></label>
                    <input type="text" name="prenom" value="prénom">
                </td>
                <td>  
                    <label><?=$casting["nom_role"]?></label>
                    <input type="text" name="nom_role" value="nom du rôle">
                </td>

            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>