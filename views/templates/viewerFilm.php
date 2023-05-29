
<?php ob_start(); ?>

<div class="row">
    <div class="col img">
        <p>
            Choisissez le fim dont vous voulez voir le détail :
        </p>

            <form method="post" action="index.php?action=displayVisitorFilmsByReal">
            <label>Films par Réalisateur :</label>
            <select class="transparentSelect" name="id_real">


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

        <form method="post" action="index.php?action=displayVisitorFilmsByGenre">
        <label>Films par Genres:</label>            
            <select class="transparentSelect" name="id_genre">


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
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require ("layoutVisiteurAccueil.php");?>