
<?php ob_start(); ?>
<div class="grille">
    <div class="card">
        <h3>Réalisateurs - Réalisatrices</h3>
        <p>Dernière mise à jour :</p>
    </div>
    <div class="card">
        <h3>Films</h3>
        <p>Dernière mise à jour :</p>
    </div>
    <div class="card">
        <h3>Acteurs - Actrices</h3>
        <p>Dernière mise à jour :</p>
    </div>
    <div class="card">
        <h3>Genres</h3>
        <p>Dernière mise à jour :</p>
    </div>
    <div class="card">
        <h3>Castings</h3>
        <p>Dernière mise à jour :</p>
    </div>
    <div class="card">
        <h3>Rôles</h3>
        <p>Dernière mise à jour :</p>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require ("layoutGlobal.php");?>