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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="nav nav-pills nav-stacked friendList">
                            <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li><li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li><li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li><li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li><li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col">
                                <h3>Données personnelle du joueur</h3>
                                <ul class="list-group">
                                    <li class="list-group-item">Adresse Mail : <?php echo $compte->getEmail() ?></li>
                                    <li class="list-group-item">Nom complet : <?php echo $compte->getFirstName() . " " . $compte->getLastName() ?></li>
                                    <li class="list-group-item">Pseudo : <?php echo $compte->getPseudo() ?></li>
                                    <li class="list-group-item">Date de naissance : <?php echo $compte->getBirthDate() ?></li>
                                    <li class="list-group-item">Nombre de points : <?php echo $compte->getPoints() ?></li>
                                </ul>
                                <div class="text-center">
                                    <button onclick=window.location.href='../vue/modifierProfil.php' type="button" class="btn btn-warning mt-4">Modifier les informations</button>
                                    <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-danger mt-4 ml-5">Supprimer son compte</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-5">
                                <h3>Contact</h3>
                                <a>Besoin d'aide pour votre compte ?</a></br>
                                <a>Besoin d'aide pour votre commande ?</a></br>
                                <a>Une réclamation ?</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <article class="card-body text-center">
                                <h4 class="card-title text-center mb-4 mt-1">Êtes vous sur ?</h4>
                                <hr>
                                <form method="POST">
                                    <div class="form-group">
                                        <button onclick=window.location.href='../controllers/suppProfil.php' type="button" name="destruction" id="destruction" class="btn btn-danger">Supprimer son compte</button>
                                    </div>
                                    <p class="text-center">Cette opération est irréversible !</p>
                                </form>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>