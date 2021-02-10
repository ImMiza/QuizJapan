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
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
    }

    $id_card = $_GET['card'];
    $id_card = is_numeric($id_card) ? $id_card : -1;

    if($id_card === -1) {
        header("location:http://quizjapan/vue/mesCreations");
        exit(0);
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
    $cardDAO->removeCard($id_card);
    $cardDAO->close();

    header("location:http://quizjapan/vue/displayCard?package=" . $id_package);


