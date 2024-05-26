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
                    $modelUser->setPassword($modelUser->hash($arguments['password']));
                    $crudManager->create($modelUser, ['full_name', 'email', 'password', 'role']); // INSERT
                    setcookie('registered_user', $modelUser->getFull_name());
                    header('location:/connexion'); // REDIRECT
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
        // var_dump($arguments);
        $alertMessage = '<div id="toast-registered-user" class="fixed flex items-center w-full max-w-xs p-4 animate-opacity-show opacity-0 space-x-4 text-gray-400 divide-gray-700 bg-gray-800 divide-x rtl:divide-x-reverse rounded-lg shadow bottom-5 right-5 dark:text-gray-500 dark:divide-gray-200 space-x dark:bg-white" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200">
            <svg viewBox="0 0 24 24" class="rounded-full fill-gray-700 stroke-white dark:fill-white dark:stroke-gray-900 h-6 w-6 md:h-7 md:w-7 lg:h-8 lg:w-8 2xl:h-10 2xl:w-10" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"></path> </g></svg>
                <span class="sr-only">User icon</span>
            </div>
            <div class="ms-3 text-sm font-normal"> Bienvenue sur TeaCoffe ' . $_COOKIE['registered_user'] . ', merci de votre inscription.</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-registered-user" aria-label="Close">
                <span class="sr-only">Fermer la fenêtre</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>';
        if (isset($_COOKIE['registered_user'])) {

            // Message Avertissement utilisateur enregistrer

            unset($_COOKIE['registered_user']);
            setcookie('registered_user', '', -1, '/');
        }
        $render->addParams('alertMessage', $alertMessage);

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
                } else {
                    // ERROR
                    $this->responseJson(200, ['errors' => ['email' => "Il n'y a aucune correspondance entre votre email et votre mot de passe."]]);
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
