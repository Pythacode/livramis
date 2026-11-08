<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

require $_SERVER['DOCUMENT_ROOT'] . '/composants/renderer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/composants/book/Book.php';
require $_SERVER['DOCUMENT_ROOT'] . '/composants/header/Header.php';

$username = htmlspecialchars($_GET["username"]);

$sql_request = $bdd->prepare("SELECT * FROM `users` WHERE username = :username");
$sql_request->bindValue(':username', $username);

$sql_request->execute();

$user = $sql_request->fetch(PDO::FETCH_ASSOC);

$header = new Header(get_categories(), isset($_SESSION['id']));

if ($user) {
    $name = $user["username"];
    $sql_request = $bdd->prepare("SELECT * FROM `books` where `user_id` = :user_id");
    $sql_request->execute([':user_id' => $user['id']]);
    $sql_request->execute();
    $books_brut = $sql_request->fetchAll(PDO::FETCH_ASSOC);


    if (empty($books_brut)) {
        $books = ["Aucun livre trouvé :/"];
    }

    foreach($books_brut as $book) {
        $book_link = "/book/" . slugify($book["title"]) . "-" . $book["id"];
        $sql_request = $bdd->prepare("SELECT * FROM `users` WHERE id = :id");
        $sql_request->bindValue(":id", $book["user_id"]);
        $sql_request->execute();

        $user = $sql_request->fetch(PDO::FETCH_ASSOC);

        $proprietaire = $user["username"];

        $sql_request = $bdd->prepare("SELECT `name` FROM `categories` WHERE id=:id");
        $sql_request->bindValue(':id', $book["categorie"]);
        $sql_request->execute();

        $result = $sql_request->fetch(PDO::FETCH_ASSOC);
        $book_categorie = $result['name'] ?? 'Inconnu';

        $books[] = new Book(
            $book["title"],
            $book["author"],
            $book_link,
            $book["have_picture"] ? "/books/".$book["id"]."/couverture.jpg" : "/books/default/" . $book_categorie . ".png",
            $book_categorie,
            $book["state"],
            $proprietaire,
            $book['synopsis']
        );
    }

}

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
    <?= Renderer::style(); ?>
</head>
<body>
    <?= $header ?>
    <?php if ($user) {
        ?>
        <div class="user">
            <img src="/users/default/profile_picture.png" alt="Photo de profil" class="profile_picture">
            <div  style="position : relative;width: 100%;">
                <h2 class="title"><?php echo $name ?></h2>
                <p><?php echo $user["biographie"]; ?></p>
                <div class="divider">
                <span>Les livres <?php echo startswithAVoyelle($name) ? "d'{$name}" : "de {$name}"; ?></span>
                </div>

                <div class="books">
                    <?= implode('', $books) ?>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>

        <link rel="stylesheet" href="/res/css/simple_page.css">

        <div class="center">
            <h1>Aucun utilisateur trouvé :/</h1>
            <h2>L'utilisateur "<?php echo $_GET["username"]; ?>" n'exsiste pas</h2>
            <a href="/" class="button">Accueil</a>
        </div>

        <?php
    }
    ?>
</body>
</html>