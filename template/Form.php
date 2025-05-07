<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SerieController.php';
require_once 'controller/SaisonController.php';
require_once 'controller/EpisodeController.php';
require_once 'controller/TagController.php';
require_once 'controller/ActeurController.php';
require_once 'controller/RealisateurController.php';

/**
 * This class is responsible for rendering forms for adding series, seasons, episodes, tags, actors, and directors.
 *
 * @author Charles
 * @author Adrien
 */
class Form
{
    public static function render(string $type = "series", ?int $id = NULL, ?bool $edit = false): void {
        $sqlCredentials = new SqlCredentials();
        $dbConnection = new DatabaseConnection($sqlCredentials);
        echo '<link rel="stylesheet" href="style/form.css">';
        echo '<div id="form"> 
                <span class="close-button" onclick="document.getElementById(\'formContainer\').innerHTML = \'\'">✖</span>';
        switch ($type) {
            case 'series' : {
                $tagController = new TagController($dbConnection);
                if($edit){
                    $serieController = new SerieController($dbConnection);
                    $serie = $serieController->getSerieById($id);
                    if(empty($serie)) return;
                    echo '
                    <form class="form" method="POST" action="edit_serie_process.php">
                        <input type="hidden" name="serie_id" value="' . htmlspecialchars($serie->getId()) . '">
                        <input placeholder="Entrer le nom de la série" class="input" type="text" name="serie_name" value="' . htmlspecialchars($serie->getTitre()) . '">
                        <select class="input" name="tags[]" multiple>
                        ';
                    foreach ($tagController->getAllTags() as $tag) {
                        if(in_array($tag, $serie->getTags())){
                            echo '<option value="' . htmlspecialchars($tag->getNom()) . '" selected>' . htmlspecialchars($tag->getNom()) . '</option>';
                        }else{
                            echo '<option value="' . htmlspecialchars($tag->getNom()) . '">' . htmlspecialchars($tag->getNom()) . '</option>';
                        }
                    }
                    echo '</select>';
                }else{
                    $tags = [];
                    foreach ($tagController->getAllTags() as $tag) {
                        $tags[] = $tag->getNom();
                    }
                    echo '
                        <form class="form" method="POST" action="add_serie_process.php">
                        <input placeholder="Entrer le nom de la série" class="input" type="text" name="serie_name">
                        <select class="input" name="tags[]" multiple>';
                    foreach ($tags as $tag) {
                        echo '<option value="' . htmlspecialchars($tag) . '">' . htmlspecialchars($tag) . '</option>';
                    }
                    echo '</select>';
                }
                break;
            }
            case 'saisons' : {
                $actorController = new ActeurController($dbConnection);
                if($edit){
                    $saisonId = $id;
                    $saisonController = new SaisonController($dbConnection);
                    $serieId = $saisonController->getSerieIdBySaisonId($saisonId);
                    $season = $saisonController->getSaisonById($id);
                    if(empty($season)) return;
                    echo '
                        <form class="form" method="POST" action="edit_season_process.php">
                        <input type="hidden" name="serie_id" value="' . htmlspecialchars($serieId) . '">
                        <input type="hidden" name="season_id" value="' . htmlspecialchars($season->getId()) . '">
                        <input placeholder="Entrer le titre de la saison" class="input" type="text" name="season_name" value="' . htmlspecialchars($season->getTitre()) . '">
                        <input placeholder="Entrer le numéro de la saison" class="input" type="number" name="season_number" value="' . htmlspecialchars($season->getNumero()) . '">
                        <input placeholder="Entrer l\'url de l\'affiche" class="input" type="text" name="season_poster" value="' . htmlspecialchars($season->getAffiche()) . '">
                        <select class="input" name="actors[]" multiple>';
                    foreach ($actorController->getAllActeurs() as $actor) {
                        if(in_array($actor, $season->getCasting())){
                            echo '<option value="' . htmlspecialchars($actor->getNom()) . '" selected>' . htmlspecialchars($actor->getNom()) . '</option>';
                        }else{
                            echo '<option value="' . htmlspecialchars($actor->getNom()) . '">' . htmlspecialchars($actor->getNom()) . '</option>';
                        }
                    }
                    echo '</select>';
                }else{
                    $serieId = $id;
                    $actors = [];
                    foreach ($actorController->getAllActeurs() as $actor) {
                        $actors[] = $actor->getNom();
                    }
                    echo '
                        <form class="form" method="POST" action="add_season_process.php">
                        <input type="hidden" name="serie_id" value="' . htmlspecialchars($serieId) . '">
                        <input placeholder="Entrer le titre de la saison" class="input" type="text" name="season_name">
                        <input placeholder="Entrer le numéro de la saison" class="input" type="number" name="season_number">
                        <input placeholder="Entrer l\'url de l\'affiche" class="input" type="text" name="season_poster">
                        <select class="input" name="actors[]" multiple>';
                    foreach ($actors as $actor) {
                        echo '<option value="' . htmlspecialchars($actor) . '">' . htmlspecialchars($actor) . '</option>';
                    }
                    echo '</select>';
                }
                break;
            }
            case 'episodes' : {
                $directorController = new RealisateurController($dbConnection);
                if($edit){
                    $episodeId = $id;
                    $episodeController = new EpisodeController($dbConnection);
                    $seasonId = $episodeController->getSaisonIdByEpisodeId($episodeId);
                    $episode = $episodeController->getEpisodeById($id);
                    if(empty($episode)) return;
                    echo '
                        <form class="form" method="POST" action="edit_episode_process.php">
                        <input type="hidden" name="season_id" value="' . htmlspecialchars($seasonId) . '">
                        <input type="hidden" name="episode_id" value="' . htmlspecialchars($episode->getId()) . '">
                        <input placeholder="Entrer le titre de l\'épisode" class="input" type="text" name="episode_name" value="' . htmlspecialchars($episode->getTitre()) . '">
                        <input placeholder="Entrer le numéro de l\'épisode" class="input" type="number" name="episode_number" value="' . htmlspecialchars($episode->getNumero()) . '">
                        <input placeholder="Entrer le synopsis de l\'épisode" class="input" type="text" name="episode_synopsis" value="' . htmlspecialchars($episode->getSynopsis()) . '">
                        <input placeholder="Entrer la durée de l\'épisode en minute" class="input" type="number" name="episode_duration" value="' . htmlspecialchars($episode->getDuree()) . '">
                        <select class="input" name="realisateurs[]" multiple>';
                    foreach ($directorController->getAllRealisateurs() as $director) {
                        if(in_array($director, $episode->getRealisateurs())){
                            echo '<option value="' . htmlspecialchars($director->getNom()) . '" selected>' . htmlspecialchars($director->getNom()) . '</option>';
                        }else{
                            echo '<option value="' . htmlspecialchars($director->getNom()) . '">' . htmlspecialchars($director->getNom()) . '</option>';
                        }
                    }
                    echo '</select>';
                }else{
                    $seasonId = $id;
                    $directors = [];
                    foreach ($directorController->getAllRealisateurs() as $director) {
                        $directors[] = $director->getNom();
                    }
                    echo '
                        <form class="form" method="POST" action="add_episode_process.php">
                        <input type="hidden" name="season_id" value="' . htmlspecialchars($seasonId) . '">
                        <input placeholder="Entrer le titre de l\'épisode" class="input" type="text" name="episode_name">
                        <input placeholder="Entrer le numéro de l\'épisode" class="input" type="number" name="episode_number">
                        <input placeholder="Entrer le synopsis de l\'épisode" class="input" type="text" name="episode_synopsis">
                        <input placeholder="Entrer la durée de l\'épisode en minute" class="input" type="number" name="episode_duration">
                        <select class="input" name="realisateurs[]" multiple>';
                    foreach ($directors as $director) {
                        echo '<option value="' . htmlspecialchars($director) . '">' . htmlspecialchars($director) . '</option>';
                    }
                    echo '</select>';
                }
                break;
            }
            case 'tags' : {
                if($edit){
                    $tagController = new TagController($dbConnection);
                    $tag = $tagController->getTagById($id);
                    if(empty($tag)) return;
                    echo '
                        <form class="form" method="POST" action="edit_tag_process.php">
                        <input type="hidden" name="tag_id" value="' . htmlspecialchars($tag->getId()) . '">
                        <input placeholder="Entrer le nom du tag" class="input" type="text" name="tag_name" value="' . htmlspecialchars($tag->getNom()) . '">
                    ';
                }else{
                    echo '
                        <form class="form" method="POST" action="add_tag_process.php">
                        <input placeholder="Entrer le nom du tag" class="input" type="text" name="tag_name">';

                }
                break;
            }
            case 'acteurs': {
                if($edit){
                    $actorController = new ActeurController($dbConnection);
                    $actor = $actorController->getActeurById($id);
                    if(empty($actor)) return;
                    echo '
                        <form class="form" method="POST" action="edit_actor_process.php">
                        <input type="hidden" name="actor_id" value="' . htmlspecialchars($actor->getId()) . '">
                        <input placeholder="Entrer le nom de l\'acteur" class="input" type="text" name="actor_name" value="' . htmlspecialchars($actor->getNom()) . '">
                        <input placeholder="Entrer l\'url de la photo" class="input" type="text" name="actor_photo" value="' . htmlspecialchars($actor->getPhoto()) . '">
                    ';
                }else{
                    echo '
                        <form class="form" method="POST" action="add_actor_process.php">
                        <input placeholder="Entrer le nom de l\'acteur" class="input" type="text" name="actor_name">
                        <input placeholder="Entrer l\'url de la photo" class="input" type="text" name="actor_photo">
                        ';
                }
                break;
            }
            case 'realisateurs': {
                if ($edit){
                    $directorController = new RealisateurController($dbConnection);
                    $director = $directorController->getRealisateurById($id);
                    if(empty($director)) return;
                    echo '
                        <form class="form" method="POST" action="edit_director_process.php">
                        <input type="hidden" name="director_id" value="' . htmlspecialchars($director->getId()) . '">
                        <input placeholder="Entrer le nom du réalisateur" class="input" type="text" name="director_name" value="' . htmlspecialchars($director->getNom()) . '">
                        <input placeholder="Entrer l\'url de la photo" class="input" type="text" name="director_photo" value="' . htmlspecialchars($director->getPhoto()) . '">
                    ';
                }else{
                    echo '
                        <form class="form" method="POST" action="add_director_process.php">
                        <input placeholder="Entrer le nom du réalisateur" class="input" type="text" name="director_name">
                        <input placeholder="Entrer l\'url de la photo" class="input" type="text" name="director_photo">
                        ';
                }
                break;
            }
        }
        echo '<button id="submit_button">Submit</button></form></div>';
    }
}