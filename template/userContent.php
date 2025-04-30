<?php
require_once ("Head.php");

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
        </head>

        <body>
            <div id="header">
                <?php
                    Head::render();
                ?>

            </div>

            <div id="content">
                <?php
                    echo $content;
                ?>
            </div>

            <div id="footer">source : t'inquiètes</div>
        </body>

        </html>
        <?php
    }
}

