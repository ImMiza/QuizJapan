<?php
    session_start();
    include_once('../src/DAO/UserDAO.php');

    $compte = unserialize($_SESSION['user']);
    if(!isset($compte)) {
        header("location:http://quizjapan/vue/");
        exit(0);
    }

    if(empty($_GET['package'])) {
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
    }

    $id_package = isset($_GET['package']) ? $_GET['package'] : -1;
    $id_package = is_numeric($id_package) ? $id_package : -1;

    if($id_package === -1) {
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
    }

    $id_card = isset($_GET['card']) ? $_GET['card'] : -1;
    $id_card = is_numeric($id_card) ? $id_card : -1;

    if($id_card === -1) {
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
    }

    if(empty($_POST['question']) || empty($_POST['goodAnswer']) || empty($_POST['badAnswer'])) {
        $_SESSION['erreur'] = "Veuillez remplir tout les champs";
        header("location:http://quizjapan/vue/modifCard?package=" . $id_package . "&card=" . $id_card);
        exit(0);
    }

    $limit = 512;
    $count = 0;

    foreach ($_POST['badAnswer'] as $answers) {
        $count = $count + strlen($answers);
    }

    if($count > $limit) {
        $_SESSION['erreur'] = "Vous avez dépassé(e) ma limite des " . $limit . " caractères";
        header("location:http://quizjapan/vue/modifCard?package=" . $id_package . "&card=" . $id_card);
        exit(0);
    }

    $badAnswers = array();
    foreach ($_POST['badAnswer'] as $answers) {
        array_push($badAnswers, $answers);
    }

    include_once('../src/DAO/CardPackageDAO.php');

    $packageDAO = new CardPackageDAO();
    $package = $packageDAO->getCardPackageById($id_package);
    if($package === false || $package->getCreator()->getId() !== $compte->getId()) {
        $packageDAO->close();
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
    }

    $packageDAO->close();

    $card = null;
    foreach ($package->getCards() as $c) {
        var_dump($c->getId() . " == " . $id_card);
        if($id_card == $c->getId()) {
            $card = $c;
        }
    }

    if($card === null) {
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
    }


    $cardDAO = new CardDAO();
    $card = $cardDAO->updateCard($id_card, $id_package, $_POST['question'], $_POST['goodAnswer'], $badAnswers);
    $cardDAO->close();

    if($card === false) {
        header("location:http://quizjapan/vue/modifCard?package=" . $id_package . "&card=" . $id_card);
        exit(0);
    }

    header("location:http://quizjapan/vue/displayCard?package=" . $id_package);