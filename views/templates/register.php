<?php ob_start(); ?>

<div class="row">

            <form method="post" action="index.php?action=CheckPassword" id="form-register" name="registration">

                <div class="formDiv">
                    
                        <div class="col">
                            <label>Nom d'utilisateur</label>
                            <input type="text" name="username" id="username-input" value="Entrez votre nom d'utilisateur ici" required>
                        </div>

                        <div class="col">
                            <label>Nom</label>
                            <input type="text" name="username" id="username-input" value="Entrez votre nom ici" required>
                        </div>

                        <div class="col">
                            <label>Prénom</label>
                            <input type="text" name="username" id="username-input" value="Entrez votre prénom" required>
                        </div>

                        <div class="col">
                            <label>Email</label>
                            <input type="email" name="username" id="username-input" value="Entrez votre email" required>
                        </div>
                        
                        <div class="divBtn">
                            <button type="submit">Valider</button>
                        </div>

                </div>

            </form>

</div>

<?php
$content = ob_get_clean(); 
require_once ("layoutRegister.php");
?>