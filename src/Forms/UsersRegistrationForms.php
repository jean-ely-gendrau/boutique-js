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
            ->setClassForm('space-y-2 md:space-y-4') // CSS FORM
            ->addField('text', 'full_name', [
                'text-label' => 'Votre nom et prénom',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre nom complet',
                'required' => 1,
                'attributes' => ['value' => $modelUser->full_name ?? '', 'autocomplete' => 'section-blue shipping family-name'],
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['full_name'] ?? false,
            ]) // CHAMP FULL_NAME
            ->addField('email', 'email', [
                'text-label' => 'Votre Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
                'required' => 1,
                'attributes' => ['value' => $modelUser->email ?? '', 'autocomplete' => 'section-blue shipping email'],
                'error-message-class' => 'text-red-600 text-sm',
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
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['password'] ?? false,
            ]) // CHAMP PASSWORD
            ->addField('password', 'passwordCompare', [
                'text-label' => 'Confirmation de mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
                'required' => 1,
                'error-message-class' => 'text-red-600 text-sm',
                'error-message' => $errors['passwordCompare'] ?? false,
            ]) // CHAMP PASSWORD COMPARE
            ->addElementAction('submit', 'validation-user', 'validation-user', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Inscription',
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'buttonA', 'isRegistred', [
                'class' => 'text-gray-900 text-sm dark:text-white',
                'anchor' => 'Vous avez déjà un compte ?',
                'attributes' => ['title' => 'connection', 'href' => '/form-test-connect'],
            ]); // LINK ADDITIONAL

        // VERIFICATION DE SECURITER 
        //if ($sessionManager->give('role') === 'admin') {
        $roleOfUsers =  ['user', 'admin'];
        $formRegister->addField('select', 'role', [
            'text-label' => 'Rôle utilisateur',
            'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
            'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
            'options-select-array' => $roleOfUsers,
        ]); // CHAMP MAIL
        // }
        return $formRegister->render();
    }
}
