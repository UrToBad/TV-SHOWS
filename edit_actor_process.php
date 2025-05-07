<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/ActeurController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$acteurController = new ActeurController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acteurId = $_POST['actor_id'];
    $acteurName = $_POST['actor_name'] ?? null;
    $acteurPhoto = $_POST['actor_photo'] ?? null;
    if(empty($acteurName)) return false;
    $acteurController->editActeur($acteurId, $acteurName, $acteurPhoto);
    header('Location: /index.php?type=acteurs');
}
