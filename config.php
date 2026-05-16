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

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$config = Yaml::parseFile(__DIR__ . '/config.yaml');


try {
    $bdd = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8;", $config['username'], $config['password']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
