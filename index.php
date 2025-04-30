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
    "root"           // Password
);

$connection = new DatabaseConnection($sqlCredentials);
$tagController = new TagController($connection);
$serieController = new SerieController($connection);

?>

    <h1>Liste des tags:</h1>
<?php foreach ($tagController->getAllTags() as $tag): ?>
    <p><?= $tag->getNom() ?>
    <p>
<?php endforeach; ?>


    <h1>Toutes les séries</h1>
<?php foreach ($serieController->getAllSeries() as $serie): ?>
    <p><?= $serie->getTitre() ?>
    <h3>Tags</h3>
    <?php foreach ($serie->getTags() as $tag): ?>
        <li><?= $tag->getNom() ?>
    <?php endforeach; ?>
    <h3>Saisons</h3>
    <?php foreach ($serie->getSaisons() as $saison): ?>
        <li><?= $saison->getTitre() ?>
        <h4>Episodes</h4>
        <?php foreach ($saison->getEpisodes() as $episode): ?>
            <li>Saison <?= $saison->getNumero()?> - <?= $episode->getTitre() ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>