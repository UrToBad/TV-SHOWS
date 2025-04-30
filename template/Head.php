<?php
require_once("Searchbar.php");
class head
{
    public static function render(): void
    { ?>
        <div id="header_high">
            <div id="title_design"><div id="page_title"><h1>2000 'n GUS, since 1547</h1></div></div>
            <div id="header_design"><div id="header_button"> <button>Se connecter</button></div></div>
        </div>
        <?php
        //Searchbar::render();
    }
}
