<?php
/**Mentions legales
 *
 * @author Sulyvan
 * @date 31 fevrier 24:61
 */
define('MENTIONS_LEGALES', 'Mentions Légales Absurdes');
define('VERSION', '1.0');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/GUS.css">
    <title><?= MENTIONS_LEGALES ?></title>
</head>
<body>
    <h1><?= MENTIONS_LEGALES ?></h1>
    <p>En utilisant ce site, vous acceptez les conditions suivantes :</p>
    <ul>
        <li>Tout utilisateur doit avoir au moins 18 ans et être en possession d'un permis de conduire.</li>
        <li>Il est interdit de utiliser ce site pour des activités illicites, telles que la fabrication de fromage.</li>
        <li>Tel un dictateur quand j'ai tort, j'ai raison. GUS</li>
        <li>Le site se réserve le droit de modifier les conditions d'utilisation à tout moment, sans préavis.</li>
        <li>Contacter la team GUS sera facturé 500€</li>
        <li>En utilisant ce site vous acceptez nos conditions, telles qu'aucune loi du monde exterieur ne s'applique pour la team GUS ni a ce site</li>
        
    </ul>
    <p>En cas de litige, les parties conviennent de se soumettre à la juridiction exclusive des tribunaux du Royaume de GUS, avec comme juge GUS.</p>
    <p>Version <?= VERSION ?></p>
</body>
</html>