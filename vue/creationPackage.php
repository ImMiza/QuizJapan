<html lang="fr">
    <?php 
        include_once('../public/template/head.php');
    ?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');
        ?>

        <main>
        <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-4">
                        <button onclick=window.location.href='../vue/menuUtilisateur.php' class="btn btn-success">Retour</button>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-center">Création du packet de cartes :</h3>
                        <form action="../controllers/creationPackage.php" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="name">Nom du jeu de cartes :</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="label-file" for="image_name">Image du packet de cartes (favorisé des images avec une resolution 360x360)</label>
                                    <input type="file" class="form-control" id="image_name" name="image_name" accept="image/*" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="background_name">Image de fond d'écran du jeu</label>
                                    <input type="file" class="form-control" id="background_name" name="background_name" accept="image/*" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="themes">Theme :</label>
                                    <input type="themes" class="form-control" id="themes" name="themes" size="50" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="description">Description :</label>
                                    <textarea class="form-control" id="description" name="description" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-success mt-4">Création du packet</button></div>

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
        <script  src="../public/Js/autocompletionTheme.js"></script>

    </body>
</html>