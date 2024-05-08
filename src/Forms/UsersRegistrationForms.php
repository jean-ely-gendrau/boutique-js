<?php

namespace App\Boutique\Forms;

use App\Boutique\Models\Users;
use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Manager\SessionManager;
use Motor\Mvc\Validators\ValidatorJS;
use Motor\Mvc\Validators\ReflectionValidator;

class UsersRegistrationForms
{
    /**
     * Méthode static ConnectForm
     *
     * @param array [...$arguments Les arguments transmis à la méthode suivant l'appel de call_user_func_array.]
     *
     * @return string [Le contenu généré en rendant le template 'test-render' avec les arguments fournis.]
     */
    public static function ConnectForm(...$arguments)
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
            ->setIdForm('sample-form-connect') // ID FORM
            ->setAction('/form-test-connect') // ACTION -> ROUTE DE TRAITEMENT
            ->setClassForm('space-y-2 md:space-y-4') // CSS FORM
            ->addField('email', 'email', [
                'text-label' => 'Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
            ]) // CHAMP MAIL
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ]) // CHAMP PASSWORD
            ->addElementAction('button', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Connection',
                'attributes' => [
                    'data-js' => 'handleSampleConnect,click',
                    'data-post-url' => '/sample-connect-js',
                    'data-id-form' => 'sample-form-connect',
                ]
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'buttonA', 'isRegistred', [
                'class' => 'text-gray-900 text-sm dark:text-white',
                'anchor' => 'pas encore inscrit ?',
                'attributes' => [
                    'title' => 'connection',
                    'href' => 'form-test-inscription'
                ],
            ]); // LINK ADDITIONAL

        return $formBuilderConnect->render();
    }

    /**
     * Méthode static AdminAddUser
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
        // ReflectionValidator::validate($modelUser)
        // Cette méthode statice de la class ReflectionValidator
        // Permet de valider les données côter backend en utilisant
        // les attributs introduit depuis php 8.*.
        // Préfixer vos propriéte dans vos class est utilisé le
        // validatorData pour créer vos Regex et réstriction sur vos valeurs.
        if (!empty($_POST) && isset($_POST['validation-user'])) {
            $errors = ReflectionValidator::validate($modelUser);
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
                'label-false' => 'Ajouter un avatar',
                'class-label-group' => 'w-auto m-auto',
                'class' =>
                'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'attributes' => ['value' => 'modifier l\'avatar'],
            ])
            ->addField('text', 'full_name', [
                'text-label' => 'Votre nom et prénom',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre nom complet',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getFull_name() ?? '', 'autocomplete' => 'section-blue shipping family-name'],
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['full_name'] ?? false,
            ]) // CHAMP FULL_NAME
            ->addField('email', 'email', [
                'text-label' => 'Votre Email',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
                'required' => 1,
                'attributes' => ['value' => $modelUser->getEmail() ?? '', 'autocomplete' => 'section-blue shipping email'],
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['email'] ?? false,
            ]); // CHAMP EMAIL


        $formRegister->addField('password', 'password', [
            'text-label' => 'Mot de passe',
            'class-label-group' => 'flex flex-col w-full',
            'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
            'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
            'placeholder' => 'Enter votre mot de pass',
            'required' => 1,
            'attributes' => ['autocomplete' => 'new-password'],
            'error-message-class' => 'text-red-600 text-sm',
            'error-message' => $errors['password'] ?? false,
        ]) // CHAMP PASSWORD
            ->addField('password', 'passwordCompare', [
                'text-label' => 'Confirmation de mot de passe',
                'class-label-group' => 'flex flex-col w-full',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
                'required' => 1,
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['passwordCompare'] ?? false,
            ]); // CHAMP PASSWORD COMPARE


        /**
         * Paramètrage du boutton du fomulaire Inscription/Modification
         */
        $nameButton = $data['update-user'] ?? 'validation-user';
        $anchorButton = isset($data['update-user']) ? 'Modification' : 'Inscription';
        $formRegister->setClassActionGroup('flex flex-wrap w-full justify-between')
            ->addElementAction('submit', $nameButton, $nameButton, [
                'class' =>
                'flex w-1/2 md:w-48 items-center justify-center p-3 truncate hover:text-clip text-sm font-medium text-gray-700 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-500 hover:underline',
                'anchor' => $anchorButton,
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
