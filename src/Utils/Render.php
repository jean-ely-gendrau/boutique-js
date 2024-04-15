<?php

namespace App\Boutique\Utils;

/**
 * La classe Render est utilisée pour afficher les templates avec les paramètres ajoutés
 *  et la variable globale serverPath initialisée.
 */
class Render
{
    protected $serverPath;
    protected $params = [];

    /**
     * Le constructeur définit le chemin d'accès au serveur sur la base de la variable globale.
     */
    public function __construct($serverName = null)
    {
        global $serverName;
        $this->serverPath = $serverName;
    }

    /**
     * La fonction render capture la sortie, fusionne les arguments avec les paramètres,
     * inclut les modèles header et footer, et renvoie le contenu final.
     *
     * @param string $template Le nom du template à afficher.
     * @param array ...$arguments Les arguments à fusionner avec les paramètres.
     * @return string Le contenu final du template.
     */
    public function render($template, ...$arguments)
    {
        // Démarre la mise en mémoire tampon
        ob_start();

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract(array_merge($arguments[0], $this->params));

        // Inclusion du header
        require_once __DIR__ . '/../../element/header.php';

        // Inclusion de la barre de recherche
        require_once __DIR__ . '/../../element/search.php';

        // Inclusion du template
        require_once __DIR__ . "/../../template/{$template}.php";

        // Inclusion du footer
        require_once __DIR__ . '/../../element/footer.php';

        // Récupère le contenu mis en mémoire tampon et l'efface
        $content = ob_get_clean();

        // Retourne le contenu
        return $content;
    }

    /**
     * La fonction addParams ajoute une paire clé/valeur au tableau params.
     *
     * @param string $key La clé sous laquelle enregistrer le paramètre.
     * @param mixed $params La valeur à enregistrer.
     * @return void
     */
    public function addParams($key, $params)
    {
        $this->params[$key] = $params;
    }

    /**
     * La fonction render capture la sortie, fusionne les arguments avec les paramètres,
     * inclut les modèles header et footer, et renvoie le contenu final.
     *
     * @param string $template Le nom du template à afficher.
     * @param array ...$arguments Les arguments à fusionner avec les paramètres.
     * @return string Le contenu final du template.
     */
    public function defaultRender($template, $serverName)
    {
        // Démarre la mise en mémoire tampon
        ob_start();

        // Inclusion du header
        require_once __DIR__ . '/../../element/header.php';

        // Inclusion de la barre de recherche
        require_once __DIR__ . '/../../element/search.php';

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
