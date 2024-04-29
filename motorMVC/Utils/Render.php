<?php

namespace Motor\Mvc\Utils;
use Motor\Mvc\Manager\SessionManager;
use Motor\Mvc\Components\FileImportJson;

/**
 * La classe Render est utilisée pour afficher les templates avec les paramètres ajoutés
 *  et la variable globale serverPath initialisée.
 */
class Render extends SessionManager
{
    protected $params = [];
    protected $seoConfig;

    // Passer SESSION en paramètre de la classe Render

    /**
     * Le constructeur définit le chemin d'accès au serveur sur la base de la variable globale.
     */
    public function __construct()
    {
        $this->seoConfig = FileImportJson::getFile('config/seo.fr.json');
        $this->addParams('rendering', $this);
        parent::__construct();
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

        // Ajoute par la méthode addParams() les données de seoConfig en fonction de la variable $template, sinon par la donnée par Default
        $this->addParams('seoConfig', $this->seoConfig->{$template} ?? $this->seoConfig->Default);

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract(array_merge($arguments[0], $this->params));

        // Inclusion du header en passant les données SEO
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
     * @param mixed $values La clé sous laquelle enregistrer le paramètre.
     * @param mixed $params La valeur à enregistrer.
     * @return void
     */
    public function addParams(mixed $values, mixed $params = null)
    {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                $this->params[$key] = $value;
            }
        } else {
            $this->params[$values] = $params;
        }
    }

    // Get params
    public function getParams($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
    }

    public function addSession(array $params)
    {
        $this->add($params);
    }

    public function verifySession(string $params)
    {
        $this->give($params);
    }

    /**
     * La fonction render capture la sortie, fusionne les arguments avec les paramètres,
     * inclut les modèles header et footer, et renvoie le contenu final.
     *
     * @param string $template Le nom du template à afficher.
     * @param string ...$arguments Les arguments à fusionner avec les paramètres.
     * @return string Le contenu final du template.
     */
    public function defaultRender($template)
    {
        // Démarre la mise en mémoire tampon
        ob_start();

        // Ajoute par la méthode addParams() les données de seoConfig en fonction de la variable $template, sinon par la donnée par Default
        $this->addParams('seoConfig', $this->seoConfig->{$template} ?? $this->seoConfig->Default);

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract($this->params);

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