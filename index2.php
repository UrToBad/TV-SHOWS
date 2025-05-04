<?php
    require_once "template/userContent.php";
    require_once "template/resultBox.php";
        
    ob_start();

    $pagecontent = "";

    for ($i=0; $i < 10 ; $i++) { 
        $pagecontent . resultBox::render();
    }

    $pagecontent=ob_get_clean();

    userContent::render(content: $pagecontent);
    
