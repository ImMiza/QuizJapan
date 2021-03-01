<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }
            include_once('../public/template/header.php');

            if(!isset($compte)) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $id_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : -1;
            $id_package = is_numeric($id_package) ? $id_package : -1;

            if($id_package === -1) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $dao = new CardPackageDAO();

            $package = $dao->getCardPackageById($id_package);

            $dao->close();
            if($package === false) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $question_number = 1;
            $amount_question = count($package->getCards());
            $id_card = -1;
            $card_question = "";
            $card_responses = array();

            foreach ($package->getCards() as $card) {
                if($id_card === -1 || $card->getId() < $id_card) {
                    $id_card = $card->getId();
                    $card_question = $card->getQuestion();
                    $card_responses = $card->getFakeAnswer();
                    array_push($card_responses, $card->getAnswer());
                }
            }

            shuffle($card_responses);
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
                                <h5 id="question_amount" class="card-title">Question <?=$question_number?>/<?=$amount_question?></h5>
                                <p id="question" value="<?=$id_card?>" class="card-text"><?=$card_question?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>   
                </div>
                <div id="cards_container" class="row">
                    <?php
                        foreach ($card_responses as $card) {
                    ?>
                    <div class="col-sm">
                        <div class="card pointeurCarte border-primary mb-3 border_card text-primary" style="max-width: 18rem;">
                            <div class="card-body">
                                <p class="card-text"><?=$card?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>
        
        <script defer src="../public/Js/animationCard.js"></script>
        <script>
            var container = document.getElementById("cards_container");
            var amountQuestion = <?=$amount_question?>;
            var Nquestion = $("#question").attr("value");
            $(".pointeurCarte").click(function(event){
                let question_text = $(event.target).text()
                console.log("package=<?=$id_package?>&id_card=" + Nquestion + "&question=" + question_text);
                $.ajax({
                    url : '../src/Game/RequestCardAnswer.php',
                    type: "POST",
                    dataType : 'Json',
                    data: "package=<?=$id_package?>&id_card=" + Nquestion + "&question=" + question_text,
                    success : function(response, statut){
                        console.log(JSON.stringify(response));
                        if(response.error === undefined) {
                            if(response.finish === false) {
                                document.getElementById("question").innerText = response.next_card.card_question;
                                document.getElementById("question_amount").innerText = "Question " + response.next_question_number + "/" + response.amount_question;
                                let answers = response.next_card.fake_answers;
                                answers.push(response.next_card.card_answer);
                                shuffle(answers);

                                setNextQuestion(answers);
                            }
                            else {
                                //TODO Une fois fini on fait quoi
                            }
                        }
                    }
                });
            });
            function shuffle(array) {
                array.sort(() => Math.random() - 0.5);
            }

            function setNextQuestion(array) {
                container.innerText = "";

                array.forEach(question => {
                    createBlock("<div class='card pointeurCarte border-primary mb-3 border_card text-primary' style='max-width: 18rem;'> <div id='rep1' class='card-body'> <p class='card-text'>"+question+"</p> </div> </div>");
                });
            }

            function createBlock(children) {
                let block = document.createElement("div");
                block.className = "col-sm";
                block.innerHTML = children;
                container.appendChild(block);
            }

        </script>
    </body>
</html>