<?php
class Searchbar
{
    public static function render(): void
    { ?>
        <link rel="stylesheet" href="style/searchbar.css">
        <div id="searchbar">
            <div class="search_item"><input type="text" id="search_tag" class="search_input" placeholder="Rechercher..."></div>
        </div>
        <?php
    }
}
