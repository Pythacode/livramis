<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

require $_SERVER['DOCUMENT_ROOT'] . '/composants/renderer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/composants/header/Header.php';

$header = new Header(get_categories(), isset($_SESSION['id']));

session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déconnection - Livramis</title>
    <link rel="stylesheet" href="/res/css/simple_page.css">
    <link rel="stylesheet" href="/res/css/index.css">
    <link rel="icon" type="image/png" href="./res/img/logo/square_logo.png">
    <?= Renderer::style(); ?>
</head>
<body>
    <?= $header ?>
    <div class="center">
        <h1>Déconnection effective !</h1>
        <a href="/" class="button">Accueil</a>
        <a href="/login" class="button">Connection</a>
    </div>
</body>
</html>