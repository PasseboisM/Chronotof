<?php
$_SESSION = array();
session_destroy();

setcookie('pseudo', '');
setcookie('mdp', '');
header('Location: index.php');