<?php
class Header
{
    private array $categories;
    private bool $login;
    private string $dossier;

    public function __construct(
        array $categories,
        bool $login
    ) {
        $this->categories = $categories;
        $this->login = $login;
        $this->dossier = __DIR__;

        Renderer::addStyle('/composants/header/header.css');
    }

    public function __toString(): string
    {

        $categoriesHtml = '';
        foreach ($this->categories as $categorie) {
            $nom = htmlspecialchars($categorie['name']);
            $categoriesHtml .= '<hr>';
            $categoriesHtml .= '<a href="/?categorie=' . urlencode($categorie['name']) . '" class="no-style"><li>' . $nom . '</li></a>';
        }

        if ($this->login) {
            $user_html = <<<HTML
                <a class="no-style" href="/login"><li>Se connecter</li></a>
                <a class="no-style" href="/signin"><li>S'inscrire</li></a>
            HTML;
        } else {
            $user_html = <<<HTML
                <a class="no-style" href="/not-dev.php"><li>Mon profil</li></a>
                <a class="no-style" href="/logout"><li>Déconnection</li></a>
            HTML;
        }

        $html = file_get_contents($this->dossier . '/header.html');
        $html = str_replace(
            [
                '{{categories}}',
                '{{compte}}'
            ],
            [
                $categoriesHtml,
                $user_html
            ],
            $html
        );

        return $html;
    }
}
?>
