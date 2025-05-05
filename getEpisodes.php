<?php
require_once 'class/DatabaseConnection.php';
require_once 'controller/SaisonController.php';
require_once 'class/Episode.php';
require_once 'template/ResultBox.php';

$sqlCredentials = new SqlCredentials(
    "localhost",
    "3306",
    "tvshows",
    "root",
    "root"
);

$connection = new DatabaseConnection($sqlCredentials);
$saisonController = new SaisonController($connection);

$data = json_decode(file_get_contents("php://input"), true);
$seasonId = $data['id'] ?? null;

if ($seasonId) {
    $saison = $saisonController->getSeasonById($seasonId);

    ob_start();
    foreach ($saison->getEpisodes() as $episode) {
        resultBox::render($episode->getId(), $episode->getTitre(), null, "", "episodes");
    }
    echo ob_get_clean();
}
