<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1">Connexion</h4>
                    <hr>
                    <form action="../controllers/connexion.php" method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                                </div>
                                <input name="email" id="email" class="form-control" placeholder="Email" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" name="mdp" id="mdp" placeholder="******" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="connexion" id="connexion" class="btn btn-primary btn-block">Connexion</button>
                        </div>
                        <?php
                        if (isset($erreur)) { 
                            echo('<div class="text-center alert alert-danger">');  
                            echo $erreur ;
                            echo('</div>');
                            unset($_SESSION['erreur']);
                        } 
                        ?>
                        <p class="text-center"><a href="#" class="btn">Vous avez perdu votre mot de passe ?</a></p>
                        <p class="text-center"><a href="http://quizjapan/vue/inscription.php" class="btn">Inscription</a></p>
                    </form>
                </article>
            </div>
        </div>
    </div>
</div>