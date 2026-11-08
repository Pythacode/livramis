<?php
class Book
{
    private string $titre;
    private string $author;
    private string $link;
    private string $poster;
    private string $categorie;
    private string $state;
    private string $proprietaire;
    private string $synopsis;
    private string $dossier;

    public function __construct(
        string $titre,
        string $author,
        string $link,
        string $poster,
        string $categorie,
        string $state,
        string $proprietaire,
        string $synopsis
    ) {
        $this->titre = $titre;
        $this->author = $author;
        $this->link = $link;
        $this->poster = $poster;
        $this->categorie = $categorie;
        $this->state = $state;
        $this->proprietaire = $proprietaire;
        $this->synopsis = $synopsis;
        $this->dossier = __DIR__;

        Renderer::addStyle('/composants/book/book.css');
    }

    public function __toString(): string
    {
        $html = file_get_contents($this->dossier . '/book.html');
        $html = str_replace(
            [
                '{{link}}',
                '{{poster}}',
                '{{title}}',
                '{{author}}',
                '{{categorie}}',
                '{{state}}',
                '{{proprietaire}}',
                '{{synopsis}}'
            ],
            [
                $this->link,
                $this->poster,
                $this->titre,
                $this->author,
                $this->categorie,
                $this->state,
                $this->proprietaire,
                $this->synopsis
            ],
            $html
        );

        return $html;
    }
}
?>
