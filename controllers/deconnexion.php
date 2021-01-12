<?php   
session_start(); //On s'assure que tu récupére la bonne session
$_SESSION = array();
session_destroy(); //Paf la session meurt
unset($_SESSION);
header("location:http://quizjapan/vue/"); //une fosi deconnecter on retourne a l'acceuille merci bonsoir
?>