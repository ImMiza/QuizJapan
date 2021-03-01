<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');
        ?>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-0">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">Bibliothèque</h1>
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
                    $amount_package = $dao->getCardPackagesAmount();
                    $amount_pages = ceil($amount_package / $limit);
                    $amount_pages = $amount_pages == 0 ? 1 : $amount_pages;
                    $i = 0;
                    $offset = (1 <= $page && $page <= $amount_pages) ? (($page - 1) * $limit) : 0;

                    if(isset($_POST['navbar_submit_button'])) {
                        $search = isset($_POST['navbar_search_button']) ? $_POST['navbar_search_button'] : "";
                        $list = $dao->searchCardPackage($search, $limit, $offset);
                    }
                    else {
                        $list = $dao->getCardPackages($limit, $offset);
                    }
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
                        <img style="width:18em; height: 13em;" class="img-fluid resizeCard" src="<?=$package->getImagePath()?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?=$package->getName()?></h5>
                            <p class="card-text"><?=$package->getDescription()?></p>
                            <?php
                                if(isset($compte)){
                                    if(count($package->getCards()) > 0){
                                        echo("<a href='../vue/intermede.php?package=" .  $package->getId()  . "' class='btn btn-success'>Jouer</a>");
                                    }
                                } else {
                                    echo("<p class='text-danger'>Il faut te connecter pour jouer</p>");
                                }
                            ?>
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
                                    <a class="page-link" href="//quizjapan/vue/bibliotheque?page=<?=(($page - 1 <= 1) ? 1 : $page - 1)?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Précédent</span>
                                    </a>
                                </li>
                                <?php
                                for($i = 1; $i <= $amount_pages; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='//quizjapan/vue/bibliotheque?page=".$i."'>".$i."</a></li>";
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="//quizjapan/vue/bibliotheque?page=<?=(($page + 1 >= $amount_pages) ? $amount_pages : $page + 1)?>" aria-label="Next">
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