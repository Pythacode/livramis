<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function slugify($text) {
    $text = strtolower($text); // Minuscule
    $text = preg_replace('/[^a-z0-9]+/', '-', $text); // Remplace les caractères spéciaux par "-"
    $text = trim($text, '-'); // Supprime les "-" en début/fin
    return $text;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livramis</title>
    <link rel="stylesheet" href="/res/css/index.css">
    <link rel="stylesheet" href="/res/css/home.css">
    <link rel="icon" type="image/png" href="/res/img/logo/square_logo.png">
</head>
<!-- Inclusion du fichier HTML header -->
<?php
include("./res/html/header.html");
?>
<body>
<?php

if (isset($_GET["categorie"]))  {
    $sql_request = $bdd->prepare("SELECT `id` FROM `categories` WHERE name=:name");
    $sql_request->bindValue(":name", $_GET["categorie"]);
    $sql_request->execute();
    $result = $sql_request->fetch(PDO::FETCH_ASSOC);
    $id_categorie = $result['id'] ?? -1;

    if ($id_categorie != -1) {
        $sql_request = $bdd->prepare("SELECT * FROM `books` WHERE categorie = :categorie");
        $sql_request->bindValue(":categorie", $id_categorie);
    } else {
        $sql_request = $bdd->prepare("SELECT * FROM `books`");
    }
} else {
    $sql_request = $bdd->prepare("SELECT * FROM `books`");
}

$sql_request->execute();
$books = $sql_request->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="books">
    <?php
        if (empty($books)) {
            echo "Aucun livre trouvé :/";
        }
        usort($books, fn($a, $b) => strcmp($a['title'], $b['title']));
        foreach($books as $book) {
            $book_link = "/book/" . slugify($book["title"]) . "-" . $book["id"];
            $sql_request = $bdd->prepare("SELECT * FROM `users` WHERE id = :id");
            $sql_request->bindValue(":id", $book["user_id"]);
            $sql_request->execute();

            $user = $sql_request->fetch(PDO::FETCH_ASSOC);

            $sql_request = $bdd->prepare("SELECT username FROM `users` WHERE id = :id");
            $sql_request->bindValue(':id', $book["user_id"]);
            $sql_request->execute();
            
            $user = $sql_request->fetch(PDO::FETCH_ASSOC);

            $proprietaire =  $user["username"];

            $sql_request = $bdd->prepare("SELECT `name` FROM `categories` WHERE id=:id");
            $sql_request->bindValue(':id', $book["categorie"]);
            $sql_request->execute();
            
            $result = $sql_request->fetch(PDO::FETCH_ASSOC);
            $book_categorie = $result['name'] ?? 'Inconnu';
                                    
            ?>
            <div class="book">
                <p class="book-url"><?php echo $book_link; ?></p>
                <div class="book-conteneur">
                    <a href="<?php echo $book_link; ?>">
                        <img class="couverture" src="<?php echo $book["have_picture"] ? "./books/".$book["id"]."/couverture.jpg" : "./books/default/" . $book_categorie . ".png"; ?>" alt="">
                    </a>
                    <div>
                        <a class="invisible" href="<?php echo $book_link; ?>"><h2 class="title"><?php echo $book["title"]; ?></h2></a>
                        <h3 class="author"><?php echo $book["author"]; ?></h3>
                        <hr>
                        <div class="infos">
                                <h3 class="info">Catégorie : <?php echo $book_categorie ?></h3>
                                <h3  class="info">Disponibilité : <?php echo $book["state"] ?></h3>
                                
                                    <h3  class="info">Propriétaire : <a class="no-opened" href="/user/<?php echo $proprietaire; ?>"><?php echo $proprietaire; ?></a>
                                    </h3>
                                
                                <h2>Synopsis :</h2>
                                <div><?php echo $book["synopsis"] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
</div>
<script src="/res/js/home.js" defer></script>
</body>
</html>
