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
                            <h1 class="display-4">Bienvenue sur QuizJapan un site éducatif pour petit et grand !</h1>
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
                                <?php
                                    $dao = new UserDAO();

                                    $list_winner = $dao->getRank(5);
                                    if($list_winner === false) {
                                        die('probleme chef');
                                    }

                                    if(!empty($list_winner)) {
                                        $winner = $list_winner[0];
                                        echo "<li id='' class='list-group-item list-group-item-warning'>".$winner->getPseudo() . "<span> <i class='fas fa-trophy'></i></span>" . " " . $winner->getPoints() . " ". "points" ."</li>";
                                        array_shift($list_winner);
                                    }

                                    foreach($list_winner as $user) {
                                        echo "<li class='list-group-item'>".$user->getPseudo() . " " . $user->getPoints() . " " . "points" . "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>