<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'class/Tag.php';
require_once 'controller/TagController.php';

$sqlCredentials = new SqlCredentials(
    "127.0.0.1", // Host
    "3306",
    "tvshows",   // Database
    "root",      // Username
    ""           // Password
);

$connection = new DatabaseConnection($sqlCredentials);
$tagController = new TagController($connection);

?>

<h1>Liste des tags:</h1>

<?php foreach ($tagController->getAllTags() as $tag): ?>
    <p><?= $tag->getNom() ?>
    <p>
    <?php endforeach; ?>