<html lang="fr">
    <?php 
        include_once('../public/template/head.php');
    ?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            } if(isset($_SESSION['sucess'])){
                $sucess = $_SESSION['sucess'];
            }
            include_once('../public/template/header.php');

            if(!isset($compte)) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $id_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : -1;
            $id_package = is_numeric($id_package) ? $id_package : -1;

            if($id_package === -1) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $dao = new CardPackageDAO();

            $package = $dao->getCardPackageById($id_package);

            if($package === false || $package->getCreator()->getId() !== $compte->getId()) {
                $dao->close();
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

        ?>

        <main>
        <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-4">
                        <button onclick=window.location.href='../vue/mesCreations.php' class="btn btn-success">Retour</button>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-center">Modification packet de cartes :</h3>
                        <form action="../controllers/modifPackage.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="name">Nom du jeu de cartes :</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?=$package->getName()?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="label-file" for="image_name">Image du packet de cartes (favorisé des images avec une resolution 360x360)</label>
                                    <input type="file" class="form-control" id="image_name" name="image_name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="background_name">Image de fond d'écran du jeu</label>
                                    <input type="file" class="form-control" id="background_name" name="background_name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="themes">Theme :</label>
                                    <input type="themes" class="form-control" id="themes" name="themes" size="50" value="<?=implode(',', $package->getThemes())?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="description">Description :</label>
                                    <textarea class="form-control" id="description" name="description" aria-label="With textarea"><?=$package->getDescription()?></textarea>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-warning mt-4">Modification packet</button></div>

                            <?php
                                if (isset($erreur)) { 
                                    echo('<div class="text-center alert alert-danger">');  
                                    echo $erreur ;
                                    echo('</div>');
                                    unset($_SESSION['erreur']);
                                } if(isset($sucess)) {
                                    echo('<div class="text-center alert alert-success">');  
                                    echo $sucess;
                                    echo('</div>');
                                    unset($_SESSION['sucess']);
                                } 
                            ?>
                        </form>                    
                    </div>
                </div>           
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>
        <script  src="../public/Js/autocompletionTheme.js"></script>

    <?php
        $dao->close();
    ?>
    </body>
</html>