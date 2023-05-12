<?php ob_start() ?>
<div class="alignCol">
    <div class="alignRow">
        <form method="post" action="index.php?action=editSynopsis">

            <textarea name="editSynopsis"> Créez un synopsis </textarea>

        </form>
    </div>
</div>
<?php 
$content = ob_get_clean();
require ("layoutSynopsis.php");