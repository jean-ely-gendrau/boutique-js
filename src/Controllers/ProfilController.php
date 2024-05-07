<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\Users;

class ProfilController
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }


    public function Profil(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];

        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);

        $id = $Idclient->id;

        $full_name = $Idclient->full_name;

        $email = $Idclient->email;

        $birthday = $Idclient->birthday;
        $adress = $Idclient->adress;


        $profil = [
            'id' => $id,
            'full_name' => $full_name,
            'email' => $email,
            'birthday' => $birthday,
            'adress' => $adress
        ];

        $render->addParams('profil', $profil);

        return  $render->render('user', $arguments);
    }
}
