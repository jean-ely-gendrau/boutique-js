<?php







namespace App\Boutique\Controllers;


use App\Boutique\Manager\CrudManager;






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





        $email = new CrudManager('users', 'Modification');


        $user = $email->getByEmail($_SESSION['email']);
        $id = $user->id;


        $paramSQL = [
            'user_id' => $id,
            'email' => $_POST['NewEmail'],
            'birthday' => $_POST['birthday'],
            'adress' => $_POST['NewAddress'],
            'password' => $_POST['nouveau_password'],
        ];



        $user = new CrudManager('users', 'Modification');



        $user->update($user, array_keys($paramSQL));
    }
}
