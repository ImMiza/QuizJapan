<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php include_once('../public/template/header.php');
        if(isset($_SESSION['erreur'])){
            $erreur = $_SESSION['erreur'];
        }
        ?>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-0">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">Bienvenue sur QuizJapan un site éducatif pour petit est grand !</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col mt-2 text-center">
                        <h1 class="display-5">Classement des joueurs :</h1>
                        <div class="list-group">
                            <ul class="list-group">
                                <li id="" class="list-group-item list-group-item-warning">XXx_Dark$a$uke_xXX<span> <i class="fas fa-trophy"></i></span></li>
                                <li class="list-group-item">PlatypussKiller</li>
                                <li class="list-group-item">Hour lord and savior harambe</li>
                                <li class="list-group-item">Sonique</li>
                                <li class="list-group-item">darkVador</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>