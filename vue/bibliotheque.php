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
                    $limit = 40;


                    $dao = new CardPackageDAO();
                    $amount_package = $dao->getCardPackagesAmount();
                    $amount_pages = ceil($amount_package / $limit);
                    $amount_pages = $amount_pages == 0 ? 1 : $amount_pages;
                    $i = 1;

                    $offset = (1 <= $page && $page <= $amount_pages) ? (($page - 1) * $limit) : 0;

                    echo "<div class='row'>";
                    foreach ($dao->getCardPackages($limit, $offset) as $package) {
                        if($i === 0) {
                            echo "</div>";
                            echo "<div class='row'>";
                        }
                        $i = ($i + 1) % 6;

                ?>

                <div class="col mt-2 text-center">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?=$package->getImagePath()?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?=$package->getName()?></h5>
                            <p class="card-text"><?=$package->getDescription()?></p>
                            <?php
                                if(isset($compte)){
                                    echo("<a href='#' class='btn btn-primary'>Jouer</a>");
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

            </div>

            <nav aria-label="Pagination">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
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
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </main>

        <?php
        $dao->close();
        ?>

        <?php include_once('../public/template/footer.php'); ?>
    </body>
</html>