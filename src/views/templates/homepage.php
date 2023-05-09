
<?php ob_start()?>
<div class="truc">
    <p>blablah</p>
</div>

<?php $content = ob_get_clean() ?>

<?php require ("layout.php");?>