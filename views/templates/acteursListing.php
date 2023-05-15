<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
    <tr>
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


    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>