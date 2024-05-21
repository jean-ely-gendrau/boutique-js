<?php

namespace App\Boutique\Controllers;

use App\Boutique\Enum\ClientExceptionEnum;
use App\Boutique\Exceptions\ClientExceptions;
use App\Boutique\Forms\UsersRegistrationForms;
use App\Boutique\Models\Special\UsersRegistration;
use Motor\Mvc\Manager\CrudManager;
use Motor\Mvc\Manager\MailManager;
use Motor\Mvc\Components\ReCaptcha;
use Motor\Mvc\Manager\PasswordHashManager;
use Motor\Mvc\Validators\ReflectionValidator;

class RegisterController
{
    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function Register(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $render */
        $render = $arguments['render'];

        if ($arguments['render']->has('isConnected') == true) {
            header('location:/');
        }

        $modelUser = new UsersRegistration($arguments); // Instance d'un model de class User

        if (!empty($_POST)) {
            $modelUser->setPassword($arguments['password'] ?? '');
            $errors = ReflectionValidator::validate($modelUser); // VALIDATION DATA

            if (!$errors && isset($arguments['email'])) {

                $crudManager = new CrudManager('users', UsersRegistration::class); // CRUD

                if ($crudManager->getByEmail($arguments['email']) !== false) {
                    throw new ClientExceptions(ClientExceptionEnum::AccountIsRegistered); // EXCEPTION
                } else {
                    $crudManager->create($modelUser, ['full_name', 'email', 'password', 'role']); // INSERT
                    header('location:/connexion'); // REDIRECT
                }
            }
        }
        // Ajout de la class FormBuilder au tableau de parametre retourner au template
        $render->addParams('formRegister', UsersRegistrationForms::RegistrationForm($modelUser, $errors ?? null));

        $content = $render->render("register/inscription", $arguments); // RENDER HTML

        return $content;
    }

    /******************************************************** SAMPLE CONNECT JS START */
    public function ConnectJS(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $render */
        $render = $arguments['render'];

        if ($render->has('isConnected') == true) {
            header('location:/profile');
        }


        // ReflectionValidator::validate($modelUser)
        // Cette méthode static de la class ReflectionValidator
        // Permet de valider les données côter backend en utilisant
        // les attributs introduit depuis php 8.*.
        // Préfixer vos propriéte dans vos class est utilisé le
        // validatorData pour créer vos Regex et réstriction sur vos valeurs.
        if (!empty($_POST)) {
            $modelUser = new UsersRegistration($arguments); // Instance d'un models de class User

            $modelUser->setPassword($arguments['password'] ?? "");

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
                $crudManager = new CrudManager('users', UsersRegistration::class);  // Instance of PasswordHashManager - table users, models Users
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
        } else {
            return $render->render("register/connexion", $arguments);
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
