<?php
session_start();
include_once('../src/DAO/CardPackageDAO.php');

if(!isset($_SESSION['user'])) {
    header("location:http://quizjapan/vue/");
    exit(0);
}

$user = unserialize($_SESSION['user']);

$id_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : -1;
$id_package = is_numeric($id_package) ? $id_package : -1;

if($id_package === -1) {
    header("location:http://quizjapan/vue/mesCreations");
    exit(0);
}

$dao = new CardPackageDAO();

$package = $dao->getCardPackageById($id_package);

if($package === false || $package->getCreator()->getId() !== $user->getId()) {
    $dao->close();
    header("location:http://quizjapan/vue/mesCreations");
    exit(0);
}

$dao->removeCardPackage($id_package);
$dao->close();

header("location:http://quizjapan/vue/mesCreations");