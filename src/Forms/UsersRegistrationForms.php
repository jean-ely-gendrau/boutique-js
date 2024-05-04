<?php

namespace App\Boutique\Forms;

use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Validators\ValidatorJS;

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
            ->setAction('/form-test-connect') // ID FORM
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
            ->addElementAction('submit', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Connection',
                'data-js' => 'handleSampleConnect,click',
                'data-post-url' => '/sample-connect-js',
                'data-id-form' => 'form-test-connect',
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
}
