<?php

namespace App\Boutique\Utils;

class DefaultRender
{
    protected $serverPath;
    /**
     * Le constructeur définit le chemin d'accès au serveur sur la base de la variable globale.
     */
    public function __construct($serverName)
    {
        // global $serverName;
        $this->serverPath = $serverName;
    }
    public function defaultRender($template, $serverName)
    {
        // Démarre la mise en mémoire tampon
        ob_start();
        // var_dump($template);
        // var_dump($this->serverPath);
        // var_dump($template);

        // Inclusion du header
        require_once __DIR__ . '/../../element/header.php';

        // Inclusion du template
        require_once __DIR__ . "/../../template/{$template}.php";

        // Inclusion du footer
        require_once __DIR__ . '/../../element/footer.php';

        // Récupère le contenu mis en mémoire tampon et l'efface
        $content = ob_get_clean();

        // Retourne le contenu
        return $content;
    }
}
