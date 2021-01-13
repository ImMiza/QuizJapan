<html lang="fr">
    <?php include_once('../public/template/head.php'); ?>

    <body>
    
        <?php 
            include_once('../public/template/header.php');
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
        ?>

        <main>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-2">
                        <button onclick=window.location.href='../vue' class="btn btn-success">Retour</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <h3 class="text-center pb-4">Inscription</h3>
                        <form action="../controllers/inscription.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="pseudo">Pseudo</label>
                                    <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="mdp">Mot de passe</label>
                                    <input type="password" class="form-control" id="mdp" name="mdp" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="date">Date de naissance</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="inscription" id="inscription" class="btn btn-success mt-4">Inscription</button>
                                <?php
                                if (isset($erreur)) { 
                                    echo('<div class="text-center mt-4 alert alert-danger">');  
                                    echo $erreur;
                                    echo('</div>');
                                    unset($_SESSION['erreur']);
                                } 
                                ?>
                            </div>
                        </form>                    
                    </div>
                </div>           
            </div>  
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>