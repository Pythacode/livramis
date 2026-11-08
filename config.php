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
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
    $conn->set_charset('utf8mb4');
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
};

function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}

function get_categories() {
    global $bdd;

    $sql_request = $bdd->prepare("SELECT `name` FROM `categories`");
    $sql_request->execute();
    $categories = $sql_request->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

?>
