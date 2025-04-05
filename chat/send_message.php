<?php
require_once './../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $id_receiver = $_POST['id_receiver'];
        $id_sender = $_SESSION['id'];

        $requeste = $bdd->prepare('INSERT INTO `message` (`id_sender`, `id_receiver`, `date`, `message`) VALUES (:id_sender, :id_receiver, NOW(), :message)');
        $requeste->bindValue(':message', $message);
        $requeste->bindValue(':id_sender', $id_sender);
        $requeste->bindValue(':id_receiver', $id_receiver);
        $requeste->execute();
        http_response_code(200);
    } else {
        http_response_code(401);
        exit;
    }
}

?>