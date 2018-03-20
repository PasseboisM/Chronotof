<?php
$parametres = parse_ini_file("parametres/param.ini");

try {
    $bdd = new PDO(
        $parametres['dsn'],
        $parametres['user'],
        $parametres['psw']
    );
} catch (Exception $e) {
    header('Location: morceaux/message.html');
}