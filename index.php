<?php
require_once "template/UserContent.php";
require_once "template/ResultBox.php";
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SerieController.php';
require_once 'controller/SaisonController.php';
require_once 'controller/EpisodeController.php';
require_once 'controller/ActeurController.php';
require_once 'controller/RealisateurController.php';
require_once 'controller/TagController.php';

if (!isset($_GET['type'])) {
    header('Location: index.php?type=series');
    exit;
}

$sqlCredentials = new SqlCredentials();

$connection = new DatabaseConnection($sqlCredentials);
$serieController = new SerieController($connection);
$saisonController = new SaisonController($connection);
$episodeController = new EpisodeController($connection);
$acteurController = new ActeurController($connection);
$realisateurController = new RealisateurController($connection);
$tagController = new TagController($connection);

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
                foreach ($s as $saison) {
                    if (!empty($saison->getAffiche())) {
                        $url = $saison->getAffiche();
                        break;
                    }
                }
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
        usort($saisons, function ($a, $b) {
            return $a->getNumero() <=> $b->getNumero();
        });
        foreach ($saisons as $saison) {
            $castings = $saison->getCasting();
            $castingsString = "";
            if (!empty($castings)) {
                foreach ($castings as $casting) {
                    $castingsString .= $casting->getNom() . ", ";
                }
                $castingsString = rtrim($castingsString, ", ");
                if (strlen($castingsString) > 50) {
                    $castingsString = substr($castingsString, 0, 47) . "...";
                }
            }
            $url = "https://imgs.search.brave.com/wqbY8jUBNeP9PAHUxDXaljWaHrLhS7xWbq4RMDe92bE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hc3Nl/dHMtY2RuLjEyM3Jm/LmNvbS91aS1jb21w/b25lbnRzL2Fzc2V0/cy9zdmcvYWxsLWlt/YWdlcy5zdmc";
            if (!empty($saison->getAffiche())) {
                $url = $saison->getAffiche();
            }
            $pageContent . ResultBox::render(
                $saison->getId(),
                $saison->getTitre(),
                NULL,
                $url,
                "saisons",
                $castingsString
            );
        }
    }
} elseif ($_GET['type'] === 'episodes' && isset($_GET['id'])) {
    $saisonId = intval($_GET['id']);
    $castings = $saisonController->getSeasonById($saisonId)->getCasting();
    $castingsString = "Castings de la saison : <br>";
    if (!empty($castings)) {
        foreach ($castings as $casting) {
            $castingsString .= $casting->getNom() . ", ";
        }
        $castingsString = rtrim($castingsString, ", ");
    }
    $pageContent . ResultBox::render(
        -1,
        "Casting",
        NULL,
        NULL,
        "episodes",
        NULL,
        $castingsString
    );
    $episodes = $search ? $episodeController->getEpisodesStartingBy($saisonId, $search) : $episodeController->getAllEpisodesBySeasonId($saisonId);
    if (empty($episodes)) {
        $pageContent = "<p>Aucun épisode trouvé pour cette saison.</p>";
    }else{
        usort($episodes, function ($a, $b) {
            return $a->getNumero() <=> $b->getNumero();
        });
        foreach ($episodes as $episode) {
            $director = $episode->getRealisateurs();
            $directorsString = "";
            if (!empty($director)) {
                foreach ($director as $realisateur) {
                    $directorsString .= $realisateur->getNom() . ", ";
                }
                $directorsString = rtrim($directorsString, ", ");
                if (strlen($directorsString) > 50) {
                    $directorsString = substr($directorsString, 0, 47) . "...";
                }
            }
            $pageContent . ResultBox::render(
                $episode->getId(),
                $episode->getTitre(),
                NULL,
                "",
                "episodes",
                $directorsString,
                $episode->getSynopsis()
            );
        }
    }

} elseif ($_GET['type'] === 'acteurs') {
    $acteurs = $search ? $acteurController->getActeursStartingBy($search) : $acteurController->getAllActeurs();
    if (empty($acteurs)) {
        $pageContent = "<p>Aucun acteur trouvé.</p>";
    } else {
        foreach ($acteurs as $acteur) {
            $pageContent . ResultBox::render(
                $acteur->getId(),
                $acteur->getNom(),
                NULL,
                $acteur->getPhoto(),
                "acteurs"
            );
        }
    }
}elseif($_GET['type'] === 'realisateurs'){
    $realisateurs = $search ? $realisateurController->getRealisateursStartingBy($search) : $realisateurController->getAllRealisateurs();
    if (empty($realisateurs)) {
        $pageContent = "<p>Aucun réalisateur trouvé.</p>";
    } else {
        foreach ($realisateurs as $realisateur) {
            $pageContent . ResultBox::render(
                $realisateur->getId(),
                $realisateur->getNom(),
                NULL,
                $realisateur->getPhoto(),
                "realisateurs"
            );
        }
    }
}elseif($_GET['type'] === 'tags'){
    $tags = $search ? $tagController->getTagsStartingBy($search) : $tagController->getAllTags();
    if (empty($tags)) {
        $pageContent = "<p>Aucun tag trouvé.</p>";
    } else {
        foreach ($tags as $tag) {
            $pageContent . ResultBox::render(
                $tag->getId(),
                $tag->getNom(),
                NULL,
                "https://cdn-icons-png.flaticon.com/512/29/29667.png",
                "tags"
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