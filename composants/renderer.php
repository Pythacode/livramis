<?php

class Renderer
{
    private static array $styles = [];
    private static array $scripts = [];

    public static function addStyle(string $src): void
    {
        if (!in_array($src, self::$styles)) {
            self::$styles[] = $src;
        }

    }

    public static function addScript(string $src): void
    {
        if (!in_array($src, self::$scripts)) {
            self::$scripts[] = $src;
        }
    }

    public static function style(): string
    {
        $html = '';
        foreach (self::$styles as $src) {
            $html .= "<link rel=\"stylesheet\" href=\"{$src}\">\n";
        }
        return $html;
    }

    public static function script(): string
    {
        $html = '';
        foreach (self::$scripts as $src) {
            $html .= "<script src=\"{$src}\"></script>\n";
        }
        return $html;
    }
}

?>