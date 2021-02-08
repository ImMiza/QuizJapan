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

            if(!isset($compte)) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $id_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : -1;
            $id_package = is_numeric($id_package) ? $id_package : -1;
            $id_card = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : -1;
            $id_card = is_numeric($id_package) ? $id_package : -1;

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
                        <button onclick=window.location.href='../vue/displayCard.php' class="btn btn-success">Retour aux cartes</button>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-center">Modification d'une carte :</h3>
                        <form action="../controllers/cardModification.php?package=<?= $id_package ?>&card=1" method="POST" enctype="multipart/form-data">
                            <div id="questionaire">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="name">Question</label>
                                        <input type="text" class="form-control" id="question" name="question" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="name">Bonne réponse</label>
                                        <input type="text" class="form-control" id="goodAnswer" name="goodAnswer" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="name">Mauvaise réponse</label>
                                        <input type="text" class="form-control badAnswer" name="badAnswer[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center"><span name="addQuesttion" id="addQuestion" class="btn btn-success mt-4">Ajouter une question</span></div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-warning mt-4">Modification de la carte</button></div>
                                </div>
                            </div>
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
        
        <script  src="../public/Js/answerCreate.js"></script>

    </body>
</html>