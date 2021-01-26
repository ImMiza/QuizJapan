<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');

            
        ?>
        <?php 
            $Recoverfriend = new UserDAO();
            $friend = $Recoverfriend->getUserById($_GET["id"]);
        ?>

        <main>
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <h3 class="text-center">Données personnelle du joueur :</h3>
                                <div class="text-center mt-2">
                                    <img src="../ressources/profilPicture/Among-Us.png" class="rounded" alt="Photo de l'utilisateur">
                                </div>
                                <ul class="list-group text-center mt-4">
                                    <li class="list-group-item">Adresse Mail : <?php echo $friend->getEmail() ?></li>
                                    <li class="list-group-item">Nom complet : <?php echo $friend->getFirstName() . " " . $friend->getLastName() ?></li>
                                    <li class="list-group-item">Pseudo : <?php echo $friend->getPseudo() ?></li>
                                    <li class="list-group-item">Date de naissance : <?php echo $friend->getBirthDate() ?></li>
                                    <li class="list-group-item">Nombre de points : <?php echo $friend->getPoints() ?></li>
                                </ul>
                                <div class="text-center">
                                    <button type="button" class="btn btn-success mt-4">Ajouter amie</button>
                                    <button type="button" class="btn btn-danger mt-4 ml-5">Supprimer des amies</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>

    </body>
</html>