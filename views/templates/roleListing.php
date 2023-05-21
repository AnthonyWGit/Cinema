<?php ob_start(); ?>

<div class="listFilms">
    <!-- TABLE STARTS HERE -->
    <table>
        <tr>
            <th></th>
            <th>Numéro</th>
            <th>Rôle joué</th>
        </tr>
    
        <?php 
        foreach($roles as $role)
        { 
        ?>

        <tr>

            <td>
                <button class="deleteButton"><a href="index.php?action=deleteRole&id_role=<?=$role["id_role"]?>">Supprimer</a></button>
            </td>

            <td>  
                <?=$role["id_role"]?>
            </td>


            <form method="post" action="index.php?action=updateRole&id_role=<?=$role["id_role"]?>">
                <td>  
                    <?=$role["nom_role"]?>
                    <input type="text" name="nom_role" value="Titre du rôle">
                    <button type="submit" class="updateButton" class="updateButton" class="updateButton">Envoyer</button>
                </td>
            </form>

        </tr>

        <?php
        }
        ?>
        <!-- LAST LINE OF TABLE -->
        <form method="post" action="index.php?action=addRole">
            <tr>
                <td>
                    <button type="submit" class="updateButton" class="updateButton" class="updateButton">Ajouter un rôle</button>
                </td>

                <td>
                </td>

                <td>
                    <label>Nom du rôle</label>
                    <input type="text" name="prenom" id="role-nom-role" value="Insérez rôle">
                </td>

            </tr>
        </form>
    </table>
<!-- END OF TABLE -->
</div>

<?php
$content=ob_get_clean();
require_once "views/templates/layoutTable.php";?>