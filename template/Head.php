<?php
require_once("Searchbar.php");
class head
{
    public static function render(): void
    { 
        ?>
        <link rel="stylesheet" href="style/head.css">
        <div id="header_high">
            <div id="title_design"><div id="page_title"><h1>2000 'n GUS, since 1547</h1></div></div>
            <div id="header_design"><div id="header_button"><?php
                session_start();
                $_SESSION["page"] = "../index3.php";
                if (isset($_SESSION["connecte"])==null){
                    $_SESSION["connecte"]=false;
                }
                if ($_SESSION["connecte"]) {
                ?>
                    <form action="form/deco.php" method="post">
                        <button type="submit">Déconnexion</button>
                    </form>
                <?php
                } else {
                ?>
                    <form action="form/admin.php" method="post" class="form">
                        <input type="text" name="username" require>
                        <input type="text" name="password" require>
                        <button type="submit">Connexion</button>
                    </form>
                <?php
                }
                session_destroy();
                ?></div></div>
        </div>
        <?php
        Searchbar::render();
    }
}
