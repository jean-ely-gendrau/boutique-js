<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;
use Motor\Mvc\Manager\MailManager;
use Motor\Mvc\Components\ReCaptcha;
use Motor\Mvc\Manager\PasswordHashManager;
use Motor\Mvc\Validators\ReflectionValidator;

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
     * @return void Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function View(...$arguments)
    {
        // $this->addParams('exemple', $exemple);
        // $content = $this->render('inscription', $arguments);
        if ($arguments['render']->has('isConnected') == true) {
            return header('location:/');
        } else {
            return $arguments['render']->render('inscription', $arguments);
        }
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
        $paramSQL = [];
        foreach ($arguments as $key => $value) {
            if ($key === 'fullName') {
                if (preg_match('/^[a-zA-Z-\s]{8,45}$/', $value)) {
                    $paramSQL['full_name'] = $value;
                    $namePass = true;
                } else {
                    echo 'Veuillez entre un nom et prenom valide minimum 8 characters maximum 45 characters';
                    $namePass = false;
                }
            }

            if ($key === 'email') {
                if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $paramSQL['email'] = $value;
                    $emailPass = true;
                } else {
                    echo 'Veuillez entre un email valide';
                    $emailPass = false;
                }
            }
            if ($key === 'password') {
                if (preg_match('/^(?(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\-_@.])[a-zA-Z0-9\%\$\,\;\!\-_\@\.]{6,25})$/', $value)) {
                    $paramSQL['password'] = $value;
                    $passwordPass = true;
                } else {
                    echo "Veuillez entre un mot de passe valide avoir une longueur de 6 à 25 caractères ,contenir au moins une lettre majuscule, un chiffre et l'un des caractères spéciaux spécifiés : %, $, ,, ;, !, _, ou -.";
                    $passwordPass = false;
                }
            }
        }
        // var_dump($paramSQL);
        if ($namePass == true && $emailPass == true && $passwordPass == true) {
            $model = new Users($paramSQL);
            $crudManager = new CrudManager('users', Users::class);
            if ($crudManager->getByEmail($paramSQL['email']) !== false) {
                echo 'Compte deja enregistre avec ce mail';
            } else {
                echo 'create';
                $crudManager->create($model, ['full_name', 'email', 'password', 'role']);
                header('location:/connexion');
            }
        }
        // $this->addParams('exemple', $exemple);
        echo '</pre>';
        $content = $arguments['render']->render('inscription', $arguments);
        // $content = $this->render('inscription', $arguments);
        return $content;
    }
    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return void Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function ViewConnect(...$arguments)
    {
        // $this->addParams('exemple', $exemple);
        // $content = $this->render('connexion', $arguments);
        if ($arguments['render']->has('isConnected') == true) {
            return header('location:/');
        } else {
            return $arguments['render']->render('connexion', $arguments);
        }
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
                    // $sessionManager = new SessionManager();
                    // $sessionManager->add(['email' => $user->email, 'isConnected' => true, 'full_name' => $user->full_name, 'role' => $user->role]);
                    $arguments['render']->addSession([
                        'email' => $user->email,
                        'isConnected' => true,
                        'full_name' => $user->full_name,
                        'role' => $user->role,
                    ]);
                    // var_dump($_SESSION['email']);
                    // var_dump($_SESSION['isConnected']);
                    // var_dump($_SESSION['full_name']);
                    // var_dump($_SESSION['role']);
                    header('location:/');
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

    /******************************************************** SAMPLE CONNECT JS START */
    public function ConnectJS(...$arguments): void
    {

        $modelUser = new Users($arguments); // Instance d'un models de class User

        /**
          Cette méthode n'est pas présente dans la classe Users du modèle. 
         * Elle a été créée ici pour tester un cas suite à un bug lié à l'utilisation de ReflectionValidator::validate. 
         * En effet, la méthode vérifie la regex sur un mot de passe encodé directement dans le constructeur de la classe Users.
         * 
          Créer un issues pour ajouter les setter au model User
         */
        $modelUser->setPassword($arguments['password']);

        // ReflectionValidator::validate($modelUser)
        // Cette méthode static de la class ReflectionValidator
        // Permet de valider les données côter backend en utilisant
        // les attributs introduit depuis php 8.*.
        // Préfixer vos propriéte dans vos class est utilisé le
        // validatorData pour créer vos Regex et réstriction sur vos valeurs.
        if (!empty($_POST)) {
            $errorsIntercept = ReflectionValidator::validate($modelUser);

            /**
             *On définit un tableau associatif arbitraire des données que nous souhaitons mapper avec les erreurs renvoyées par la classe ReflectionValidator. Ensuite, nous excluons de ce tableau toutes les clés ne figurant pas dans le tableau de comparaison $arrayinterseckeycompare.
             *
             *Pour modifier ce comportement, veuillez envisager une nouvelle issue :
             *
             *Réfléchir à la manière de procéder.
             *Effectuer les changements et essayer plusieurs solutions.
             *Effectuer les tests appropriés et valider l'issue.
             */
            $arrayIntersecKeyCompare = ['password' => ''];
            $errors = array_intersect_key($errorsIntercept, $arrayIntersecKeyCompare);

            // réponse JSON 200 avec le corps suivant : {'errors' : $errors}
            if ($errors) {
                // ERROR
                $this->responseJson(200, ['errors' => $errors]);
            }

            // Pas d'erreur
            if (!$errors) {
                /* CONNECT USER */
                $crudManager = new CrudManager('users', Users::class);  // Instance of PasswordHashManager - table users, models Users
                $user = $crudManager->getByEmail($modelUser->getEmail()); // Appel de la méthode getByEmail(email)

                // réponse JSON 200 avec le corps suivant : {'errors' : ['email' => 'Une erreur avec votre email viens de ce produire.']}
                if (!$user) {
                    // ERROR
                    $this->responseJson(200, ['errors' => ['email' => 'Une erreur avec votre email viens de ce produire.']]);
                }

                $verifPassword = new PasswordHashManager(); // Instance of PasswordHashManager

                // Vérification du mot de passe.
                if ($verifPassword->verify($user->getPassword(), $arguments['password'])) {
                    // Incorporation des paramètres de l'utilisateur dans la session.
                    $arguments['render']->addSession([
                        'email' => $user->getEmail(),
                        'isConnected' => true,
                        'full_name' => $user->getFull_name(),
                        'role' => $user->getRole(),
                    ]);
                    //  var_dump($arguments);
                    // Tout s'est bien passé : réponse JSON 200 avec le corps suivant : {'isConnected' : true}
                    $this->responseJson(200, ['isConnected' => true]);
                }
            }
        }
    }

    /**
     * Method responseJson
     *
     * @param int $code [code la respo,se http]
     * @param mixed $response [donnée du corp de la requête à encodée en JSON]
     *
     * @return void
     */
    public function responseJson(int $code, mixed $response): void
    {
        header('Content-type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($response);
        exit;
    }
    /******************************************************** SAMPLE CONNECT JS END */

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return void Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function Deconnect(...$arguments)
    {
        $arguments['render']->remove(['email', 'isConnected', 'full_name', 'role']);
        header('Location:/');
    }
    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return void Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function ContactMail(...$arguments)
    {
        echo '<pre>';
        var_dump($arguments['email']);
        var_dump($arguments['sujet']);
        var_dump($arguments['message']);
        echo '</pre>';
        $noBot = new ReCaptcha();
        $mail = new MailManager();
        if ($noBot->notRobot($arguments['g-recaptcha-response']) === true) {
            $mail->sendMailPHP(['esteban.bare@laplateforme.io'], $arguments['sujet'], $arguments['message']);
            return header('Location:/');
        } else {
            echo 'Problem verifying Recaptcha';
        }
        $content = $arguments['render']->render('contact', $arguments);
        // $content = $this->render('contact', $arguments);
        return $content;
    }
}
