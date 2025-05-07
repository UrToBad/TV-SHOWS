<?php
require_once 'template/Form.php';
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? null;
$type = $data['type'] ?? 'series';
Form::render($type, $id, true);
