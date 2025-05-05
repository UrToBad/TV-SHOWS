<?php
    require_once "template/userContent.php";
    require_once "template/resultBox.php";
    require_once 'class/SqlCredentials.php';
    require_once 'class/DatabaseConnection.php';
    require_once 'controller/SerieController.php';

    $sqlCredentials = new SqlCredentials(
        "localhost", // Host
        "3306",
        "tvshows",   // Database
        "root",      // Username
        "root"       // Password
    );

    $connection = new DatabaseConnection($sqlCredentials);
    $serieController = new SerieController($connection);
        
    ob_start();

    $pagecontent = "";

    foreach ($serieController->getAllSeries() as $serie) {
        $pagecontent . resultBox::render($serie->getTitre(), $serie->getTags());
    }

    $pagecontent=ob_get_clean();

    userContent::render(content: $pagecontent);
    
