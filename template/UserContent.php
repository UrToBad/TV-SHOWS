<?php
require_once ("Head.php");

/**
 * This class is responsible for rendering the user content.
 *
 * @author Adrien
 */
class userContent
{
    public static function render(string $content): void
    { ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>2000 'n GUS, since 1547</title>

            <link rel="stylesheet" href="style/style.css">
            <link rel="stylesheet" href="style/footer.css">
        </head>

        <body>
            <div id="header">
                <?php
                    Head::render();
                ?>
            </div>

            <div id="formContainer"></div>

            <div id="content">
                <?php
                    echo $content;
                ?>
            </div>

            <div id="footer">
                <p>&copy; 2000 'n GUS, since 1547. Tous droits réservés. Conception par l'équipe GUS. <a href="legals.php">Mentions légales</a> | <a href="">Contact</a></p>
            </div>
        </body>

        </html>
        <?php
    }
}

