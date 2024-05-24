<?php

namespace App\Boutique\Controllers;

use App\Boutique\Enum\ClientExceptionEnum;
use App\Boutique\Exceptions\ClientExceptions;
use App\Boutique\Forms\UsersRegistrationForms;
use App\Boutique\Models\Special\UsersConnect;
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
                    unset($_POST);
                    return call_user_func_array([$this, 'ConnectJS'], $arguments);
                }
            }
        }
        // Ajout de la class FormBuilder au tableau de parametre retourner au template
        $render->addParams('formRegister', UsersRegistrationForms::RegistrationForm($modelUser, $errors ?? null));

        $content = $render->render("register/inscription", $arguments); // RENDER HTML

        return $content;
    }

    public function ConnectJS(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $render */
        $render = $arguments['render'];
        var_dump($arguments);
        if (http_response_code(202)) {

            $alertMessage = `<div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Inscription réussi</span>
            <div class="ms-3 text-sm font-medium">
                Bienvenue sur TeaCoffe, merci de votre inscription.
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
            </button>
          </div>`;

            $render->addParams('alertMessage', $alertMessage);
        }
        if ($render->has('isConnected') == true) {
            header('location:/profile');
        }

        $modelUser = new UsersConnect($arguments); // Instance d'un models de class User

        if (!empty($_POST)) {

            $modelUser->setPassword($arguments['password'] ?? "");

            $errorsIntercept = ReflectionValidator::validate($modelUser); // VALIDATOR PHP

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
                    //DEBUG var_dump($arguments);
                    // Tout s'est bien passé : réponse JSON 200 avec le corps suivant : {'isConnected' : true}
                    $this->responseJson(200, ['isConnected' => true]);
                }
            }
        } else {
            // Ajout de la class FormBuilder au tableau de parametre retourner au template
            $render->addParams('formConnect', UsersRegistrationForms::ConnectFormUsersRegistration($modelUser, $errors ?? null));

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
