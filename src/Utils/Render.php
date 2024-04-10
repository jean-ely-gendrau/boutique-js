<?php

namespace App\Boutique\Utils;

class Render
{
    protected $serverPath;
    public $params = [];

    public function __construct()
    {
        global $serverName;
        $this->serverPath = $serverName;
    }

    public function render($template, ...$arguments)
    {
        ob_start();
        var_dump($this->params);
        extract(array_merge($arguments[0], $this->params));

        require_once __DIR__ . '/../../element/header.php';

        require_once __DIR__ . "/../../template/{$template}.php";

        require_once __DIR__ . '/../../element/footer.php';

        // Récupère le contenu mis en mémoire tampon et l'efface
        $content = ob_get_clean();

        // Retourne le contenu
        return $content;
    }

    public function addParams($key, $params)
    {
        $this->params[$key] = $params;
    }
}
