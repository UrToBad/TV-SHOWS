<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SaisonController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$saisonController = new SaisonController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serieId = $_POST["serie_id"] ?? null;
    $saisonId = $_POST['season_id'];
    $saisonName = $_POST['season_name'] ?? null;
    $saisonNumber = $_POST['season_number'] ?? null;
    $saisonPoster = $_POST['season_poster'] ?? null;
    $saisonCasting = $_POST['actors'] ?? null;
    if(empty($saisonName) || empty($saisonNumber)) return false;
    $saisonController->editSaison($saisonId, $saisonName, $saisonNumber, $saisonPoster, $saisonCasting);
    header('Location: /index.php?type=saisons&id=' . $serieId);
}

