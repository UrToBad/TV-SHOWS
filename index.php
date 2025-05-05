<?php
    require_once "template/UserContent.php";
    require_once "template/ResultBox.php";
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
        $pagecontent . resultBox::render($serie->getId(), $serie->getTitre(), $serie->getTags(), "https://imgs.search.brave.com/qshfwzKX67kZuaHiKki0p3dLBsaoq7sP3HsTQCs2_ic/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzLzFmLzY5/LzllLzFmNjk5ZTgx/OWVhM2M5ODkzMTFl/ZmUxMTdlMjYzNGFj/LmpwZw");
    }

    $pagecontent=ob_get_clean();

    userContent::render(content: $pagecontent);

    echo '<script src="script/ClickableResultBox.js"></script>';
    
