<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/EpisodeController.php';

$sqlCredentials = new SqlCredentials();
$databaseConnection = new DatabaseConnection($sqlCredentials);
$episodeController = new EpisodeController($databaseConnection);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $saisonId = $_POST['season_id'];
    $episodeId = $_POST['episode_id'];
    $episodeTitle = $_POST['episode_name'] ?? null;
    $episodeNumber = $_POST['episode_number'] ?? null;
    $episodeSynopsis = $_POST['episode_synopsis'] ?? null;
    $episodeDuration = $_POST['episode_duration'] ?? null;
    $episodeDirectors = $_POST['realisateurs'] ?? null;

    if(empty($episodeNumber) || empty($episodeTitle)) return false;
    $episodeController->editEpisode($episodeId, $episodeTitle, $episodeNumber, $episodeSynopsis, $episodeDuration, $episodeDirectors);
    header('Location: /index.php?type=episodes&id=' . $saisonId);
}
