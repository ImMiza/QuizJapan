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
                            <h1 class="display-4">Mes questions</h1>
                            <button onclick=window.location.href='../vue/creationCard?package=33' type="button" class="btn btn-success mt-2">Créé une carte</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="col mt-2 mb-4 text-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Question N°</h5>
                            <p class="card-text">dasfdqsdfdq</p>
                            <button onclick=window.location.href='../vue/modifCard?package=33&card=1' type='button' class='card-link btn btn-warning mt-2'>Modifier</button>
                            <button onclick=window.location.href='../controllers/cardRemove?package=33&card=1' type='button' class='card-link btn btn-danger mt-2'>Supprimer</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col"></div>
                    <div class="col mt-4 mb-5 text-center">
                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="//quizjapan/vue/displayCard?page=<?=(($page - 1 <= 1) ? 1 : $page - 1)?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Précédent</span>
                                    </a>
                                </li>
                                <?php
                                for($i = 1; $i <= $amount_pages; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='//quizjapan/vue/displayCard?page=".$i."'>".$i."</a></li>";
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="//quizjapan/vue/displayCard?page=<?=(($page + 1 >= $amount_pages) ? $amount_pages : $page + 1)?>" aria-label="Next">
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

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>