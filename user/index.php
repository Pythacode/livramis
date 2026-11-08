<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

$username = htmlspecialchars($_GET["username"]);

$sql_request = $bdd->prepare("SELECT * FROM `users` WHERE username = :username");
$sql_request->bindValue(':username', $username);

$sql_request->execute();

$user = $sql_request->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connection Livramis</title>
    <link rel="stylesheet" href="/res/css/index.css">
    <link rel="stylesheet" href="/res/css/user.css">
    <link rel="stylesheet" href="/res/css/home.css">
    <title><?php echo $user["username"] ?> - Livramis</title>
</head>

<body>
<?php
include "./../res/html/header.html"; 
if ($user) {
    $name = $user["username"];
    $sql_request = $bdd->prepare("SELECT * FROM `books` where `user_id` = :user_id");
    $sql_request->execute([':user_id' => $user['id']]);
    $sql_request->execute();
    $books = $sql_request->fetchAll(PDO::FETCH_ASSOC);

    include "index.html";
} else {
    ?>

    <link rel="stylesheet" href="/res/css/simple_page.css">

    <div class="center">
        <h1>Aucun utilisateur trouvé :/</h1>
        <h2>L'utilisateur "<?php echo $_GET["username"]; ?>" n'exsiste pas</h2>
        <a href="/" class="button">Accueil</a>
    </div>

    <?php
}?>
</body>
</html>
<?php
?>