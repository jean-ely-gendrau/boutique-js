<?php

namespace App\Boutique\Controllers;

use App\Boutique\Manager\CrudManager;
use App\Boutique\Models\Users;
use App\Boutique\Utils\Render;
use App\Boutique\Manager\PasswordHashManager;
use App\Boutique\Manager\SessionManager;

/**
 * La classe TestRender étend Render et contient les méthodes pour afficher des variables et
 * renvoyer une vue (View) avec les données de l'exemple.
 */
class RegisterController
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    /**
     * Méthode Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return void
     */
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function View(...$arguments)
    {
        // $this->addParams('exemple', $exemple);
        // $content = $this->render('inscription', $arguments);
        return $arguments['render']->render('inscription', $arguments);
    }
    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function Register(...$arguments)
    {
        echo '<pre>';
        // var_dump($arguments);
        $paramSQL = [];
        foreach ($arguments as $key => $value) {
            if ($key === 'fullName') {
                if (preg_match('/^[a-zA-Z-\s]{8,45}$/', $value)) {
                    $paramSQL['full_name'] = $value;
                } else {
                    echo 'Veuillez entre un nom et prenom valide minimum 8 characters maximum 45 characters';
                }
            }

            if ($key === 'email') {
                if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $paramSQL['email'] = $value;
                } else {
                    echo 'Veuillez entre un email valide';
                }
            }
            if ($key === 'password') {
                if (preg_match('/^(?(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\-_@.])[a-zA-Z0-9\%\$\,\;\!\-_\@\.]{6,25})$/', $value)) {
                    $paramSQL['password'] = $value;
                } else {
                    echo "Veuillez entre un mot de passe valide avoir une longueur de 6 à 25 caractères ,contenir au moins une lettre majuscule, un chiffre et l'un des caractères spéciaux spécifiés : %, $, ,, ;, !, _, ou -.";
                }
            }
        }
        // var_dump($paramSQL);
        $model = new Users($paramSQL);
        // var_dump($model);
        $crudManager = new CrudManager('users', Users::class);
        if ($crudManager->getByEmail($paramSQL['email']) !== false) {
            echo 'Compte deja enregistre avec ce mail';
        } else {
            echo 'create';
            $crudManager->create($model, ['full_name', 'email', 'password', 'role']);
            header('location:/connexion');
        }
        // $this->addParams('exemple', $exemple);
        echo '</pre>';
        $content = $arguments['render']->render('test-render', $arguments);
        // $content = $this->render('inscription', $arguments);
        return $content;
    }
    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function ViewConnect(...$arguments)
    {
        // $this->addParams('exemple', $exemple);
        // $content = $this->render('connexion', $arguments);
        return $arguments['render']->render('connexion', $arguments);
    }
    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function Connect(...$arguments)
    {
        echo '<pre>';
        $crudManager = new CrudManager('users', Users::class);
        $user = $crudManager->getByEmail($arguments['email']);
        // var_dump($user->password);
        if ($crudManager->getByEmail($arguments['email']) !== false) {
            // var_dump($arguments['password']);
            if (preg_match('/^(?(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\-_@.])[a-zA-Z0-9\%\$\,\;\!\-_\@\.]{6,25})$/', $arguments['password'])) {
                $verifPassword = new PasswordHashManager();
                // var_dump($verifPassword->verify($user->password, $arguments['password']));
                // var_dump($verifPassword->hash($arguments['password']));
                if ($verifPassword->verify($user->password, $arguments['password'])) {
                    $sessionManager = new SessionManager();
                    $sessionManager->add(['email' => $user->email, 'isConnected' => true, 'full_name' => $user->full_name, 'role' => $user->role]);
                    var_dump($_SESSION['email']);
                    var_dump($_SESSION['isConnected']);
                    var_dump($_SESSION['full_name']);
                    var_dump($_SESSION['role']);
                    // header('location:/');
                } else {
                    echo 'Mot de passe incorrect';
                }
            } else {
                echo 'Not preg match';
            }
        } else {
            echo 'Email non existant';
        }

        // $this->addParams('exemple', $exemple);
        echo '</pre>';
        $content = $arguments['render']->render('connexion', $arguments);
        // $content = $this->render('connexion', $arguments);
        return $content;
    }
}
