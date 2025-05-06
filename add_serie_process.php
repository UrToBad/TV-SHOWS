<?php
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SerieController.php';

$sqlCredentials = new SqlCredentials();

$connection = new DatabaseConnection($sqlCredentials);
$serieController = new SerieController($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serieName = $_POST['serie_name'] ?? null;
    $tags = $_POST['tags'] ?? [];
    $tags = array_map('trim', $tags);

    $serieController->addSerie($serieName, $tags);
    header('Location: /index.php?type=series');
}
