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
        foreach($realisateurs as $realisateur)
        { 
        ?>

        <tr>
            
            <td>
                <button><a href="index.php?action=deleteRealisateur&id_real=<?=$realisateur["id_realisateur"]?>">Supprimer</a></button>
            </td>

            <form method="post" action="index.php?action=updateRealisateur&id_real=<?=$realisateur["id_realisateur"]?>" id="nom-real-form">
                <td>  
                    <?=$realisateur["nom"]?>
                    <input type="text" name="nom" value="nom" id="nom-real-input">
                    <button type="submit" id="nom-real-button">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateRealisateur&id_real=<?=$realisateur["id_realisateur"]?>" id="prenom-real-form">
                <td>  
                    <?=$realisateur["prenom"]?>
                    <input type="text" name="prenom" value="prénom" id="prenom-real-input">
                    <button type="submit" id="prenom-real-button">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateRealisateur&id_real=<?=$realisateur["id_realisateur"]?>" id="ddN-real-form">
                <td>  
                    <?=$realisateur["dateDeNaissance"]?>
                    <input type="text" name="dateDeNaissance" value="ddN" id="ddN-real-input">
                    <button type="submit" id="dob-real-button">Envoyer</button>
                </td>
            </form>

            <form method="post" action="index.php?action=updateRealisateur&id_real=<?=$realisateur["id_realisateur"]?>" id="sexe-real-form">
                <td>  
                    <?=$realisateur["sexe"]?>
                    <input type="text" name="sexe" value="H/F/Autre" id="sexe-real-input">
                    <button type="submit" id="sexe-real-button">Envoyer</button>
                </td>
            </form>

        </tr>

        <?php
        }
        ?>
        <!-- LAST LINE OF TABLE -->
        <form method="post" action="index.php?action=addReal">
            <tr>
                <td>
                    <button type="submit">Ajouter un(e) realisateur/actrice</button>
                </td>

                <td>
                    Nom
                    <input type="text" name="nom" id="real-name-new" value="Insérez nom">
                </td>

                <td>
                    Prénom
                    <input type="text" name="prenom" id="real-forename-new" value="Insérez prénom">
                </td>

                <td>
                    Date de naissance
                    <input type="text" name="dateDeNaissance" id="real-dob-new" value="Insérez prénom">
                </td>

                <td>
                    Sexe
                    <input type="text" name="sexe" id="real-sex-new" value="Insérez sexe (au bon format)">
                </td>
            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>