<?php
    session_start();
    include_once('../src/DAO/UserDAO.php'); 

    $user = new UserDAO();

    $compte = unserialize($_SESSION['user']);

    if($_POST['pseudo'] != $compte->getPseudo()){
        if($user->pseudoIsAlreadyTaken($_POST['pseudo']) == true){
            $pseudoError = "Ce pseudo est déja pris !";
            $_SESSION['erreur'] = $pseudoError;
            header("location:http://quizjapan/vue/modifierProfil.php");
        }
    } if($_POST['email'] != $compte->getEmail()) {
        if($user->emailIsAlreadyTaken($_POST['email']) == true){
            $mailErr = "Ce mail est déja pris !";
            $_SESSION['erreur'] = $mailErr;
            header("location:http://quizjapan/vue/modifierProfil.php");
        }
    } else {
        $compte = $user->updateUser($compte->getId(), $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['date'], $_POST['email'], $compte->getPermission()->getId() , $compte->getPoints());
        $user->updatePassword($compte->getId(), $_POST['mdp']);


        $_SESSION['user'] = serialize($compte); 

        $user->close();
        
        header("location:http://quizjapan/vue/menuUtilisateur.php");
    }
    
?>