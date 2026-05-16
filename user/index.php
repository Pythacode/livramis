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
    <link rel="icon" type="image/png" href="/res/img/logo/square_logo.png">
</head>

<body>
<?php
include "./../res/html/header.html"; 
if ($user) {
    echo $user["id"];
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