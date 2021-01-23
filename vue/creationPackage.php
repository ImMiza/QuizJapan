<html lang="fr">
    <?php 
        include_once('../public/template/head.php');
        include_once('../src/DAO/ThemeDAO.php');
        $theme = new ThemeDAO();
    ?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            } if(isset($_SESSION['sucess'])){
                $sucess = $_SESSION['sucess'];
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
                        <h3 class="text-center">Création du packet de cartes</h3>
                        <form action="../controllers/creationPacket.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="name">Nom du jeu de cartes</label>
                                    <input type="email" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="image_name">Image du packet de cartes</label>
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
                                    <select class="rounded" name="themes" id="themes">
                                        <option value="">--Please choose an option--</option>
                                        <option value="dog">Dog</option>
                                        <option value="cat">Cat</option>
                                        <option value="hamster">Hamster</option>
                                        <option value="parrot">Parrot</option>
                                        <option value="spider">Spider</option>
                                        <option value="goldfish">Goldfish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="description">Description</label>
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

    </body>
</html>