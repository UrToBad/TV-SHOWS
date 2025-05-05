<?php
session_start();
$_SESSION['connecte'] = false;
header('Location: ' . $_SESSION['page']);
exit();