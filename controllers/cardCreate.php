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

    $id_package = $_GET['package'];
    $id_package = is_numeric($id_package) ? $id_package : -1;

    if($id_package === -1) {
        header("location:http://quizjapan/vue/");
        exit(0);
    }

    if(empty($_POST['question']) || empty($_POST['goodAnswer']) || empty($_POST['badAnswer'])) {
        $_SESSION['erreur'] = "Veuillez remplir tout les champs";
        header("location:http://quizjapan/vue/creationCard?package=" . $id_package);
        exit(0);
    }

    $limit = 512;
    $count = 0;

    foreach ($_POST['badAnswer'] as $answers) {
        $count = $count + strlen($answers);
    }

    if($count > $limit) {
        $_SESSION['erreur'] = "Vous avez dépassé(e) ma limite des " . $limit . " caractères";
        header("location:http://quizjapan/vue/creationCard?package=" . $id_package);
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

    $cardDAO = new CardDAO();

    $card = $cardDAO->createNewCard($id_package, $_POST['question'], $_POST['goodAnswer'], $badAnswers);
    if($card === false) {
        $cardDAO->close();
        $_SESSION['erreur'] = "Erreur création, veuillez essayer de nouveau";
        header("location:http://quizjapan/vue/creationCard?package=" . $id_package);
        exit(0);
    }

    $cardDAO->close();

    $_SESSION['granted'] = "Création de carte réussi !";
    header("location:http://quizjapan/vue/creationCard?package=" . $id_package);
