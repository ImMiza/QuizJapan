<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');

            if(!isset($compte)) {
                header('location:http://quizjapan/vue/');
                exit(0);
            }
        ?>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-0">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">Mes créations</h1>
                            <div class="text-center">
                                <button onclick=window.location.href='../vue/creationPackage.php' type="button" class="btn btn-success mt-2">Créé un packet de carte</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

                <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $page = is_numeric($page) ? $page : 1;
                    $limit = 15;
                    $package_by_rows = 5;

                    $dao = new CardPackageDAO();
                    $amount_package = $dao->getCardPackagesAmountByCreator($compte->getId());
                    $amount_pages = ceil($amount_package / $limit);
                    $amount_pages = $amount_pages == 0 ? 1 : $amount_pages;
                    $i = 0;
                    $offset = (1 <= $page && $page <= $amount_pages) ? (($page - 1) * $limit) : 0;

                    $list = $dao->getCardPackagesByCreator($compte->getId(), $limit, $offset);
                    $list = $list === false ? array() : $list;

                    echo "<div class='row'>";
                foreach ($list as $package) {
                        if($i >= $package_by_rows) {
                            echo "</div>";
                            echo "<div class='row'>";
                            $i = 0;
                        }
                        $i = $i + 1;
                ?>

                <div class="col mt-2 mb-4 text-center">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?=$package->getImagePath()?>" alt="Card image cap">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?=$package->getName()?></h5>
                            <p class="card-text"><?=$package->getDescription()?></p>
                            <button type='button' class='card-link btn btn-success mt-2'>Jouer</button>
                            <button onclick=window.location.href='../vue/modifPackage.php?package=<?=$package->getId()?>' type='button' class='card-link btn btn-warning mt-2'>Modifier</button>
                            <button onclick=window.location.href='../controllers/suppPackage?package=<?=$package->getId()?>' type='button' class='card-link btn btn-danger mt-2 mr-3'>Supprimer</button>
                        </div>
                    </div>
                </div>

                <?php
                    }
                    echo "</div>";
                ?>

                <div class="row mt-5">
                    <div class="col"></div>
                    <div class="col mt-4 mb-5 text-center">
                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="//quizjapan/vue/mesCreations?page=<?=(($page - 1 <= 1) ? 1 : $page - 1)?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Précédent</span>
                                    </a>
                                </li>
                                <?php
                                for($i = 1; $i <= $amount_pages; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='//quizjapan/vue/mesCreations?page=".$i."'>".$i."</a></li>";
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="//quizjapan/vue/mesCreations?page=<?=(($page + 1 >= $amount_pages) ? $amount_pages : $page + 1)?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Suivant</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col"></div>   
                </div>

            </div>
        </main>

        <?php
        $dao->close();
        ?>

        <?php include_once('../public/template/footer.php'); ?>
    </body>
</html>