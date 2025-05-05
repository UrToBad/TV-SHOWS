<?php
require_once "template/UserContent.php";
require_once "template/ResultBox.php";
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SerieController.php';
require_once 'controller/SaisonController.php';
require_once 'controller/EpisodeController.php';

if (!isset($_GET['type'])) {
    header('Location: index.php?type=series');
    exit;
}

$sqlCredentials = new SqlCredentials(
    "localhost", // Host
    "3306",
    "tvshows",   // Database
    "root",      // Username
    "root"       // Password
);

$connection = new DatabaseConnection($sqlCredentials);
$serieController = new SerieController($connection);
$saisonController = new SaisonController($connection);
$episodeController = new EpisodeController($connection);

ob_start();

$pageContent = "";

$search = isset($_GET['search']) ? trim($_GET['search'], '"') : null;
if ($_GET['type'] === 'series') {
    $series = $search ? $serieController->getSeriesStartingBy($search) : $serieController->getAllSeries();
    if (empty($series)) {
        $pageContent = "<p>Aucune série trouvée.</p>";
    } else {
        foreach ($series as $serie) {
            $s = $serie->getSaisons();
            $url = "https://imgs.search.brave.com/wqbY8jUBNeP9PAHUxDXaljWaHrLhS7xWbq4RMDe92bE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hc3Nl/dHMtY2RuLjEyM3Jm/LmNvbS91aS1jb21w/b25lbnRzL2Fzc2V0/cy9zdmcvYWxsLWlt/YWdlcy5zdmc";
            if(!empty($s)) {
                $url = $s[0]->getAffiche();
            }
            $pageContent . ResultBox::render(
                $serie->getId(),
                $serie->getTitre(),
                $serie->getTags(),
                $url
            );
        }
    }
} elseif ($_GET['type'] === 'saisons' && isset($_GET['id'])) {
    $serieId = intval($_GET['id']);
    $saisons = $search ? $saisonController->getSaisonsStartingBy($serieId, $search) : $saisonController->getAllSeasonsBySerieId($serieId);
    if (empty($saisons)) {
        $pageContent = "<p>Aucune saison trouvée pour cette série.</p>";
    }else{
        foreach ($saisons as $saison) {
            $pageContent . ResultBox::render(
                $saison->getId(),
                $saison->getTitre(),
                NULL,
                $saison->getAffiche(),
                "saisons"
            );
        }
    }
} elseif ($_GET['type'] === 'episodes' && isset($_GET['id'])) {
    $saisonId = intval($_GET['id']);
    $episodes = $search ? $episodeController->getEpisodesStartingBy($saisonId, $search) : $episodeController->getAllEpisodesBySeasonId($saisonId);
    if (empty($episodes)) {
        $pageContent = "<p>Aucun épisode trouvé pour cette saison.</p>";
    }else{
        foreach ($episodes as $episode) {
            $pageContent . ResultBox::render(
                $episode->getId(),
                $episode->getTitre(),
                NULL,
                "https://example.com/episode-image.jpg",
                "episodes"
            );
        }
    }

} else {
    $pageContent = "<p>Type inconnu ou paramètre manquant.</p>";
}

$pageContent = ob_get_clean();

UserContent::render(content: $pageContent);

echo '<script src="script/Logo.js"></script>';
echo '<script src="script/Searchbar.js"></script>';
echo '<script src="script/LoadForm.js"></script>';
echo '<script src="script/ClickableResultBox.js"></script>';
echo '<script>reAttachEvents()</script>';