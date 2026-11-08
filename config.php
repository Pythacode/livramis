<?php
session_start();
//session_set_cookie_params(0);

// Définir un temps d'expiration de session
/*
$timeout = 600; // 10 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: /login"); // Rediriger vers la page de connexion
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Met à jour l'activité
*/

require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Game\GameServer;
use App\Game\GameManager;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);

$DB_HOST = $_ENV["DB_HOST"];
$DB_NAME = $_ENV["DB_NAME"];
$DB_USER = $_ENV["DB_USER"];
$DB_PASS = $_ENV["DB_PASS"];
$DB_PORT = $_ENV["DB_PORT"];

try {
    $bdd = new PDO(
        "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

function get_categories() {
    global $bdd;
    $sql = $bdd->prepare("SELECT `name` FROM `categories`");
    $sql->execute();
    return $sql->fetchAll(); // FETCH_ASSOC déjà par défaut
}

function startswithAVoyelle(string $mot): bool
{
    return preg_match('/^[aeiouyàâäéèêëîïôöùûü]/i', $mot);
}

function slugify($text) {
    $text = strtolower($text); // Minuscule
    $text = preg_replace('/[^a-z0-9]+/', '-', $text); // Remplace les caractères spéciaux par "-"
    $text = trim($text, '-'); // Supprime les "-" en début/fin
    return $text;
}

?>
