<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SerieController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$serieController = new SerieController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serieId = $_POST['serie_id'];
    $serieName = $_POST['serie_name'] ?? null;
    $tags = $_POST['tags'] ?? null;
    if(empty($serieName)) return false;
    $serieController->editSerie($serieId, $serieName, $tags);
    header('Location: /index.php?type=series');
}
