<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

echo "e";
exit;

$id = explode("-", $_GET["title"]);
$id = end($id);

$sql_request = $bdd->prepare("SELECT * FROM `books` WHERE id = :id");
$sql_request->bindValue(":id", $id);
$sql_request->execute();

$book = $sql_request->fetch(PDO::FETCH_ASSOC);

if ($book == false) {
    header('Location: /404.php');
    exit;
}

if (!isset($_SESSION['id'])) {
    header('Location: /login/?redirect=/book/' . $book["title"] . "-" . $book["id"]);
    exit;
}

echo 'Location: /login/?redirect=/book/' . $book["title"] . "-" . $book["id"];

?>