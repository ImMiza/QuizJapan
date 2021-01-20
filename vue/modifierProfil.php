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
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
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
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                                </div>
                                <div class="form-group col-6">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="raisonSocial">Raison social</label>
                                    <input type="text" class="form-control" id="raisonSocial" name="raisonSocial" value="<?php echo $_SESSION['raison']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $_SESSION['adresse']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <label for="ville">Ville</label>
                                    <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $_SESSION['ville']; ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label for="codePostal">Code postal</label>
                                    <input type="number" class="form-control" id="codePostal" name="codePostal" value="<?php echo $_SESSION['codePostal']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="ntel">N° de téléphone</label>
                                    <input type="number" class="form-control" id="ntel" name="ntel" value="<?php echo $_SESSION['tel']; ?>">
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-success mt-4">Modifier les informations</button></div>
                        </form>                    
                    </div>
                </div>           
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>