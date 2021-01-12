<?php
    include_once('../src/DAO/UserDAO.php'); 

    $user = new UserDAO();

    // if($user->pseudoIsAlreadyTaken($_POST['pseudo']) == true){
    //     $pseudoError = "Ce pseudo est déja pris !";

    //     header("location:http://quizjapan/vue/inscription.php");
    // }

    // if($user->emailIsAlreadyTaken($_POST['email']) == true){
    //     $mailErr = "Ce mail est déja pris !";
    //     $GLOBALS['mailErr'] = $mailErr;
    //     header("location:http://quizjapan/vue/inscription.php");
    // }

    // $compte = $user->createNewUser($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['date'], $_POST['email'], $_POST['mdp'], UserDAO::$USER_PERMISSION, 0);

    // $_SESSION['user'] = serialize($compte); 

    // $user->close();
    
    // header("location:http://quizjapan/vue/");

    echo('lol');
    if($user->pseudoIsAlreadyTaken($_POST['pseudo']) == true){
            $pseudoError = "Ce pseudo est déja pris !";
    
            header("location:http://quizjapan/vue/inscription.php");
        }
?>