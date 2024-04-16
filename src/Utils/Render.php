<?php

namespace App\Boutique\Utils;
use App\Boutique\Manager\SessionManager;
use App\Boutique\Components\FileImportJson;

/**
 * La classe Render est utilisée pour afficher les templates avec les paramètres ajoutés
 *  et la variable globale serverPath initialisée.
 */
class Render extends SessionManager
{
    protected $serverPath;
    protected $params = [];

    // Passer SESSION en paramètre de la classe Render

    /**
     * Le constructeur définit le chemin d'accès au serveur sur la base de la variable globale.
     */
    public function __construct($serverName = null)
    {
        global $serverName;
        $this->serverPath = $serverName;
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

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract(array_merge($arguments[0], $this->params));

        // Chargement des données SEO depuis le fichier seo.fr.json
        $indexData = FileImportJson::getFile('config/seo.fr.json', true); // Assurez-vous que FileImportJson est correctement importé
        var_dump($indexData);
        var_dump($template);
        // Vérifiez si la clé 'Index' existe dans les données SEO
        if (isset($indexData[$template])) {
            // Si la clé 'Index' existe, récupérez les données pour le header
            $seoConfig = $indexData[$template];

            // Inclusion du header en passant les données SEO
            require_once __DIR__ . '/../../element/header.php';
        } else {
            // Si la clé 'Index' n'existe pas, vous pouvez fournir des valeurs par défaut ou afficher un message d'erreur
            echo "Les données pour l'élément 'Index' ne sont pas disponibles.";
            // Inclure le header sans données SEO
            require_once __DIR__ . '/../../element/header.php';
        }

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
     * @param array|string $values La clé sous laquelle enregistrer le paramètre.
     * @param mixed $params La valeur à enregistrer.
     * @return void
     */
    public function addParams(array|string $values, mixed $params = null)
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
    public function defaultRender($template, $serverName)
    {
        // Démarre la mise en mémoire tampon
        ob_start();
        var_dump($serverName);

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
