<?php
session_start();
if ($_POST['username'] == "GUS" && $_POST['password'] == "1547") {
    $_SESSION['connecte'] = true;
}
header('Location: ' . $_SESSION['page']);
exit();
