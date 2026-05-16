<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if (!($_SERVER['REQUEST_METHOD'] == 'GET')) {
    header('Location: /404.php');
    exit;
}

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    exit;
}

if (!isset($_GET["value"])) {
    http_response_code(400);
    exit;
}

$data = [];

if ($_GET["value"] == "list_discussion") {

    $requete = $bdd->prepare("SELECT * FROM discussion WHERE id1 = :id OR id2 = :id");
    $requete->bindValue(":id", $_SESSION["id"]);
    $requete->execute();

    

    foreach ($requete->fetchAll() as $discussion) {

        $requete = $bdd->prepare("SELECT * FROM users WHERE id = :id");
        $requete->bindValue(":id", $_SESSION['id'] == $discussion['id1'] ? $discussion['id2'] : $discussion['id1']);
        $requete->execute();

        $user = $requete->fetch();

        $requete = $bdd->prepare("SELECT message, date FROM messages WHERE id_discussion = :id_discussion ORDER BY id DESC LIMIT 1");
        $requete->bindValue(":id_discussion", $discussion['id']);
        $requete->execute();

        $last_message = $requete->fetch();
        $date = $last_message["date"];
        $last_message = $last_message["message"];
        

        $data[$discussion['id']] = [
            "username" => $user["username"],
            "picture" => Null,
            "last_message" => $last_message,
            "date" => $date
        ];
        /*
        ?>
        <!--<section class="<?php echo $message["id_sender"] == $_SESSION["id"] ? "receiver" : "sender" ?>">
            <?php echo $message["message"];?>
        </section>-->
        <?php*/
    }
}

uasort($data, function ($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

header('Content-Type: application/json');
echo json_encode($data);