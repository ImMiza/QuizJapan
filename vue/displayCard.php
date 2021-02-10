<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');

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
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-0">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">Mes questions</h1>
                            <button onclick=window.location.href="../vue/creationCard?package=<?=$id_package?>" type="button" class="btn btn-success mt-2">Créé une carte</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
            
            <?php
                $card_by_rows = 5;
                $question = 1;
                $i = 0;
                echo "<div class='row'>";
                foreach ($package->getCards() as $card) {
                if($i >= $card_by_rows) {
                    echo "</div>";
                    echo "<div class='row'>";
                    $i = 0;
                }
                $i = $i + 1;
            ?>

            
                <div class="col mt-2 mb-4 text-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Question N°<?=$question?></h5>
                            <p class="card-text"><?=$card->getQuestion()?></p>
                            <button onclick=window.location.href="../vue/modifCard?package=<?=$package->getId()?>&card=<?=$card->getId()?>" type='button' class='card-link btn btn-warning mt-2'>Modifier</button>
                            <button onclick=window.location.href="../controllers/cardRemove?package=<?=$package->getId()?>&card=<?=$card->getId()?>" type='button' class='card-link btn btn-danger mt-2'>Supprimer</button>
                        </div>
                    </div>
                </div>

                <?php
                    $question = $question + 1;
                    }
                    echo "</div>";
                ?>
            </div>

        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>