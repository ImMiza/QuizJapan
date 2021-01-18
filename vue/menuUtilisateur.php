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
            <p>Bienvenue dans votre espace</p>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>