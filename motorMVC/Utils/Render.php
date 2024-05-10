<?php

namespace Motor\Mvc\Utils;

use Motor\Mvc\Manager\SessionManager;
use Motor\Mvc\Components\FileImportJson;

/**
 * La classe Render est utilisée pour afficher les templates avec les paramètres ajoutés
 * et la variable globale serverPath initialisée.
 */
class Render extends SessionManager
{
    /**
     * params
     *
     * Tableau de valeurs passé en paramètre.
     *
     * @var array
     */
    protected array $params = [];

    /**
     * seoConfig
     *
     * Fichier json de configuration SEO décodé.
     *
     * @var mixed
     */
    protected $seoConfig;

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
     * méthode renderAdmin
     *
     * La fonction render capture la sortie, fusionne les arguments avec les paramètres,
     * inclut les modèles header et footer, et renvoie le contenu final.
     *
     * @param string $template Le nom du template à afficher.
     * @param array ...$arguments Les arguments à fusionner avec les paramètres.
     * @return string Le contenu final du template.
     */
    public function renderAdmin($template, ...$arguments)
    {
        // Démarre la mise en mémoire tampon
        ob_start();

        // Ajoute par la méthode addParams() les données de seoConfig en fonction de la variable $template, sinon par la donnée par Default
        $this->addParams('seoConfig', $this->seoConfig->{$template} ?? $this->seoConfig->Default);

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract(array_merge($arguments[0] ?? [], $this->params));

        // Inclusion du header
        require_once __DIR__ . '/../../element/header.php';

        // Inclusion du menu admin
        require_once __DIR__ . '/../../element/admin/menu.php';

        // EXEPTION PROVISOIR pour la fixBubRender#72
        // Une branch exception et une issue doivent être créées à cet effet
        if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . "../../template/{$template}.php")) {
            throw new \Exception("Ooops le template que vous demandez est introuvable.");
        } else {
            // Inclusion du template
            require_once __DIR__ . "/../../template/{$template}.php";
        }

        // Inclusion du footer
        require_once __DIR__ . '/../../element/footer.php';

        // Récupère le contenu mis en mémoire tampon et l'efface
        $content = ob_get_clean();

        // Retourne le contenu
        return $content;
    }

    /**
     * La fonction render capture la sortie, fusionne les arguments avec les paramètres,
     * inclut les modèles header et footer, et renvoie le contenu final.
     *
     * @param string $template Le nom du template à afficher.
     * @param array ...$arguments Les arguments à fusionner avec les paramètres.
     * @return string|array Le contenu final du template.
     */
    public function render(string $template, ...$arguments): string|array
    {
        // Démarre la mise en mémoire tampon
        ob_start();

        // Ajoute par la méthode addParams() les données de seoConfig en fonction de la variable $template, sinon par la donnée par défaut
        $this->addParams('seoConfig', $this->seoConfig->{$template} ?? $this->seoConfig->Default);

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract(array_merge($arguments[0] ?? [], $this->params));

        // Inclusion du header en passant les données SEO
        require_once __DIR__ . '/../../element/header.php';

        // Inclusion de la barre de recherche
        require_once __DIR__ . '/../../element/search.php';

        // EXEPTION PROVISOIR pour la fixBubRender#72
        // Une branch exception et une issue doivent être créées à cet effet
        if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . "../../template/{$template}.php")) {
            throw new \Exception("Ooops le template que vous demandez est introuvable.");
        } else {
            // Inclusion du template
            require_once __DIR__ . "/../../template/{$template}.php";
        }

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
     * @param mixed $key La clé sous laquelle enregistrer le paramètre, ou un tableau associatif de paires clé/valeur.
     * @param mixed $value La valeur à enregistrer.
     * @return void
     */
    public function addParams(mixed $key, mixed $value = null): void
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->params[$k] = $v;
            }
        } else {
            $this->params[$key] = $value;
        }
    }

    /**
     * La fonction getParams récupère la valeur associée à une clé donnée dans le tableau params.
     *
     * @param mixed $key La clé dont on souhaite récupérer la valeur.
     * @return mixed|null La valeur associée à la clé spécifiée, ou null si la clé n'existe pas.
     */
    public function getParams(mixed $key): mixed
    {
        return $this->params[$key] ?? null;
    }

    /**
     * La fonction addSession ajoute une session au tableau de paramètres.
     *
     * @param array $params Le tableau contenant les paramètres de la session à ajouter.
     * @return void
     */
    public function addSession(array $params): void
    {
        $this->add($params);
    }

    /**
     * La fonction verifySession vérifie la condition de session spécifiée.
     *
     * @param string $condition La condition de session à vérifier.
     * @return mixed La valeur de retour de la fonction give.
     */
    public function verifySession(string $condition): mixed
    {
        return $this->give($condition);
    }

    /**
     * La fonction defaultRender capture la sortie, fusionne les arguments avec les paramètres,
     * inclut les modèles header et footer, et renvoie le contenu final.
     *
     * @param string $template Le nom du template à afficher.
     * @param string ...$arguments Les arguments à fusionner avec les paramètres.
     * @return string Le contenu final du template.
     */
    public function defaultRender(string $template): string
    {
        // Démarre la mise en mémoire tampon
        ob_start();

        // Ajoute par la méthode addParams() les données de seoConfig en fonction de la variable $template, sinon par la donnée par défaut
        $this->addParams('seoConfig', $this->seoConfig->{$template} ?? $this->seoConfig->Default);

        // Fusionne les arguments avec les paramètres et les extrait dans des variables utilisables dans le template
        extract($this->params);

        // Inclusion du header
        require_once __DIR__ . '/../../element/header.php';

        // Inclusion de la barre de recherche
        require_once __DIR__ . '/../../element/search.php';

        // EXEPTION PROVISOIR pour la fixBubRender#72
        // Une branch exception et une issue doivent être créées à cet effet
        if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . "../../template/{$template}.php")) {
            throw new \Exception("Ooops le template que vous demandez est introuvable.");
        } else {
            // Inclusion du template
            require_once __DIR__ . "/../../template/{$template}.php";
        }
        // Inclusion du footer
        require_once __DIR__ . '/../../element/footer.php';

        // Récupère le contenu mis en mémoire tampon et l'efface
        $content = ob_get_clean();

        // Retourne le contenu
        return $content;
    }
}
