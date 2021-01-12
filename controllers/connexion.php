<?php
    include_once('../src/DAO/UserDAO.php'); 

    $user = new UserDAO;

    $user->getUser($_POST['email'], $_POST['mdp']);

    $_SESSION['user'] = serialize($user); 

    $user->close();
    
    header("location:http://quizjapan/vue/");
?>