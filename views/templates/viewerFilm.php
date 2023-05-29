
<?php ob_start(); ?>

<div class="statsFlex">
    <div class="col">
        <p>
            Choisissez le fim dont vous voulez voir le détail :
        </p>

        <p>
            <form method="post" action="index.php?action=displayVisitorFilmsByReal">
            Films par Réalisateur :
            <select name="id_real">


                <?php
                foreach ($realisateursList as $real)
                {?>

                    <option value="<?=$real["id"]?>"><?= $real["name"]?></option>

                <?php
                }
                ?>

            </select>
            <button type="submit">GO</button>
            
            </form>
        </p>
    </div>

    <div class="col">
    <p>
        Films par Genres:
        <form method="post" action="index.php?action=displayVisitorFilmsByGenre">

            <select name="id_genre">


                <?php
                foreach ($genres as $genre)
                {?>

                    <option value="<?=$genre["id_genre"]?>"><?= $genre["nom_genre"]?></option>

                <?php
                }
                ?>

            </select>
            <button type="submit">GO</button>
        </form>
    </p>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require ("layoutVisiteur.php");?>