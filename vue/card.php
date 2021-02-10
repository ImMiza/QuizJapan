<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');
        ?>

        <main style="background-image: url('../ressources/images/espace.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="container-fluid text-center">
                <h1 class="display-4 text-primary">Jeux de Cartes</h1>
            </div>
            <div class="container">
                <div class="row mt-5">
                    <div class="col"></div>
                    <div class="col mt-4 mb-5 text-center">
                        <div class="card text-white bg-primary mb-3" style="max-width: 48rem;">
                            <div class="card-header">Valeur : 15 points</div>
                            <div class="card-body">
                                <h5 class="card-title">Question 1/20</h5>
                                <p id="question" value="33" class="card-text">Combient de couille à Jabba le hutt ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>   
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div id="rep1Border" class="card pointeurCarte border-primary mb-3 border_card text-primary" style="max-width: 18rem;">
                            <div id="rep1" class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="rep2Border" class="card pointeurCarte border-primary mb-3 border_card text-primary" style="max-width: 18rem;">
                            <div id="rep2" class="card-body">
                                <p class="card-text">Some quick example text to build o card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="rep3Border" class="card pointeurCarte border-primary mb-3 border_card text-primary" style="max-width: 18rem;">
                            <div id="rep3" class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cae card title and make up the bulk of the card's cone card title and make up the bulk of the card's cone card title and make up the bulk of the card's cone card title and make up the bulk of the card's conrd's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="rep4Border" class="card pointeurCarte border-primary mb-3 border_card text-primary" style="max-width: 18rem;">
                            <div id="rep4" class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>
        
        <script defer src="../public/Js/animationCard.js"></script>
        <script>
            var Nquestion = $("#question").attr("value");
            $(".pointeurCarte").click(function(){
                $.ajax({
                    url : '../src/Game/testMessage.php',
                    type: "POST",
                    dataType : 'Json',
                    data: "card=" + Nquestion,
                    success : function(response, statut){ 
                        alert(response.correct);
                    }
                });
            });
        </script>
    </body>
</html>