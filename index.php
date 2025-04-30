<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'class/Tag.php';
require_once 'controller/TagController.php';
require_once 'controller/SerieController.php';
require_once 'controller/SaisonController.php';

$sqlCredentials = new SqlCredentials(
    "localhost", // Host
    "3306",
    "tvshows",   // Database
    "root",      // Username
    "root"       // Password
);

$connection = new DatabaseConnection($sqlCredentials);
$tagController = new TagController($connection);
$serieController = new SerieController($connection);

function afficherTags($tags) {
    echo "<h1>Liste des tags:</h1>";
    foreach ($tags as $tag) {
        echo "<p>" . htmlspecialchars($tag->getNom()) . "</p>";
    }
}

function afficherSeries($series) {
    echo "<h1>Toutes les séries</h1>";
    foreach ($series as $serie) {
        echo "<p>" . htmlspecialchars($serie->getTitre()) . "</p>";
        echo "<h3>Tags</h3><ul>";
        foreach ($serie->getTags() as $tag) {
            echo "<li>" . htmlspecialchars($tag->getNom()) . "</li>";
        }
        echo "</ul><h3>Saisons</h3><ul>";
        foreach ($serie->getSaisons() as $saison) {
            echo "<li>" . htmlspecialchars($saison->getTitre()) . "</li>";
            echo "<h4>Episodes</h4><ul>";
            foreach ($saison->getEpisodes() as $episode) {
                echo "<li>Saison " . htmlspecialchars($saison->getNumero()) . " - " . htmlspecialchars($episode->getTitre()) . "</li>";
            }
            echo "</ul>";
        }
        echo "</ul>";
    }
}

afficherTags($tagController->getAllTags());
afficherSeries($serieController->getAllSeries());