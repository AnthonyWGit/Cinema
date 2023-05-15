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

        <td>  
            <?=$acteur["nom"]?>
        </td>

        <td>
            <?=$acteur["prenom"]?>
        </td>

        <td>
            <?=$acteur["dateDeNaissance"]?>
        </td>

        <td>
            <?=$acteur["sexe"]?>
        </td>

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