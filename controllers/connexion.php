<?php
    session_start();
    include_once('../src/DAO/UserDAO.php'); 

    $user = new UserDAO();

    $compte = $user->getUser($_POST['email'], $_POST['mdp']);

    if($compte == false){
        $logerror = "Identifiant erroné";
        $_SESSION['erreur'] = $logerror;
    } else {
        $_SESSION['user'] = serialize($compte);
    }

    $user->close();
    
    header("location:http://quizjapan/vue/");
?>