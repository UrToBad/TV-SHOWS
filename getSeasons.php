<?php
require_once 'class/DatabaseConnection.php';
require_once 'controller/SerieController.php';
require_once 'class/Saison.php';
require_once 'template/ResultBox.php';

$sqlCredentials = new SqlCredentials(
    "localhost",
    "3306",
    "tvshows",
    "root",
    "root"
);

$connection = new DatabaseConnection($sqlCredentials);
$serieController = new SerieController($connection);

$data = json_decode(file_get_contents("php://input"), true);
$serieId = $data['id'] ?? null;

if ($serieId) {
    $serie = $serieController->getSerieById($serieId);

    ob_start();
    $AllSaisons = $serie->getSaisons();
    usort($AllSaisons, function ($a, $b) {
        return $a->getNumero() <=> $b->getNumero();
    });
    foreach ($AllSaisons as $season) {
        $casting = $season->getCasting();
        $castingList = "";
        foreach ($casting as $actor) {
            $castingList .= $actor->getNom() . ", ";
        }
        resultBox::render($season->getId(),$season->getNumero() . " - " . $season->getTitre(),NULL, "", "saisons", $castingList);
    }
    echo ob_get_clean();
}