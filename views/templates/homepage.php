
<?php ob_start(); ?>
<div class="grille">
    <div class="card">
        <div class="textCard">
            <h3>Réalisateurs - Réalisatrices</h3>
            <p>Dernière mise à jour :</p>
        </div>
    </div>
    <div class="card">
        <div class="textCard">
            <h3>Films</h3>
            <p>Dernière mise à jour : </p>
            <p><?= $dateTime[2]["LastUpdated"]?></p>
        </div>
    </div>
    <div class="card">
        <div class="textCard">
            <h3>Acteurs - Actrices</h3>
            <p>Dernière mise à jour :</p>
        </div>
    </div>
    <div class="card">
        <div class="textCard">
            <h3>Genres</h3>
            <p>Dernière mise à jour :</p>
        </div>
    </div>
    <div class="card">
        <div class="textCard">
            <h3>Castings</h3>
            <p>Dernière mise à jour :</p>
        </div>
    </div>
    <div class="card">
        <div class="textCard">
            <h3>Rôles</h3>
            <p>Dernière mise à jour :</p>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require ("layoutHomepage.php");?>