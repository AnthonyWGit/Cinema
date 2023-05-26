
<?php ob_start(); ?>

<div class="row">
            <?php
            foreach ($filmsList as $film)
            {?>

                <div class="card"> 
                    <p>
                        <h3>Titre : <?= $film["titre_film"]?></h3>
                        <h3>Genre : </h3>
                        <ul>

                        </ul>

                        <a href="index.php?action=goToAffiche&id=<?=$film["id_film"]?>">
                            <img src="<?= !empty($film["image_film"]) ? $film["image_film"] : "img/filmPlaceholder.jpg" ?>"/>
                        </a>

                    </p>
                </div>

            <?php
            }?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require ("layoutVisiteur.php");?>