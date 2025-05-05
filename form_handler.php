<?php
require_once 'template/Form.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start();
    Form::render($_POST['type'] ?? 'series', $_POST['id'] ?? null);
    $output = ob_get_clean();
    echo $output;
}
