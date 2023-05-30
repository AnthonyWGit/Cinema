<?php ob_start(); ?>

<div class="row">
    <div class="col">
        <p>
            <?= $_SESSION["msg"] ?>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean(); 
require_once ("layoutRegister.php");
?>