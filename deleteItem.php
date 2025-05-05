<?php
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SaisonController.php';
require_once 'controller/SerieController.php';

$sqlCredentials = new SqlCredentials(
    "localhost",
    "3306",
    "tvshows",
    "root",
    "root"
);
$connection = new DatabaseConnection($sqlCredentials);
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? null;
$type = $data['type'] ?? null;

if ($id && $type) {
    if ($type === 'saisons') {
        $controller = new SaisonController($connection);
    } elseif ($type === 'episodes') {
        $controller = new EpisodeController($connection);
    }elseif ($type === 'series') {
        $controller = new SerieController($connection);
    } else {
        echo json_encode(['success' => false]);
        exit;
    }
    $success = true; //$controller->deleteById($id);
    echo json_encode(['success' => $success]);
}
