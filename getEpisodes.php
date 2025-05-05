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
    $AllEpisodes = $saison->getEpisodes();
    usort($AllEpisodes, function ($a, $b) {
        return $a->getNumero() <=> $b->getNumero();
    });
    foreach ($AllEpisodes as $episode) {
        $realisateurs = $episode->getRealisateurs();
        $realisateursList = "";
        foreach ($realisateurs as $realisateur) {
            $realisateursList .= $realisateur->getNom() . ", ";
        }
        resultBox::render($episode->getId(),$episode->getNumero() . " - " . $episode->getTitre(), null, "", "episodes", $realisateursList);
    }
    echo ob_get_clean();
}
