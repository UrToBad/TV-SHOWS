<?php
require_once("Searchbar.php");
require_once("Form.php");

/**
 * This class is responsible for rendering the head section of the page.
 *
 * @author Adrien
 */
class head
{
    public static function render(): void
    { 
        ?>
        <link rel="stylesheet" href="style/head.css">
        <div id="header_high">
            <div id="logo"></div>
            <div id="page_title">
                <h1>2000 'n GUS, since 1547</h1>
            </div>
            <div id="header_button"><?php
                if(session_status() == PHP_SESSION_NONE) session_start();
                if (isset($_SESSION["connecte"])==null){
                    $_SESSION["connecte"]=false;
                }
                if ($_SESSION["connecte"]) {
                ?>
                    <form action="/form/deco.php" method="post">
                        <button type="submit">Déconnexion</button>
                    </form>
                <?php
                } else {
                ?>
                    <form action="/form/admin.php" method="post" class="form">
                        <div id="credentials">
                            <input type="text" name="username" placeholder="Login" require>
                            <input type="password" name="password" placeholder="Password" require>
                        </div>
                        <button type="submit">Connexion</button>
                    </form>
                <?php
                }
            ?></div>
        </div>
        <?php
        Searchbar::render(); ?>
        <div id="categories">
            <button type="acteur" onclick="clearSearchAndRedirect('index.php?type=acteurs')">Acteurs</button>
            <button type="realisateur" onclick="clearSearchAndRedirect('index.php?type=realisateurs')">Réalisateurs</button>
            <button type="series" onclick="clearSearchAndRedirect('index.php?type=series')">Séries</button>
            <button type="tags" onclick="clearSearchAndRedirect('index.php?type=tags')">Tags</button>
        </div>

        <script>
            function clearSearchAndRedirect(url) {
                const searchInput = document.getElementById("search_tag");
                if (searchInput) {
                    localStorage.removeItem("searchValue");
                    searchInput.value = "";
                }
                window.location.href = url;
            }
        </script>
    <?php 
    }
}
