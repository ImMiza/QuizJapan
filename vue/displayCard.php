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
                            <button type='button' class='card-link btn btn-danger mt-2'>Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>