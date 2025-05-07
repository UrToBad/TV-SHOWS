<?php
require_once "template/userContent.php";

$pagecontent = "<div style='align-content: center'> <h1 style='text-align: center'>Mentions Légales</h1>
    <p>En utilisant ce site, vous acceptez les conditions suivantes :</p>
    <ul>
        <li>Tout utilisateur doit porter un chapeau en consultant ce site, sous peine de bannissement immédiat.</li>
        <li>Tout utilisateur doit avoir au moins 18 ans et être en possession d'un permis de conduire.</li>
        <li>Les cookies utilisés sur ce site sont garantis sans gluten, mais peuvent contenir des traces de sarcasme.</li>
        <li>Les développeurs de ce site déclinent toute responsabilité en cas d'invasion extraterrestre.</li>
        <li>Il est interdit de utiliser ce site pour des activités illicites, telles que la fabrication de fromage.</li>
        <li>Il est strictement interdit de visiter ce site en chaussettes dépareillées.</li>
        <li>Tel un dictateur quand j'ai tort, j'ai raison. GUS</li>
        <li>En cas de panne, veuillez sacrifier une imprimante à jet d'encre pour apaiser les dieux de la technologie.</li>
        <li>Le site se réserve le droit de modifier les conditions d'utilisation à tout moment, sans préavis.</li>
        <li>Contacter la team GUS sera facturé 500€</li>
        <li>En utilisant ce site, vous acceptez nos conditions, telles qu'aucune loi du monde exterieur ne s'applique pour la team GUS ni a ce site</li>
        <li>En utilisant ce site, vous consentez à ce que votre animal de compagnie devienne notre mascotte officielle.</li>
    </ul>
    <p>En cas de litige, les parties conviennent de se soumettre à la juridiction exclusive des tribunaux du Royaume de GUS, avec comme juge GUS.</p> </div>
    <script src='script/Logo.js'></script>";

userContent::render(content: $pagecontent);
