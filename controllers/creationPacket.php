<?php
    session_start();
    include_once('../src/DAO/UserDAO.php');
    include_once('../src/DAO/CardPackageDAO.php'); 

    $user = new UserDAO();
    $cardPackage = new CardPackageDAO();

    $compte = unserialize($_SESSION['user']);

    $cardPackage->createNewCardPackage($_POST['name'], $_POST['description'], $_POST['image_name'], $_POST['background_name'], $_POST['themes']);

    $_SESSION['sucess'] = "Votre packet de carte est créé !";

    $user->close();
    
    header("location:http://quizjapan/vue/");
?>