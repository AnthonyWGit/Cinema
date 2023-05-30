<?php ob_start(); ?>

<div class="row">

            <form method="post" action="index.php?action=VerifyInfos" id="form-login" name="login">

                <div class="formDiv">
                    
                        <div class="col">
                            <label>Nom d'utilisateur</label>
                            <input type="text" name="username" id="username-input" placeholder="Entrez votre nom d'utilisateur ici" required>
                        </div>

                        <div class="col">
                            <label>Email</label>
                            <input type="email" name="email" id="email-input" placeholder="Entrez votre email" required>
                        </div>

                        <div class="col">
                            <label>Mot de passe</label>
                            <input type="password" name="password" id="password-input" placeholder="Password" required>
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