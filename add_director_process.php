<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/RealisateurController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$directorController = new RealisateurController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $directorName = $_POST['director_name'] ?? null;
    if(empty($directorName)) return false;
    $directorPhoto = $_POST['director_photo'] ?? null;
    $directorController->createRealisateur($directorName, $directorPhoto);
    header('Location: /index.php?type=realisateurs');
}
