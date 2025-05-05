<?php
session_start();
$_SESSION['connecte'] = false;
header('Location: ' . "/index.php");
exit();