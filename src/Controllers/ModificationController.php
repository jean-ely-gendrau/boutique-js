<?php

namespace App\Boutique\Controllers;


use App\Boutique\Manager\CrudManager;

use App\Boutique\Models\Users;






class ModificationController
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    /**
     * Méthode Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.s
     * @return void
     */
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */

    public function View(...$arguments)
    {
    }



    public function Modification(...$arguments)
    {
        /** @var \App\Boutique\Utils\Render $render */

        $render = $arguments['render'];
        $render->addParams('title', 'Modification du profil');
        $render->render('modification', $arguments);

        $EmailCrudManager = new CrudManager('users', Users::class);


        $email = $EmailCrudManager->getByEmail($_SESSION['email']);
        $id = $email->id_user;
        var_dump($id);

        $paramSQL = [
            'id_user' => $id,
            'email' => $arguments['NewEmail'],
            'adress' => $arguments['NewAddress'],
            'password' => $arguments['nouveau_password'],
        ];



        $usermanager = new CrudManager('users', Users::class);

        $user = new Users($paramSQL);

        $usermanager->update($user, array_keys($paramSQL));


        $render['render']->addSession([
            'email' => $user->email
        ]);

        header('location:/profil');
    }
}
