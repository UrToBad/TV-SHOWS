<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/RealisateurController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$realisateurController = new RealisateurController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $realisateurId = $_POST['director_id'];
    $realisateurName = $_POST['director_name'] ?? null;
    $realisateurPhoto = $_POST['director_photo'] ?? null;
    if(empty($realisateurName)) return false;
    $realisateurController->editRealisateur($realisateurId, $realisateurName, $realisateurPhoto);
    header('Location: /index.php?type=realisateurs');
}