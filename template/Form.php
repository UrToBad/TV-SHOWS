<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/TagController.php';
require_once 'controller/ActeurController.php';
require_once 'controller/RealisateurController.php';

class Form
{
    public static function render(string $type = "series", ?int $id = NULL): void {
        $sqlCredentials = new SqlCredentials();
        $dbConnection = new DatabaseConnection($sqlCredentials);
        echo '<link rel="stylesheet" href="style/form.css">';
        echo '<div id="form"> 
                <span class="close-button" onclick="document.getElementById(\'formContainer\').innerHTML = \'\'">✖</span>';
        switch ($type) {
            case 'series' : {
                $tagController = new TagController($dbConnection);
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
                break;
            }
            case 'saisons' : {
                $serieId = $id;
                $actorController = new ActeurController($dbConnection);
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
                break;
            }
            case 'episodes' : {
                $seasonId = $id;
                $directorController = new RealisateurController($dbConnection);
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
                        <input placeholder="Entrer la durée de l\'épisode en minute" class="input" type="text" name="episode_duration">
                        <select class="input" name="realisateurs[]" multiple>';
                foreach ($directors as $director) {
                    echo '<option value="' . htmlspecialchars($director) . '">' . htmlspecialchars($director) . '</option>';
                }
                echo '</select>';
                break;
            }
        }
        echo '<button id="submit_button">Submit</button></form></div>';
    }
}