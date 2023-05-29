

<?php ob_start(); ?>

<div class="row">
            <?php
            foreach ($filmsList as $genre)
            {?>

                <div class="card"> 
                    <p>
                        <h3>Titre : <?= $genre["titre_film"]?></h3>
                        <h3>Real : <?= $genre["prenom"]. " " .$genre["nom"]?></h3>

                        <a href="index.php?action=goToAffiche&id=<?=$genre["id_film"]?>">
                            <img src="<?= !empty($genre["image_film"]) ? $genre["image_film"] : "img/filmPlaceholder.jpg" ?>"/>
                        </a>

                    </p>
                </div>

            <?php
            }?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require ("layoutVisiteur.php");?>