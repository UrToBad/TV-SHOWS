<?php
class Searchbar
{
    public static function render(): void
    { ?>
        <div id="searchbar">
            <div class="search_item">tag<input type="text" id="search_tag" class="search_input"></div>
            <div class="search_item">serie<input type="text" id="search_ser" class="search_input"></div>
            <div class="search_item">director<input type="text" id="search_rea" class="search_input"></div>
            <div class="search_item">actor<input type="text" id="search_act" class="search_input"></div>
        </div>
        <?php
    }
}
