<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
        <tr>
            <th></th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>sexe</th>
        </tr>
    
        <?php 
        foreach($acteurs as $acteur)
        { 
        ?>

        <tr>
            
            <td>
                <button><a href="index.php?action=deleteActeur&id_acteur=<?=$acteur["id_acteur"]?>">Supprimer</a></button>
            </td>

            <form method="post" action="index.php?action=updateActeur&id_acteur=<?=$acteur["id_acteur"]?>">
                <td>  
                    <?=$acteur["nom"]?>
                    <input type="text" name="nom" value="nom">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateActeur&id=<?=$acteur["id_acteur"]?>">
                <td>  
                    <?=$acteur["prenom"]?>
                    <input type="text" name="prenom" value="prénom">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateActeur&id=<?=$acteur["id_acteur"]?>">
                <td>  
                    <?=$acteur["dateDeNaissance"]?>
                    <input type="text" name="dateDeNaissance" value="ddN">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateActeur&id=<?=$acteur["id_acteur"]?>">
                <td>  
                    <?=$acteur["sexe"]?>
                    <input type="text" name="sexe" value="H/F/Autre">
                    <button type="submit">Envoyer</button>
                </td>
            </form>

        </tr>

        <?php
        }
        ?>
        <!-- LAST LINE OF TABLE -->
        <form method="post" action="index.php?action=addActeur">
            <tr>
                <td>
                    <button type="submit">Ajouter un(e) acteur/actrice</button>
                </td>

                <td>
                    Nom
                    <input type="text" name="nom" id="actor-name" value="Insérez nom">
                </td>

                <td>
                    Prénom
                    <input type="text" name="prenom" id="actor-forename" value="Insérez prénom">
                </td>

                <td>
                    Date de naissance
                    <input type="text" name="dateDeNaissance" id="actor-dob" value="Insérez prénom">
                </td>

                <td>
                    Sexe
                    <input type="text" name="sexe" id="actor-sex" value="Insérez sexe (au bon format)">
                </td>
            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>