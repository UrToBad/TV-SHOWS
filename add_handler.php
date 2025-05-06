<?php
require_once 'template/Form.php';

$data = json_decode(file_get_contents('php://input'), true);
$type = $data['type'] ?? 'series';
$id = $data['id'] ?? null;
Form::render($type, $id);

