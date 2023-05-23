<?php ob_start();?>

<div class="statsFlex">
    <div class="col">
    <p>
        Acteurs dont l'âge est supérieur à 50 ans :
        <ul>
        <?php
        foreach ($statsActeurs as $statActeur)
        {
            ?>

            <li><?= $statActeur["nom"]." ".$statActeur["prenom"]?></li>

        <?php
        }
            ?>
        </ul>
    </p>

    <p>
        Tous les films de l'acteur de votre choix :

        <form method="post" action="index.php?action=getActorFilm">
                <select name="id_acteur" id="actor-select-number-films">
                <?php
                foreach($acteursList as $acteur)
                {?>

                    <option value="<?=$acteur["id"]?>"><?=$acteur["forename"]. " ".$acteur["name"]?></option>
                    
                <?php
                }
                ?>
                </select>
                <button type="submit"> Allons voir ! </button>
            </form>

    </p>

    <p>
        <ul>
        <?php 
        foreach ($arrayFilm as $film)
        {?>

            <li><?= $film["titre_film"]?></li>

        <?php 
        }
        ?>
        </ul>
    </p>
    </div>

    <p class="col">
        Nombre de femmes dans le groupe acteur : <?= $actorsSex[0]["nombre"]?>
        </br>
        Nombre d'hommes dans le groupe acteur : <?= $actorsSex[1]["nombre"]?>
        </br>
        Nombre de personnes dans la groupe acteur qui ne se définissent ni comme femme ni comme homme : <?= $actorsSex[2]["nombre"]?>
    </p>
</div>
<?php
$content = ob_get_clean();
require_once("views/templates/layoutStats.php");
?>
