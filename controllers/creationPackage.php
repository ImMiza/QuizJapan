<?php
    session_start();
    include_once('../src/DAO/CardPackageDAO.php');

    $user = new UserDAO();
    $cardPackage = new CardPackageDAO();

    $compte = unserialize($_SESSION['user']);
    if(!isset($compte)) {
        header("location:http://quizjapan/vue/");
        exit(0);
    }

    if(empty($_POST['name']) || empty($_POST['description']) || empty($_FILES['image_name']) || empty($_FILES['background_name']) || empty($_POST['themes'])) {
        $_SESSION['erreur'] = "Veuillez remplir tout les champs";
        header("location:http://quizjapan/vue/creationPackage.php");
        exit(0);
    }

    $themes = strpos($_POST['themes'], ',') !== false ? explode(",", $_POST['themes']) : array($_POST['themes']);
    for($i = 0; $i < count($themes); $i++) {
        if($themes[$i] == "") {
            unset($themes[$i]);
            $i--;
        }
        $i++;
    }

    $image_name = saveImage($_FILES['image_name'], "images");
    $background_name = saveImage($_FILES['background_name'], "backgrounds");

    $package = $cardPackage->createNewCardPackage($_POST['name'], $_POST['description'], $image_name, $background_name, $themes, $compte->getId());

    if($package === false) {
        $_SESSION['erreur'] = "Erreur création, veuillez essayer de nouveau";
        header("location:http://quizjapan/vue/creationPackage.php");
        exit(0);
    }

    $user->close();
    $cardPackage->close();
    
    header("location:http://quizjapan/vue/creationCard?package=" . $package->getId());

    function saveImage($img, $folder) {
        $fileTmpPath = $img['tmp_name'];
        $fileName = $img['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $path_destination = "../ressources/" . $folder . "/" . $newFileName;
        move_uploaded_file($fileTmpPath, $path_destination);
        return $newFileName;
    }