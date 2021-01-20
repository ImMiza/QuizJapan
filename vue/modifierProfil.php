<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');
        ?>
    
        <?php include_once('../public/template/header.php'); ?>

        <main>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-2">
                        <button onclick=window.location.href='../vue/menuUtilisateur.php' class="btn btn-success">Retour</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <h3 class="text-center">Données personnelle du clients</h3>
                        <form action="../controllers/modifProfil.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $compte->getEmail() ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="mdp">Mot de passe</label>
                                    <input type="text" class="form-control" id="mdp" name="mdp" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $compte->getLastName() ?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $compte->getFirstName() ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="raisonSocial">Pseudo</label>
                                    <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo $compte->getPseudo() ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="adresse">Date de naissance</label>
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $compte->getBirthDate() ?>" required>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-success mt-4">Modifier les informations</button></div>

                            <?php
                                if (isset($erreur)) { 
                                    echo('<div class="text-center alert alert-danger">');  
                                    echo $erreur ;
                                    echo('</div>');
                                    unset($_SESSION['erreur']);
                                } 
                            ?>
                        </form>                    
                    </div>
                </div>           
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>