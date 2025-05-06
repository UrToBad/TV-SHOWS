<?php

require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/TagController.php';

$sqlCredentials = new SqlCredentials();
$dbConnection = new DatabaseConnection($sqlCredentials);
$tagController = new TagController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tagName = $_POST['tag_name'] ?? null;
    if(empty($tagName)) return false;
    $tagController->createTag($tagName);
    header('Location: /index.php?type=tags');
}