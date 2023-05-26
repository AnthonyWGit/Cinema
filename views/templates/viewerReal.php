
<?php ob_start(); ?>

<div class="row">
            <?php
            foreach ($genresList as $genre)
            {?>

                <div class="card"> 
                    <p>
                        <h3>Titre : <?= $genre["titre_film"]?></h3>
                        <h3><?= is_array($genre["nom_genre"]) && (count($genre["nom_genre"]) == 1) ? "Genre:" : "Genres:" ?></h3>
                        <ul>
                        <?php 

                        foreach ($genre["nom_genre"] as $aaaa)
                            {
                                if ($aaaa == "AT")
                                {
                                    echo '';                                 
                                }
                                else
                                {
                                    echo "<li>". $aaaa ."</li>";
                                }

                            }
                        
                        ?>
                        </ul>

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