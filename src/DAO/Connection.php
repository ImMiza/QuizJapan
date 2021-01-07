<?php

$the_quiz_connect = mysqli_connect("localhost", "root", "", "thequiz");

if(!$the_quiz_connect) {
    die("Erreur: Impossible de se connecter à la base de donnée");
}

mysqli_set_charset($the_quiz_connect, "utf8");