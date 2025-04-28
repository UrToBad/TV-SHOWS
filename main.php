<?php

$sqlCredentials = new SqlCredentials(
    "127.0.0.1", // Host
    "tvshows",   // Database
    "root",      // Username
    "",           // Password
    "3306"
);

$connection = new DatabaseConnection($sqlCredentials);
$tag = new TagController($connection);

?>

<h1>Liste des tags:</h1>

<?php foreach ($tag as $a): ?>
    <p><?= $a->getId() ?><p>
<?php endforeach;?>
