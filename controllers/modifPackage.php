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

if(empty($_POST['package']) || empty($_POST['name']) || empty($_POST['description']) || empty($_FILES['image_name']) || empty($_FILES['background_name']) || empty($_POST['themes'])) {
    $_SESSION['erreur'] = "Veuillez remplir tout les champs";
    header("location:http://quizjapan/vue/mesCreations");
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

$package = $cardPackage->getCardPackageById($_POST['package']);
if($package === false || $package->getCreator()->getId() !== $compte->getId()) {
    header("location:http://quizjapan/vue/");
    exit(0);
}

if($_FILES['image_name']['error'] === 0) {
    removeImage($package->getImageName(), "images");
    $image_name = saveImage($_FILES['image_name'], "images");
}
else {
    $image_name = $package->getImageName();
}

if($_FILES['background_name']['error'] === 0) {
    removeImage($package->getBackgroundName(), "backgrounds");
    $background_name = saveImage($_FILES['background_name'], "backgrounds");
}
else {
    $background_name = $package->getBackgroundName();
}

$package = $cardPackage->updateCardPackage($package->getId(), $_POST['name'], $_POST['description'], $image_name, $background_name, $themes, $compte->getId());


if($package === false) {
    $_SESSION['erreur'] = "Erreur modification, veuillez essayer de nouveau";
    header("location:http://quizjapan/vue/modifPackage.php?package=" . $_POST['package']);
    exit(0);
}

$user->close();
$cardPackage->close();
header("location:http://quizjapan/vue/creationCard?package=" . $package->getId());

function saveImage($img, $folder): string
{
    $fileTmpPath = $img['tmp_name'];
    $fileName = $img['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $path_destination = "../ressources/" . $folder . "/" . $newFileName;
    move_uploaded_file($fileTmpPath, $path_destination);
    return $newFileName;
}

function removeImage($name, $folder): bool
{
    $path = "../ressources/" . $folder . "/" . $name;
    return unlink($path);
}