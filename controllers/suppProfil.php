<?php
    session_start();
    include_once('../src/DAO/UserDAO.php'); 

    $user = new UserDAO();

    $compte = unserialize($_SESSION['user']);

    $user->removeUser($compte->getId());

    $user->close();

    session_destroy(); //Paf la session meurt
    unset($_SESSION);
    
    header("location:http://quizjapan/vue/");
    
?>