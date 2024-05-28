<?php

namespace App\Boutique\Forms;

use App\Boutique\Models\Users;
use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Manager\SessionManager;
use Motor\Mvc\Validators\ValidatorJS;
use App\Boutique\Models\Special\UsersConnect;
use Motor\Mvc\Validators\ReflectionValidator;
use App\Boutique\Models\Special\UsersRegistration;

class UsersRegistrationForms
{
    /**
     * Méthode static ConnectForm
     *
     * @param UsersConnect $modelUser [$modelUsers une instance de la class Users instancié avec les données du formulaire ou vide lors de l'initialisation]
     * @param bool|string $errors [Dans le cas où des erreurs surviennent lors de la saisie des champs input]
     * @param bool $render [Par défaut **(false)** le render ce fait au moment de l'appel de la méthode dans le template, si vous deviez le rendre au moment du rendu de la méthode passée l'argument à **(true)**]
     * 
     * @return FormBuilder|string [Le contenu généré du formulaire]
     */
    public static function ConnectFormUsersRegistration(UsersConnect $modelUser, $errors = false, $render = false): FormBuilder|string
    {
        $formBuilderConnect = new FormBuilder();

        // Instancier le ValidatorJS Pour les validation d'input avec Javascript
        // Verifier que vous posséder les méthode JS suivante validateRules et addAndCleanErrorHtmlMessage dans vos fichier JS
        // Si c'est méthode ne son pas présente vous ne pourrai pas valider vos input est des erreurs pourrais en résulter.
        $validatorJS = new ValidatorJS();

        // Mappage des régles de validation au champs du formulaire
        $validatorJS->addRule(
            'password',
            '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\@\.\-_])[a-zA-Z0-9\%\$\,\;\!\@\.\-_]{6,25}$/',
            'Votre ne correspand pas au régle de sécuriter, une minuscule,majuscule,chiffre minimum et un caractère spécial (%$,;!@.-_)',
        );
        $validatorJS->addRule('email', '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', "Votre adresse email n'a pas un format valide");

        // Ajout des régles de validation au formulaire
        $formBuilderConnect->setValidator($validatorJS);

        $formBuilderConnect
            /**
             * setIdForm = 'sample-form-connect'
             * Cette ID fait référence à l'exemple d'utilisation de la méthode teaCoffee.request.post().
             * Route de l'exemple : /sample-modal-viewer
             * Route de traitement du formulaire : /sample-connect-js
             */
            ->setIdForm('form-connect') // ID FORM
            ->setAction('/connexion') // ACTION -> ROUTE DE TRAITEMENT
            ->setClassForm('space-y-2 md:space-y-4') // CSS FORM
            ->addField('email', 'email', [
                'text-label' => 'Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getEmail() ?? '', 'autocomplete' => 'section-blue shipping email'],
                'error-message' => $errors['email'] ?? false,
            ]) // CHAMP MAIL
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'required' => 1,
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ]) // CHAMP PASSWORD
            ->addElementAction('button', 'connect-button-user', 'connect-button-user', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Connection',
                'attributes' => [
                    'data-js' => 'handleSampleConnect,click',
                    'data-route' => '/connexion',
                    'data-id-form' => 'form-connect',
                ]
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'isRegistred', 'isRegistred', [
                'class' => 'text-gray-900 text-sm dark:text-white',
                'anchor' => 'pas encore inscrit ?',
                'attributes' => [
                    'title' => 'inscription sur TeaCoffee',
                    'href' => 'inscription'
                ],
            ]); // LINK ADDITIONAL

        return $render === false ? $formBuilderConnect : $formBuilderConnect->render();
    }

    /**
     * Méthode RegistrationForm
     *
     * @param UsersRegistration $modelUser [$modelUsers une instance de la class Users instancié avec les données du formulaire ou vide lors de l'initialisation]
     * @param string $errors [Dans le cas où des erreurs surviennent lors de la saisie des champs input]
     *
     * @return FormBuilder [Le contenu généré du formulaire]
     */
    public static function RegistrationForm(UsersRegistration $modelUser, $errors): FormBuilder
    {
        $formRegister = new FormBuilder();

        // ValidatorJS Pour ajouter les règles de validation d'input avec Javascript
        $validatorJS = new ValidatorJS();

        // Mappage des règles de validation au champ du formulaire
        $validatorJS->addRule('full_name', '/^([\w\s-]{3,25})$/', "Votre nom et prénom n'est pas conforme");
        $validatorJS->addRule(
            'password',
            '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\@\.\-_])[a-zA-Z0-9\%\$\,\;\!\@\.\-_]{6,25}$/',
            'Votre mot de passe doit être complété',
        );
        $validatorJS->addRule('email', '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', "Votre adresse email n'a pas un format valide");

        // Ajout des règles de validation au formulaire
        $formRegister->setValidator($validatorJS);

        $formRegister
            ->setIdForm('form-registration') // ID FORM
            ->setClassForm('space-y-2 md:space-y-4') // CSS FORM
            ->addField('text', 'full_name', [
                'text-label' => 'Votre nom et prénom',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre nom complet',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getFull_name() ?? '', 'autocomplete' => 'section-blue shipping family-name'],
                'error-message' => $errors['full_name'] ?? false,
            ]) // CHAMP FULL_NAME
            ->addField('email', 'email', [
                'text-label' => 'Votre Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getEmail() ?? '', 'autocomplete' => 'section-blue shipping email'],
                'error-message' => $errors['email'] ?? false,
            ]) // CHAMP EMAIL
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
                'required' => 1,
                'attributes' => ['autocomplete' => 'new-password'],
                'error-message' => $errors['password'] ?? false,
            ]) // CHAMP PASSWORD
            ->addField('password', 'passwordCompare', [
                'text-label' => 'Confirmation de mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
                'required' => 1,
                'error-message' => $errors['passwordCompare'] ?? false,
            ]) // CHAMP PASSWORD COMPARE
            ->addElementAction('submit', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Inscription',
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'buttonA', 'isRegistred', [
                'class' => 'text-gray-900 text-sm dark:text-white',
                'anchor' => 'Vous avez déjà un compte ?',
                'attributes' => ['title' => 'connection', 'href' => '/connexion'],
            ]); // LINK ADDITIONAL

        return $formRegister; // Return du formulaire , le render ce fais dans le template.
    }

    /**
     * Méthode static AdminAddUser
     *
     * Cette méthode permet l'affichage d'un fomulaire pour
     * 
     *  - l'ajout/modification/suppréssion d'utilisateur à partir de l'espace d'administration
     *  - Possibilité de changer de mots de passe à implémenter
     *  - Possibilité de changer le rôle des utilisateur
     * 
     * @param array [...$data Les données du formualaire user $_POST]
     *
     * @return string [Un chaîne de caractère de l'élement formulaire]
     */
    public static function AdminAddUser(...$data)
    {
        $formRegister = new FormBuilder();
        $sessionManager = new SessionManager();
        // Instancier le ValidatorJS Pour les validation d'input avec Javascript
        // Verifier que vous posséder les méthode JS suivante validateRules et addAndCleanErrorHtmlMessage dans vos fichier JS
        // Si c'est méthode ne son pas présente vous ne pourrai pas valider vos input est des erreurs pourrais en résulter.
        $validatorJS = new ValidatorJS();

        $modelUser = new Users($data); // Instance d'un models de class User

        $errors = [];

        if (!empty($_POST) && isset($_POST['validation-user'])) {
            $errors = ReflectionValidator::validate($modelUser); // VALIDATOR
            //DEBUG var_dump($errors);
        }

        // Mappage des régles de validation au champs du formulaire
        $validatorJS->addRule('full_name', '/^(\w{3,25})$/', "Votre nom et prénom n'est pas conforme");
        $validatorJS->addRule(
            'password',
            '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\@\.\-_])[a-zA-Z0-9\%\$\,\;\!\@\.\-_]{6,25}$/',
            'Votre mot de passe doit être complété',
        );
        $validatorJS->addRule('email', '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', "Votre adresse email n'a pas un format valide");

        // Ajout des régles de validation au formulaire
        $formRegister->setValidator($validatorJS);

        $formRegister
            ->setIdForm('form-registration') // ID FORM
            ->setClassForm('space-y-2 md:space-y-4 flex flex-wrap') // CSS FORM <img class="w-20 h-20 rounded" src="/docs/images/people/profile-picture-5.jpg" alt="Large avatar">
            ->addField('image', 'avatar', [
                'label-false' => 1,
                'class' =>
                'w-20 h-20 rounded',
                'class-label-group' => 'flex w-20 m-auto',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'attributes' => ['src' => '/assets/images/tea-coffee.png'],
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['avatar'] ?? false,
            ]) // CHAMP FULL_NAME
            ->addField('file', 'add-avatar', [
                'label-false' => 'Ajouter Client',
                'class-label-group' => 'w-auto m-auto',
                'class' =>
                'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'attributes' => ['value' => 'modifier l\'avatar'],
            ])
            ->addField('text', 'full_name', [
                'text-label' => 'Nom et prénom Client',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter nom complet client',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getFull_name() ?? '', 'autocomplete' => 'section-blue shipping family-name'],
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['full_name'] ?? false,
            ]) // CHAMP FULL_NAME
            ->addField('email', 'email', [
                'text-label' => 'Email Client',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter email client',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getEmail() ?? ''],
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['email'] ?? false,
            ]) // CHAMP EMAIL
            ->addField('date', 'birthday', [
                'text-label' => 'Date de naissance',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'value' => $modelUser->getBirthday() ?? '',
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['birthday'] ?? false,
            ]) // CHAMP BIRTHDAY
            ->addField('textarea', 'adress', [
                'text-label' => 'Adresse Client',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter adresse client',
                'required' => 1,
                'value-area' => $modelUser->getAdress() ?? '',
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['adress'] ?? false,
            ]); // CHAMP ADRESS

        /**
         * Paramètrage d'un champ de fomulaire type button GenerateMDP
         * Visible seulement si on souhaite modifier un profile
         */
        if (isset($data['update-user'])) {
            $formRegister->addField('button', 'generatePassword', [
                'text-label' => 'Génération de mots de passe',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'value' => 'Nouveau mot de passe',
                'attributes' => [
                    'data-js' => 'handlePost,click',
                    'data-route' => '/api/generateMPD/' . $modelUser->getId() . '',
                    'data-method' => 'POST',
                    //'data-token' => base64_encode('ABC55'),
                ]
            ]); // CHAMP PASSWORD
        } else {
            $formRegister->addField('password', 'password', [
                'text-label' => 'Mots de passe Client',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter mots de pass client',
                'required' => 1,
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['password'] ?? false,
            ]);
        }


        /**
         * Paramètrage du boutton du fomulaire Inscription/Modification
         */
        $nameButton = $data['update-user'] ?? 'validation-user';
        $anchorButton = isset($data['update-user']) ? 'Modification' : 'Inscription';
        $formRegister->setClassActionGroup('flex flex-wrap w-full justify-between')
            ->addElementAction('button', $nameButton, $nameButton, [
                'class' =>
                'flex w-1/2 md:w-48 items-center justify-center p-3 truncate hover:text-clip text-sm font-medium text-gray-700 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-500 hover:underline',
                'anchor' => $anchorButton,
                'attributes' => [
                    'data-js' => 'handlePost,click',
                    'data-route' => '/api/Users/' . $modelUser->getId() . '',
                    'data-method' => 'POST',
                    'data-succes' => '',
                    'data-id-form' => 'form-registration',
                    //'data-token' => base64_encode('ABC55'),
                ]
            ]);
        /**
         * Paramètrage du boutton du fomulaire Supprimer
         * Visible seulement si on souhaite modifier un profile
         */
        if (isset($data['update-user'])) {
            $formRegister->addElementAction('submit', 'delete-user', 'delete-user', [
                'class' =>
                'flex w-1/2 md:w-48 items-center justify-center p-3 text-red-600 dark:text-red-500 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 hover:underline',
                'anchor' => '<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z" />
              </svg>
              <span class="truncate hover:text-clip hover:text-balance text-sm font-medium">Supprimer ' . $modelUser->getFull_name() . '</span>',
                'attributes' => ['data-js' => 'handlePost,click', 'data-route' => '/api/delete/' . $modelUser->getId() . '']
            ]);
        }

        // VERIFICATION DE SECURITER 
        //if ($sessionManager->give('role') === 'admin') {
        $roleOfUsers =  ['user', 'admin'];
        $formRegister->addField('select', 'role', [
            'text-label' => 'Rôle utilisateur',
            'class-label-group' => 'flex flex-col w-full',
            'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
            'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
            'options-selected' =>  $modelUser->getRole(),
            'options-select-array' => $roleOfUsers,
        ]); // CHAMP MAIL
        // }
        return $formRegister->render();
    }
}
