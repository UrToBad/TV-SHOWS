<?php
    require_once "template/userContent.php";
    require_once "template/resultBox.php";
        
    ob_start();

    $pagecontent = "";

    

    $pagecontent=ob_get_clean();

    userContent::render(content: $pagecontent);
    
