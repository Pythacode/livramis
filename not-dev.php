<?php
require_once './config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>En cour de développement</title>
    <link rel="stylesheet" href="/res/css/simple_page.css">
    <link rel="stylesheet" href="/res/css/index.css">
    <link rel="icon" type="image/png" href="./res/img/logo/square_logo.png">
    <style>

        .wheel {
            width: 120px;
            animation: spin 5s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg) }
            to   { transform: rotate(360deg) }
        }
    </style>
</head>
<!-- Inclusion du fichier HTML header -->
<?php
include("./res/html/header.html");
?>
<body>
    <div class="center">
        <h1 id="title" style="font-size;font-size: 2rem;align-items: center;display: flex;">Page en cours de développement</h1>
        <img class="wheel" src="https://unpkg.com/simple-icons@v16/icons/devbox.svg" />
        <br>
        <a class="button" onclick="history.back()">Retour</a>
    </div>
</body>
</html>
