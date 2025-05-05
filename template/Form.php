<?php

class Form
{
    public static function render(string $type = "series", ?int $id = NULL): void {
        $tags = ['Action', 'Aventure', 'Comédie', 'Drame', 'Fantastique', 'Horreur', 'Romance', 'Science-fiction'];
        echo '<link rel="stylesheet" href="style/form.css">';
        echo '<div id="form"><span class="close-button" onclick="document.getElementById(\'formContainer\').innerHTML = \'\'">✖</span> <form class="form" method="POST" action="/process_form.php" >';
        switch ($type) {
            case 'series' : {
                echo '
                        <input placeholder="Entrer le nom de la série" class="input" type="text" name="serie_name">
                        <select class="input" name="tags[]" multiple id="tags-select">';
                foreach ($tags as $tag) {
                    echo '<option value="' . htmlspecialchars($tag) . '">' . htmlspecialchars($tag) . '</option>';
                }

                echo '</select>';
            }
            case 'saisons' : {

            }
        }
        echo '<button id="submit_button">Submit</button></form></div>';
    }
}