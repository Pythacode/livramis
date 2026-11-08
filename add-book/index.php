<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

require $_SERVER['DOCUMENT_ROOT'] . '/composants/renderer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/composants/header/Header.php';

$header = new Header(get_categories(), isset($_SESSION['id']));


if (!isset($_SESSION['id'])) {
    header('Location: /login/?redirect=/add-book');
    exit;
    }

function cleanQuillContent($html) {
    // Liste des balises autorisées
    $allowedTags = "<p><span><strong><em><u><s><blockquote><a><div><br><pre><ol><ul><li>";
    
    // Nettoyer avec strip_tags
    $safeContent = strip_tags($html, $allowedTags);
    
    // Supprimer les attributs dangereux (ex: onclick, onerror, etc.)
    $safeContent = preg_replace('/on\w+=".*?"/i', '', $safeContent);

    // Nettoyer les liens pour éviter le JavaScript injecté
    $safeContent = preg_replace('/href="javascript:.*?"/i', 'href="#"', $safeContent);

    return $safeContent;
}


// Vérifier si le formulaire a été soumis et si un fichier a été téléchargé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $author = $_POST["author"];
    
    echo $_FILES['image']['size'];
    
    $resume = cleanQuillContent($_POST["resume"]);
    
    $sql_request = $bdd->prepare("INSERT INTO books (title, synopsis, state, author, user_id, have_picture, categorie) VALUES (:title, :resume, :state, :author, :user_id, :have_picture, :categorie)");

    $sql_request->bindValue(':title', $_POST["title"]);
    $sql_request->bindValue(':resume', $resume);
    $sql_request->bindValue(':state', "Disponible");
    $sql_request->bindValue(':author', $author);
    $sql_request->bindValue(':user_id', $_SESSION["id"]);
    $sql_request->bindValue(':categorie', $_POST["categorie"]);


    if ($_FILES['image']['size']==0) { // Pas d'image
        $sql_request->bindValue(':have_picture', 0); //echo 'Pas d\'image';
    } else { // Il y a une image
        $sql_request->bindValue(':have_picture', 1);
        //echo'image';
        }

    $sql_request->execute();

    $book_id = $bdd->lastInsertId();

    $sql_request = $bdd->prepare("INSERT INTO `user_to_books` (id_user, id_book) VALUES (:userID, :bookID)");
    $sql_request->bindValue(':userID', $_SESSION["id"]);
    $sql_request->bindValue(':bookID', $book_id);

    $sql_request->execute();

    $sql_request = $bdd->prepare('SELECT id FROM `authors` WHERE name = :name');
    $sql_request->bindValue(':name', $author);
    
    $sql_request->execute();

    $result = $sql_request->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        $sql_request = $bdd->prepare("INSERT INTO `authors` (name) VALUES (:name)");
        $sql_request->bindValue(':name', $author);
        $sql_request->execute();
    
        $author_id = $bdd->lastInsertId();

    } else {
        $author_id = $result['id'];
    }

    $sql_request = $bdd->prepare("INSERT INTO `author_to_books` (id_author, id_book) VALUES (:authorID, :bookID)");
    $sql_request->bindValue(':authorID', $author_id);
    $sql_request->bindValue(':bookID', $book_id);

    $sql_request->execute();
    
    if (!($_FILES['image']['size']==0)) { // Il y a une image
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
        // Vérification du type MIME
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);
        
        if (!in_array($mime_type, $allowed_types)) {
            echo "Erreur : Le fichier n'est pas une image valide.";
            exit;
        }
    
        // Charger l'image avec GD
        switch ($mime_type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file_tmp);
                break;
                case 'image/png':
                    $image = imagecreatefrompng($file_tmp);
                    break;
                    case 'image/gif':
                $image = imagecreatefromgif($file_tmp);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($file_tmp);
                break;
                default:
                echo "Format non supporté.";
                exit;
        }
    
        if (!$image) {
            echo "Erreur : Impossible de traiter l'image.";
            exit;
        }

        if (!file_exists('./../books/' . $book_id)) {mkdir('./../books/' . $book_id);}
    
        $output_file = "./../books/" . $book_id . "/couverture.jpg";
        imagejpeg($image, $output_file, 100); // Qualité 100%
    
        // Libérer la mémoire
        imagedestroy($image);
        }

        
        exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajouter un livre - Livramis</title>
        <link rel="stylesheet" href="/res/css/index.css">
        <link rel="stylesheet" href="/res/css/form.css">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <link rel="stylesheet" href="/res/css/add-book.css">
        <?= Renderer::style(); ?>
    </head>
    <body>
        <?= $header ?>
        <div class="container">
            <h1>Ajout d'un livre - Livramis</h1>
            <h2>Veuillez remplir les champs ci-dessous</h2>

            <form id="add_book" class="add_book" enctype="multipart/form-data" method="post" action="/add-book/">

                <div class="choice_picture_container" id="image-container">
                    <div class="choice_picture">
                        <div>
                            <h1>Couverture</h1>
                            <h3>Clique ici pour ajouter une couverture</h3>
                            <h3>250ko max</h2>
                            
                            <input type="hidden" name="MAX_FILE_SIZE" value="102400" /> 
                            <input type="file" id="image" name="image" accept="image/jpeg, image/webp, image/gif, image/png" style="display: none;">

                            <p id="image-name">Aucune image sélectionnée</p>
                        </div>
                    </div>
                </div>
                <div class="inputs">
                    <p id="error"></p>
                    <label for="title">Titre*</label>
                    <input type="text" name="title" id="title">
                    <label for="author">Auteur*</label>
                    <input list="author-list" type="text" name="author" id="author" autocomplete="off">
                    <datalist id="author-list">

                        <?php
                            
                            $sql_request = $bdd->prepare("SELECT name FROM `authors`");
                            $sql_request->execute();

                            $authors = $sql_request->fetchAll(PDO::FETCH_ASSOC);

                            foreach($authors as $author) {
                                ?> <option value="<?php echo $author["name"] ?>"></option> <?php
                            }
                        ?>

                    </datalist>

                    <label for="key_word">Mot clé (séparé par un "<strong>;</strong>")</label>
                    <input list="key_word" type="text" name="key_word">
                    <datalist id="key_word">
                        <option value="">
                    </datalist>
                    <label for="categorie">Catégorie*</label>
                    <select id="categorie" name="categorie">
                        <option value="Romans">Roman</option>
                        <option value="BDs">BD</option>
                        <option value="Mangas">Mangas</option>
                        <option value="Livres_scolaires">Livres scolaires</option>
                    </select>


                    <label for="resume">Résumé</label>
                    
                    <!-- Create the editor container -->
                    <div id="resume">
                    
                    </div>
                    <input type="hidden" name="resume" id="resume-input">
                    <input type="submit" value="Ajouter">
                </div>
                <script src="/res/js/add-book.js"></script>
            </form>
        </div>
    </body>
</html>
