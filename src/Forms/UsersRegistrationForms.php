<?php

namespace App\Boutique\Forms;

use Motor\Mvc\Builder\FormBuilder;

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

        $formBuilderConnect
            ->setIdForm('form-connect') // ID FORM
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
            ]) // BUTTON SUBMIT
            ->addElementAction('link', 'buttonA', 'isRegistred', [
                'class' => 'text-gray-900 text-sm dark:text-white',
                'anchor' => 'pas encore inscrit ?',
                'attributes' => ['title' => 'connection', 'href' => '/form-test-inscription'],
            ]); // LINK ADDITIONAL

        return $formBuilderConnect->render();
    }
}
