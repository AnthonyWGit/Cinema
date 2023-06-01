<?php ob_start(); ?>

<div class="row">
    <div class="col">
        <p>
            Action non autorisée.
        </p>
        <p>
            Cause(s) :
            <ul>

             <?= $_SESSION["msg"] ?>
             
            </ul>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean(); 

require_once ("layoutRegisterModal.php");
?>