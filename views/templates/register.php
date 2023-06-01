<?php ob_start(); ?>

<div class="row">

            <form method="post" action="index.php?action=checkInfos" class="yyy" id="form-register" name="registration">

                <div class="formDiv">
                    
                        <div class="col">
                            <label>Nom d'utilisateur</label>
                            <input type="text" name="username" id="username-input" placeholder="Entrez votre nom d'utilisateur ici" required>
                        </div>

                        <div class="col">
                            <label>Nom</label>
                            <input type="text" name="name" id="name-input" placeholder="Entrez votre nom ici" required>
                        </div>

                        <div class="col">
                            <label>Prénom</label>
                            <input type="text" name="forename" id="forename-input" placeholder="Entrez votre prénom" required>
                        </div>

                        <div class="col">
                            <label>Email</label>
                            <input type="email" name="email" id="email-input" placeholder="Entrez votre email" required>
                        </div>

                        <div class="col">
                            <label>Mot de passe</label>
                            <input type="password" name="password" id="password-input" placeholder="Password" required>
                        </div>

                        
                        <div class="col">
                            <label>Confirmez le mot de passe</label>
                            <input type="password" name="password-confirm" id="password-input-confirm" placeholder="Password" required>
                        </div>
                        
                        <noscript>
                            <div class="divBtn">
                                <button type="submit">Valider</button>
                            </div>
                        </noscript>

                    <!-- Button trigger modal -->
                    <div class="divBtn2">
                        <!-- <button value="registration" class="btn btn-primary" id="password-input-confirm-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Valider
                        </input> -->
                    </div>
                </div>
            </form>

</div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe src="" name="iframe" id="iframe" frameborder="0" width="100%" height="300px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>

<?php
$content = ob_get_clean(); 
require_once ("layoutRegister.php");
?>