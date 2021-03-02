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
            <div class="container">
                <div class="row">
                    <div class="col mt-5 text-center">
                        <?php 
                            if(isset($_POST['amountPoint'])){
                                echo"<h3>Bravo vous avez gagnez : " . $_POST['amountPoint'] . "points </h3>";
                                echo"<h5>Nous t'invitons à esssyer tout les autres quiz de la page pour faaire grimper ton score !</h5>";
                            } else {
                                echo"<h3>Bien essayer !</h3>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>