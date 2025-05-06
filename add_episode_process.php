<?php
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/EpisodeController.php';
require_once 'controller/RealisateurController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seasonId = $_POST['season_id'] ?? null;
    $episodeName = $_POST['episode_name'] ?? null;
    $episodeNumber = $_POST['episode_number'] ?? null;
    $episodeSynopsis = $_POST['episode_synopsis'] ?? null;
    $episodeDuration = $_POST['episode_duration'] ?? null;
    $directors = $_POST['realisateurs'] ?? [];

    if (!$seasonId || !$episodeName || !$episodeNumber || !$episodeSynopsis || !$episodeDuration) {
        die('Tous les champs sont obligatoires.');
    }

    $sqlCredentials = new SqlCredentials();
    $dbConnection = new DatabaseConnection($sqlCredentials);
    $episodeController = new EpisodeController($dbConnection);
    $episodeId = $episodeController->addEpisode($seasonId, $episodeName, $episodeNumber, $episodeSynopsis, $episodeDuration, $directors);

    header('Location: /index.php?type=episodes&id=' . $seasonId);
}