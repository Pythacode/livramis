<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

require $_SERVER['DOCUMENT_ROOT'] . '/composants/renderer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/composants/book/Book.php';
require $_SERVER['DOCUMENT_ROOT'] . '/composants/header/Header.php';


if (isset($_GET["categorie"]))  {
    $sql_request = $bdd->prepare("SELECT `id` FROM `categories` WHERE name=:name");
    $sql_request->bindValue(":name", $_GET["categorie"]);
    $sql_request->execute();
    $result = $sql_request->fetch(PDO::FETCH_ASSOC);
    $id_categorie = $result['id'] ?? -1;

    if ($id_categorie != -1) {
        $sql_request = $bdd->prepare("SELECT * FROM `books` WHERE categorie = :categorie ORDER BY title ASC");
        $sql_request->bindValue(":categorie", $id_categorie);
    } else {
        $sql_request = $bdd->prepare("SELECT * FROM `books` ORDER BY title ASC");
    }
} else {
    $sql_request = $bdd->prepare("SELECT * FROM `books` ORDER BY title ASC");
}

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

$header = new Header(get_categories(), isset($_SESSION['id']));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livramis</title>
    <link rel="stylesheet" href="/res/css/index.css">
    <link rel="stylesheet" href="/res/css/home.css">
    <?= Renderer::style(); ?>
</head>
<?php
echo $header;
?>
<body>
<div class="books">
    <?= implode('', $books) ?>
</div>
<script src="/res/js/home.js" defer></script>
</body>
</html>
