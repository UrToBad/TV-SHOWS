<?php
require_once 'class/SqlCredentials.php';
require_once 'class/DatabaseConnection.php';
require_once 'controller/SaisonController.php';
require_once 'controller/SerieController.php';

$sqlCredentials = new SqlCredentials();
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
    }elseif($type === 'tags') {
        $controller = new TagController($connection);
    } elseif ($type === 'acteurs') {
        $controller = new ActeurController($connection);
    } elseif ($type === 'realisateurs') {
        $controller = new RealisateurController($connection);
    } else {
        echo json_encode(['success' => false]);
        exit;
    }
    $success = $controller->deleteById($id);
    echo json_encode(['success' => $success]);
}
