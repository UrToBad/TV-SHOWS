<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/ActeurController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$actorController = new ActeurController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actorName = $_POST['actor_name'] ?? null;
    if(empty($actorName)) return false;
    $actorPhoto = $_POST['actor_photo'] ?? null;
    $actorController->createActeur($actorName, $actorPhoto);
    header('Location: /index.php?type=acteurs');
}
