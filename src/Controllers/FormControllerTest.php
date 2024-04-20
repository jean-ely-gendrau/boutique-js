<?php

namespace App\Boutique\Controllers;

use App\Boutique\Builder\FormBuilder;
use App\Boutique\Utils\Render;

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
            ->setClassForm('space-y-4 md:space-y-6')
            ->addField('email', 'email', [
                'text-label' => 'Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
            ])
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ]);



        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['rendering'];

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
        $formRegister = new FormBuilder();

        $formRegister
            ->addField('text', 'full_name', [
                'text-label' => 'Votre nom et prénom',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ])
            ->addField('email', 'email', [
                'text-label' => 'Votre Email',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre email',
            ])
            ->addField('password', 'password', [
                'text-label' => 'Mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ])
            ->addField('password', 'passwordCompare', [
                'text-label' => 'Confirmation de mot de passe',
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'class-label' =>
                'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                'placeholder' => 'Enter votre mot de pass',
            ])
            ->addElementAction('button', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
            ])
            ->addElementAction('link', 'buttonA', 'buttonA', [
                'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                'anchor' => 'connection',
                'attributes' => ['title' => 'connection', 'href' => '/'],
            ]);


        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['rendering'];

        // Ajout de la class FormBuilder au tableau de parametre retourner au template
        $render->addParams('formRegister', $formRegister);

        // Affichage du template HTML de la vue test-mail-sender
        $content = $render->render('formBuilder/register/registration', $arguments);
        return $content;
    }
}
