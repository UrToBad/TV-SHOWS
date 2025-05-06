<?php
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SaisonController.php';


$sqlCredentials = new SqlCredentials();

$connection = new DatabaseConnection($sqlCredentials);
$seasonController = new SaisonController($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $serieId = $_POST['serie_id'] ?? null;
    $seasonName = $_POST['season_name'] ?? null;
    $seasonNumber = $_POST['season_number'] ?? null;
    $seasonPoster = $_POST['season_poster'] ?? null;
    $actors = $_POST['actors'] ?? [];

    if (empty($serieId) || empty($seasonName) || empty($seasonNumber)) {
        die('Tous les champs obligatoires doivent être remplis.');
    }

    $seasonController->addSeason($serieId, $seasonName, $seasonNumber, $seasonPoster, $actors);

    header('Location: /index.php?type=saisons&id=' . $serieId);
}