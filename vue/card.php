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
                                <p class="card-text">Combient de couille à Jabba le hutt ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>   
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div id="rep1Border" class="card pointeurCarte border-primary mb-3" style="max-width: 18rem;">
                            <div id="rep1" class="card-body text-primary">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="rep2Border" class="card pointeurCarte border-primary mb-3" style="max-width: 18rem;">
                            <div id="rep2" class="card-body text-primary">
                                <p class="card-text">Some quick example text to build o card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="rep3Border" class="card pointeurCarte border-primary mb-3" style="max-width: 18rem;">
                            <div id="rep3" class="card-body text-primary">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cae card title and make up the bulk of the card's cone card title and make up the bulk of the card's cone card title and make up the bulk of the card's cone card title and make up the bulk of the card's conrd's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="rep4Border" class="card pointeurCarte border-primary mb-3" style="max-width: 18rem;">
                            <div id="rep4" class="card-body text-primary">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>
        
        <script defer>
            let texte = document.getElementById("rep1");
            let bordure = document.getElementById("rep1Border");
            document.getElementById("rep1Border").addEventListener("mouseover", mouseOver);
            document.getElementById("rep1Border").addEventListener("mouseout", mouseOut);
            document.getElementById("rep1").addEventListener("click", answer);

            function mouseOver() {
                if(bordure.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure.className = "card pointeurCarte border-success bg-success text-white mb-3"
                    texte.className = "card-body";
                }
            };
            function mouseOut() {
                if(bordure.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure.className = "card pointeurCarte border-primary mb-3"
                    texte.className = "card-body text-primary";
                }
            };

            function answer() {
                if(bordure.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure.className = "card pointeurCarte border-success bg-success text-white active mb-3"
                    texte.className = "card-body";
                } else {
                    bordure.className = "card pointeurCarte border-primary mb-3"
                    texte.className = "card-body text-primary";
                }
            }
        </script>

        <script defer>
            let texte2 = document.getElementById("rep2");
            let bordure2 = document.getElementById("rep2Border");
            document.getElementById("rep2Border").addEventListener("mouseover", mouseOver);
            document.getElementById("rep2Border").addEventListener("mouseout", mouseOut);
            document.getElementById("rep2").addEventListener("click", answer);

            function mouseOver() {
                if(bordure2.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure2.className = "card pointeurCarte border-success bg-success text-white mb-3"
                    texte2.className = "card-body";
                }
            };
            function mouseOut() {
                if(bordure2.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure2.className = "card pointeurCarte border-primary mb-3"
                    texte2.className = "card-body text-primary";
                }
            };

            function answer() {
                if(bordure2.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure2.className = "card pointeurCarte border-success bg-success text-white active mb-3"
                    texte2.className = "card-body";
                } else {
                    bordure2.className = "card pointeurCarte border-primary mb-3"
                    texte2.className = "card-body text-primary";
                }
            }
        </script>

        <script defer>
            let texte3 = document.getElementById("rep3");
            let bordure3 = document.getElementById("rep3Border");
            document.getElementById("rep3Border").addEventListener("mouseover", mouseOver);
            document.getElementById("rep3Border").addEventListener("mouseout", mouseOut);
            document.getElementById("rep3").addEventListener("click", answer);

            function mouseOver() {
                if(bordure3.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure3.className = "card pointeurCarte border-success bg-success text-white mb-3"
                    texte3.className = "card-body";
                }
            };
            function mouseOut() {
                if(bordure3.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure3.className = "card pointeurCarte border-primary mb-3"
                    texte3.className = "card-body text-primary";
                }
            };

            function answer() {
                if(bordure3.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure3.className = "card pointeurCarte border-success bg-success text-white active mb-3"
                    texte3.className = "card-body";
                } else {
                    bordure3.className = "card pointeurCarte border-primary mb-3"
                    texte3.className = "card-body text-primary";
                }
            }
        </script>

        <script defer>
            let texte4 = document.getElementById("rep4");
            let bordure4 = document.getElementById("rep4Border");
            document.getElementById("rep4Border").addEventListener("mouseover", mouseOver);
            document.getElementById("rep4Border").addEventListener("mouseout", mouseOut);
            document.getElementById("rep4").addEventListener("click", answer);

            function mouseOver() {
                if(bordure4.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure4.className = "card pointeurCarte border-success bg-success text-white mb-3"
                    texte4.className = "card-body";
                }
            };
            function mouseOut() {
                if(bordure4.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure4.className = "card pointeurCarte border-primary mb-3"
                    texte4.className = "card-body text-primary";
                }
            };

            function answer() {
                if(bordure4.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure4.className = "card pointeurCarte border-success bg-success text-white active mb-3"
                    texte4.className = "card-body";
                } else {
                    bordure4.className = "card pointeurCarte border-primary mb-3"
                    texte4.className = "card-body text-primary";
                }
            }
        </script>

        <script defer>
            let texte5 = document.getElementById("rep5");
            let bordure5 = document.getElementById("rep5Border");
            document.getElementById("rep5Border").addEventListener("mouseover", mouseOver);
            document.getElementById("rep5Border").addEventListener("mouseout", mouseOut);
            document.getElementById("rep5").addEventListener("click", answer);

            function mouseOver() {
                if(bordure5.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure5.className = "card pointeurCarte border-success bg-success text-white mb-3"
                    texte5.className = "card-body";
                }
            };
            function mouseOut() {
                if(bordure5.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure5.className = "card pointeurCarte border-primary mb-3"
                    texte5.className = "card-body text-primary";
                }
            };

            function answer() {
                if(bordure5.className != 'card pointeurCarte border-success bg-success text-white active mb-3'){
                    bordure5.className = "card pointeurCarte border-success bg-success text-white active mb-3"
                    texte5.className = "card-body";
                } else {
                    bordure5.className = "card pointeurCarte border-primary mb-3"
                    texte5.className = "card-body text-primary";
                }
            }
        </script>

    </body>
</html>