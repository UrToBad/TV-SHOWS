<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'class/Tag.php';
require_once 'controller/TagController.php';
require_once 'controller/SerieController.php';
require_once 'controller/SaisonController.php';

$sqlCredentials = new SqlCredentials(
    "127.0.0.1", // Host
    "3306",
    "tvshows",   // Database
    "root",      // Username
    ""           // Password
);

$connection = new DatabaseConnection($sqlCredentials);
$tagController = new TagController($connection);
$series = new SerieController($connection);
$saisons = new SaisonController($connection);

?>

<h1>Liste des tags:</h1>
<?php foreach ($tagController->getAllTags() as $tag): ?>
    <p><?= $tag->getNom() ?>
    <p>
    <?php endforeach; ?>


<h1>saisons</h1>
<?php foreach ($saisons->getAllSeasons() as $hus): ?>
    <p><?= $hus->getTitre() ?>
    <p>
    <?php endforeach; ?>