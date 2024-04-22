<?php

namespace App\Boutique\Controllers;

use App\Boutique\Builder\FormBuilder;
use App\Boutique\Components\Debug;
use App\Boutique\Utils\Render;
use App\Boutique\Validators\ValidatorJS;

/**
 * FormControllerTest
 *
 * Cette class permet de faire le rendu d'un test de création de formulaire
 * 
 * - Connexion
 * - Inscription
 *
 *
 */
class FormControllerTest
{
    /**
     * Méthode ConnectForm
     *
     * @param array [...$arguments Les arguments transmis à la méthode suivant l'appel de call_user_func_array.]
     * 
     * @return string [Le contenu généré en rendant le template 'test-render' avec les arguments fournis.]
     */
    public function ConnectForm(...$arguments)
    {

        $formBuilderConnect = new FormBuilder();

        $formBuilderConnect
            ->setIdForm('form-connect') // ID FORM
            ->setClassForm('space-y-2 md:space-y-4') // CSS FORM
            ->addField('email', 'email', [
                'text-label' => 'Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
            ]) // CHAMP MAIL
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ]) // CHAMP PASSWORD
            ->addElementAction('submit', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Connection',
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'buttonA', 'isRegistred', [
                'class' =>
                'text-gray-900 text-sm dark:text-white',
                'anchor' => 'pas encore inscrit ?',
                'attributes' => ['title' => 'connection', 'href' => '/form-test-inscription'],
            ]); // LINK ADDITIONAL


        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['render'];

        // Ajout de la class FormBuilder au tableau de parametre retourner au template
        $render->addParams('formConnect', $formBuilderConnect);

        // Affichage du template HTML de la vue test-mail-sender
        $content = $render->render('formBuilder/connect/connection', $arguments);
        return $content;
    }


    /**
     * Méthode RegistrationForm
     *
     * @param array [...$arguments Les arguments transmis à la méthode suivant l'appel de call_user_func_array.]
     * 
     * @return string [Le contenu généré en rendant le template 'test-render' avec les arguments fournis.]
     */
    public function RegistrationForm(...$arguments)
    {
        // Debug::view($arguments);

        $formRegister = new FormBuilder();

        // Instancier le ValidatorJS
        $validatorJS = new ValidatorJS();

        // Mappage des régles de validation au champs du formulaire
        $validatorJS->addRule('full_name', '/^(\w{3,25})$/', "Votre nom et prénom n'est pas conforme");
        $validatorJS->addRule('password', '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\@\.\-_])[a-zA-Z0-9\%\$\,\;\!\@\.\-_]{6,25}$/', "Votre mot de passe doit être complété");
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
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre nom complet',
            ]) // CHAMP FULL_NAME
            ->addField('email', 'email', [
                'text-label' => 'Votre Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
            ]) // CHAMP EMAIL
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ]) // CHAMP PASSWORD
            ->addField('password', 'passwordCompare', [
                'text-label' => 'Confirmation de mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ]) // CHAMP PASSWORD COMPARE
            ->addElementAction('submit', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'Inscription',
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'buttonA', 'isRegistred', [
                'class' =>
                'text-gray-900 text-sm dark:text-white',
                'anchor' => 'Vous avez déjà un compte ?',
                'attributes' => ['title' => 'connection', 'href' => '/form-test-connect'],
            ]); // LINK ADDITIONAL



        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['render'];

        // Ajout de la class FormBuilder au tableau de parametre retourner au template
        $render->addParams('formRegister', $formRegister);

        // Affichage du template HTML de la vue test-mail-sender
        $content = $render->render('formBuilder/register/registration', $arguments);
        return $content;
    }
}
