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
                <div class="row">
                    <div class="col mt-2 text-center">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../ressources/images/jabba.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Question Star War</h5>
                                <p class="card-text">Viens tester t'es connaissance sur Star War.</p>
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
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>